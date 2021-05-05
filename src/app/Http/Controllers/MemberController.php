<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Recipe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    // ----------------------------------------------------------------
    // Upsert Validation
    // ----------------------------------------------------------------
    private static $validation = [
        'name' => 'required|string',
        'username' => 'required|string|unique:tb_member',
        'email' => 'required|string|email|unique:tb_member',
        'city' => 'nullable|string',
        'country' => 'required|integer|exists:App\Models\Country,id',
        'password' => 'required|string',
        'biography' => 'required|string',
        'visibility' => 'required|string|in:public,private',
        'profileImage' => 'required|file|image|mimes:jpeg',
        'coverImage' => 'nullable|file|image|mimes:jpeg',
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
        return [];
        //return $user->groups;
    }

    public function put(Request $request, Member $user)
    {
        $validator = Validator::make($request->all(), MemberController::$validation, MemberController::$errorMessages);
        if ($validator->fails()) {
            $message = "";
            foreach ($validator->messages()->getMessages() as $msgArr) {
                foreach ($msgArr as $msg) $message .= $msg . " ";
            }
            return response()->json(['message' => $message], 400);
        }
        $this->validate($request, MemberController::$validation, MemberController::$errorMessages);

        try {
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->city = $request->input('city');
            $user->bio = $request->input('biography');
            $user->visibility = $request->input('visibility') == "public";
            $user->country()->associate($request->input('country'));
            $user->password = bcrypt($request->input('password'));
            $user->save();

            return response()->json(['message' => 'Success!', 'member_id' => $user->id], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Invalid Request!'], 400);
        }

    }

    public function remove(Member $user)
    {
        //
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
        return view('pages.user.' . $tab, [
            'user' => $this->get($user),
            'groups' => $this->getGroups($user),
            'tab' => strtolower($tab),
            $tab => $items,
            'canEdit' => Gate::inspect('update', $user)->allowed(),
            'canDelete' => Gate::inspect('delete', $user)->allowed(),
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
        $this->validate($request, MemberController::$validation, MemberController::$errorMessages);
        $apiReponse = $this->put($request, $user);
        if ($apiReponse->status() == 200)
            return redirect("/user/$user->username")->with('message', 'User updated successfully!');
        else
            return redirect("/user/$user->username/edit")->withErrors("Could not update user");
    }

    public function deleteAction(Member $user)
    {
        $this->remove($user);
        return redirect("/login");
    }
}
