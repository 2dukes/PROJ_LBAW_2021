<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Member;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * All the comments are available in their recipes
     *
     * @param Member|null $member
     * @return bool
     */
    public function view(?Member $member)
    {
        return true;
    }

    /**
     * All users can create a comment
     *
     * @param Member|null $member
     * @return bool
     */
    public function create(?Member $member)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return true;
    }

    /**
     * Only the author of the comment can edit it
     *
     * @param Member|null $member
     * @param Comment $comment
     * @return bool
     */
    public function update(?Member $member, Comment $comment)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $member->id == $comment->owner->id;
    }

    /**
     * Only the author of the comment or an admin can delete it
     *
     * @param Member|null $member
     * @param Comment $comment
     * @return bool
     */
    public function delete(?Member $member, Comment $comment)
    {
        if (Auth::guard('admin')->check())
            return true;
        if (!Auth::check())
            return false;
        if ($comment->recipe->group != null && $comment->recipe->group->moderators->contains($member->id))
            return true;
        return $member->id == $comment->owner->id;
    }
}
