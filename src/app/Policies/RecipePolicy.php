<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Member;
use App\Models\Recipe;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class RecipePolicy
{
    use HandlesAuthorization;

    /**
     * All members can post a recipe
     *
     * @param Member|null $user
     * @return false
     */
    public function insert(?Member $user)
    {
        if (Auth::guard('admin')->check())
            return false;
        return Auth::check();
    }

    /**
     * A member can see all the recipes from public groups
     * or groups they are members of,
     * if its not from a group they can see all recipes from
     * public users or users they follow.
     * admins can see all recipes.
     *
     * @param Member|null $user
     * @param Recipe $recipe
     * @return bool
     */
    public function select(?Member $user, Recipe $recipe)
    {
        if (Auth::guard('admin')->check())
            return true;
        if (Auth::check() && $user->id === $recipe->author->id)
            return true;
        if ($recipe->group !== null) {
            if ($recipe->group->visibility == true)
                return true;
            return Auth::check() && $recipe->group->members->contains($user->id);
        }
        if ($recipe->author->visibility == true)
            return true;
        return Auth::check() && $recipe->author->followers()->wherePivot('state', 'accepted')->get()->contains($user->id);
    }

    /**
     * Only the author of the recipe can edit it
     *
     * @param Member|null $user
     * @param Recipe $recipe
     * @return bool
     */
    public function update(?Member $user, Recipe $recipe)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $user->id == $recipe->author->id;
    }

    /**
     * Only the author of a recipe or an admin can delete it
     *
     * @param Member|null $user
     * @param Recipe $recipe
     * @return bool
     */
    public function delete(?Member $user, Recipe $recipe)
    {
        if (Auth::guard('admin')->check())
            return true;
        if (!Auth::check())
            return false;
        if ($recipe->group != null && $recipe->group->moderators->contains($user->id))
            return true;
        return $user->id == $recipe->author->id;
    }

    /**
     * Any member who has not the recipe already in its favourites can add the recipe to it
     *
     * @param Member|null $user
     * @param Recipe $recipe
     * @return bool
     */
    public function addToFavourites(?Member $user, Recipe $recipe)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return !$recipe->membersWhoFavourited->contains($user->id);
    }

    /**
     * Any member who has the recipe already in its favourites can remove the recipe from it
     *
     * @param Member|null $user
     * @param Recipe $recipe
     * @return false
     */
    public function removeFromFavourites(?Member $user, Recipe $recipe)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $recipe->membersWhoFavourited->contains($user->id);
    }
}
