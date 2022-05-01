<?php

namespace App\Policies;

use App\Models\Member;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class MemberPolicy
{
    use HandlesAuthorization;

    /**
     * Any user can make a registration
     *
     * @param Member|null $member
     * @return bool
     */
    public function create(?Member $member): bool
    {
        return $member == null;
    }

    /**
     * Determine whether the user can view another member profile.
     * If the user is an admin it can view all the other profiles,
     * otherwise the member can see its own profile, public profiles
     * or profiles that they are following
     *
     * @param Member|null $member
     * @param Member $argument
     * @return bool
     */
    public function view(?Member $member, Member $argument): bool
    {
        if (Auth::guard('admin')->check())
            return true;
        if ($argument->visibility === true)
            return true;
        if (!Auth::check())
            return false;
        if ($member->id === $argument->id)
            return true;
        return $argument->followers()->where('id', $member->id)->where('state', 'accepted')->count() == 1;
    }

    /**
     * Determine whether the user can update the model.
     * A member can update only their own profile.
     *
     * @param Member $member
     * @param Member $argument
     * @return bool
     */
    public function update(Member $member, Member $argument)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $member->id === $argument->id;
    }

    /**
     * Determine whether the user can delete the model.
     * A member can delete only their own profile,
     * and admins can delete all member profiles
     *
     * @param Member|null $member
     * @param Member $argument
     * @return bool
     */
    public function delete(?Member $member, Member $argument)
    {
        if (Auth::guard('admin')->check())
            return true;
        if (!Auth::check())
            return false;
        return $member->id === $argument->id;
    }

    /**
     * Determine whether the user can follow another.
     *
     * @param Member $member
     * @param Member $argument
     * @return bool
     */
    public function follow(Member $member, Member $argument)
    {
        $followRequest = $member->following()->where('id_followed', $argument->id)->orderByDesc('timestamp')->first();
        $state = null;
        if ($followRequest != null)
            $state = $followRequest->pivot->state;
        return !$member->following->contains($argument->id) ||
            ($state == 'rejected');
    }

    /**
     * Determine whether the user can unfollow another.
     *
     * @param \App\Models\Member $member
     * @param \App\Models\Member $argument
     * @return mixed
     */
    public function deleteFollow(Member $member, Member $argument)
    {
        $followRequest = $member->following()->where('id_followed', $argument->id)->orderByDesc('timestamp')->first();
        $state = null;
        if ($followRequest != null)
            $state = $followRequest->pivot->state;
        return $member->following->contains($argument->id) &&
            ($state == 'accepted');
    }

    /**
     * Determine whether the user can accept/decline a follow request.
     *
     * @param \App\Models\Member $member
     * @param \App\Models\Member $argument
     * @return mixed
     */
    public function acceptOrDeclineFollow(Member $member, Member $argument)
    {
        $followRequest = $member->followers()->where('id_following', $argument->id)->wherePivot('state', 'pending')->exists();
        return $followRequest;
    }

    /**
     *
     * Determine whether the user can see a list of all the users.
     *
     * @param Member|null $member
     * @return mixed
     */
    public function list(?Member $member)
    {
        return Auth::guard('admin')->check();
    }
}
