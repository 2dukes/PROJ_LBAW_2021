<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Member;
use App\Models\Recipe;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    // ----------------------------------------------------------------
    // Upsert Validation
    // ----------------------------------------------------------------
    private static $validation = [
        'put' => [
            'name' => 'required|string|min:4|max:60',
            'username' => ['required','string','regex:/^[a-zA-Z0-9]+((_|\.)[a-zA-Z0-9]+)*$/i','min:4','max:20'],
            'email' => 'required|string|email|min:5|max:100',
            'city' => 'nullable|string|max:60',
            'country' => 'required|integer|exists:App\Models\Country,id',
            'biography' => 'nullable|string|max:512',
            'visibility' => 'required|string|in:public,private',
            'profileImage' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,bmp',
            'coverImage' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,bmp',
        ]
    ];

    private static $errorMessages = [

    ];


    // ----------------------------------------------------------------
    // API
    // ----------------------------------------------------------------

    public function post(Request $request)
    {
        //
    }

    public function get(Member $user)
    {
        return $user->load('country');
    }

    public function getRecipes(Member $user)
    {
        return $user->recipes;
    }

    public function getReviews(Member $user)
    {
        $reviews = array();
        foreach ($user->comments as $comment) {
            $comment = $comment->load('fatherComments');
            // Reviews are comments that do not have a father
            if (sizeof($comment->fatherComments) == 0)
                $reviews[] = $comment;
        }
        return $reviews;
    }

    public function getFavourites(Member $user)
    {
        return $user->favourites;
    }

    public function getFollowing(Member $user)
    {
        return $user->following;
    }

    public function getFollowers(Member $user)
    {
        return $user->followers;
    }

    public function getGroups(Member $user)
    {
        return $user->groups;
    }

    public function put(Request $request, Member $user)
    {
        $validator = Validator::make($request->all(), MemberController::$validation['put'], MemberController::$errorMessages);
        if ($validator->fails()) {
            $message = "";
            foreach ($validator->messages()->getMessages() as $msgArr) {
                foreach ($msgArr as $msg) $message .= $msg . " ";
            }
            return response()->json(['message' => $message], 400);
        }
        $this->validate($request, MemberController::$validation['put'], MemberController::$errorMessages);

        try {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->city = $request->input('city');
            $user->bio = $request->input('biography');
            $user->visibility = $request->input('visibility') == "public";
            $user->country()->associate($request->input('country'));

            $newPassword = $request->input('newPassword');
            $currentPassword = $request->input('currentPassword');
            if ($newPassword && $currentPassword && Auth::attempt(array('username' => $user->username, 'password' => $currentPassword))) {
                $user->password = bcrypt($newPassword);
            } else if ($newPassword && $currentPassword || $newPassword && !$currentPassword) {
                throw new Exception("The current password is incorrect!");
            }

            $user->username = $request->input('username');

            $user->save();

            if ($request->hasFile('profileImage')) {
                $file = $request->file('profileImage');
                ImageUploadController::store($file, 'public/images/people', $user->id);
            }
            else if (!$request->input('previousProfileImage') && $user->hasProfileImage())
                File::delete(storage_path('app/public/images/people/'.$user->id.".jpeg"));

            if ($request->hasFile('coverImage')) {
                $file = $request->file('coverImage');
                ImageUploadController::store($file, 'public/images/people/cover', $user->id);
            }
            else if (!$request->input('previousCoverImage') && $user->hasCoverImage())
                File::delete(storage_path('app/public/images/people/cover/'.$user->id.".jpeg"));

            return response()->json(['message' => 'Success!', 'member_id' => $user->id], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

    }

    public function remove(Member $user)
    {
        Storage::delete("public/images/people/$user->id.jpeg");
        Storage::delete("public/images/people/cover/$user->id.jpeg");
        $user->delete();
        return response()->json(['message' => 'Success!', 'member_id' => $user->id], 200);
    }

    public function followRequest(Member $user) {
        try {
            Auth::user()->following()->attach($user->id);
            $newState = Auth::user()->following()->where('id_followed', $user->id)->orderByDesc('timestamp')->first()->pivot->state;
            return response()->json(['message' => 'Success!', 'newState' => $newState], 200);
        } catch(Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function deleteFollowRequest(Member $user) {
        try {
            Auth::user()->following()->wherePivot('state', 'accepted')->detach($user->id);
            return response()->json(['message' => 'Success!', 'newState' => 'Follow'], 200);
        } catch(Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function acceptFollowRequest(Member $user) {
        try {
            Auth::user()->followers()->updateExistingPivot($user->id, [
                'state' => 'accepted'
            ]);
            return response()->json(['message' => 'Success!'], 200);
        } catch(Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function declineFollowRequest(Member $user) {
        try {
            Auth::user()->followers()->wherePivot('state', 'pending')->detach($user->id);
            return response()->json(['message' => 'Success!'], 200);
        } catch(Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    // ----------------------------------------------------------------
    // Pages
    // ----------------------------------------------------------------

    public function redirect(Member $user)
    {
        return redirect("/user/$user->username/recipes");
    }

    private function renderMemberView(Member $user, string $tab, $items)
    {
        $followState = 'Follow';
        if(!Auth::check() || Auth::guard('admin')->check())
            $followState = 'External';
        else if(Auth::user()->following->contains($user->id)) {
            $followState = DB::table('tb_following')
                ->select('state')
                ->where('id_following', Auth::user()->id)
                ->where('id_followed', $user->id)
                ->orderByDesc('timestamp')
                ->limit(1)
                ->get();
            $followState = json_decode($followState, true)[0]['state'];
        }

        if (Gate::inspect('view', $user)->denied())
            return view('pages.user.privateProfile', [
                'user' => $this->get($user),
                'followState' => $followState
            ]);

        return view('pages.user.' . $tab, [
            'user' => $this->get($user),
            'groups' => $this->getGroups($user),
            'tab' => strtolower($tab),
            $tab => $items,
            'followState' => $followState
        ]);
    }

    public function readRecipes(Member $user)
    {
        return $this->renderMemberView($user, 'recipes', $this->getRecipes($user));
    }

    public function readFavourites(Member $user)
    {
        return $this->renderMemberView($user, 'favourites', $this->getFavourites($user));
    }

    public function readReviews(Member $user)
    {
        return $this->renderMemberView($user, 'reviews', $this->getReviews($user));
    }

    public function update(Member $user)
    {
        return view('pages.user.edit', [
            'user' => $this->get($user)
        ]);
    }

    public function updateAction(Request $request, Member $user)
    {
        $this->validate($request, MemberController::$validation['put'], MemberController::$errorMessages);
        $apiReponse = $this->put($request, $user);
        if ($apiReponse->status() == 200)
            return redirect("/user/$user->username")->with('message', 'User updated successfully!');
        $array = json_decode($apiReponse->getContent(), true);
        return redirect("/user/$user->username/edit")->withErrors($array['message']);
    }

    public function deleteAction(Member $user)
    {
        $this->remove($user);
        return response()->json(['message' => 'Succeed!']);
    }

    public function list() {
        return view('pages.admin.usersManagement');
    }

    public function banUser(Request $request, Member $user) {
        $user->is_banned = $request->input('ban');
        $user->save();
        return response()->json(['message' => 'Succeed!']);
    }
}
