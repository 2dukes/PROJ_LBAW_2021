<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\Member;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Only logged users can create a group
     *
     * @param Member $member
     * @return bool
     */
    public function create(Member $member)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return true;
    }

    /**
     * A member can view all the public groups and the groups they are member of.
     * Admins can see all groups.
     *
     * @param Member|null $member
     * @param Group $group
     * @return bool
     */
    public function view(?Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return true;
        if ($group->visibility === true)
            return true;
        if (!Auth::check())
            return false;
        return $group->members->where('id', $member->id)->count() == 1;
    }

    /**
     * A member can send requests to enter groups it is not part of
     *
     * @param Member $member
     * @param Group $group
     * @return bool
     */
    public function request(Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $group->members->where('id', $member->id)->count() == 0;
    }

    /**
     * Only members of the group can make a post in it
     *
     * @param Member $member
     * @param Group $group
     * @return bool
     */
    public function post(Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        return $group->members->where('id', $member->id)->count() == 1;
    }

    /**
     * Only logged users can create a group
     *
     * @param Member $member
     * @param Group $group
     * @return bool
     */
    public function insert(Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return true;
    }

    /**
     * Only moderators can edit a group
     *
     * @param Member|null $member
     * @param Group $group
     * @return bool
     */
    public function edit(?Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $group->moderators->where('id', '=', $member->id)->count() == 1;
    }

    /**
     * Only moderators can edit a group
     *
     * @param Member|null $member
     * @param Group $group
     * @return bool
     */
    public function update(?Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $group->moderators->where('id', $member->id)->count() == 1;
    }

    /**
     * Only moderators and admins can edit a group
     *
     * @param Member $member
     * @param Group $group
     * @return bool
     */
    public function delete(Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return true;
        if (!Auth::check())
            return false;
        return $group->moderators->where('id', $member->id)->count() == 1;
    }

    /**
     * A member can send requests to enter groups they are not part of,
     * and the member can only send a request at time
     *
     * @param Member|null $member
     * @param Group $group
     * @return bool
     */
    public function join(?Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        // Already in the group
        if ($group->members->where('id', $member->id)->count() == 1)
            return false;
        // Already sent request
        if ($group->requests->where('id', $member->id)->count() == 1)
            return false;
        return true;
    }

    /**
     * Only members who already sent a request can remove it
     *
     * @param Member|null $member
     * @param Group $group
     * @return bool
     */
    public function removeRequest(?Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $group->requests()->where('id_member', $member->id)->where('state', 'pending')->count() == 1;
    }

    /**
     * Only members of the group can leave it
     *
     * @param Member|null $member
     * @param Group $group
     * @return bool
     */
    public function leave(?Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $group->members->where('id', $member->id)->count() == 1;
    }

    /**
     * Only moderators can remove a user from the group,
     * and the user can remove itself
     *
     * @param Member $member
     * @param Group $group
     * @param Member $user
     * @return bool
     */
    public function removeUser(Member $member, Group $group, Member $user)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $group->moderators->where('id', $member->id)->count() == 1 || $member->id == $user->id;
    }
}

