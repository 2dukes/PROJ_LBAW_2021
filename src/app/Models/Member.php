<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Country;
use App\Models\Recipe;
use App\Models\RecipeReport;
use App\Models\CommentReport;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps = false;
    protected $table = "tb_member";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'city', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'email', 'search', 'num_rating', 'is_banned', 'visibility', 'bio', 'id_country'
    ];

    protected $appends = [
        'biography',
        'number_of_recipes',
        'number_of_followers',
        'number_of_following',
        'number_of_posted_recipes',
        'number_of_posted_comments',
        'number_of_reports'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function profileImage()
    {
        $path = "storage/images/people/$this->id.jpeg";
        if (!file_exists($path))
            return asset("storage/images/people/no_image.png");
        return asset($path);
    }

    public function hasProfileImage()
    {
        $path = "storage/images/people/$this->id.jpeg";
        if (file_exists($path)) return asset($path);
        return false;
    }

    public function coverImage()
    {
        $path = "storage/images/people/cover/$this->id.jpeg";
        if (!file_exists($path))
            return asset("storage/images/people/cover/default.jpg");
        return asset($path);
    }

    public function hasCoverImage()
    {
        $path = "storage/images/people/cover/$this->id.jpeg";
        if (file_exists($path)) return asset($path);
        return false;
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'id_member', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_member', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'id_country');
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'member', 'id');
    }

    public function favourites()
    {
        return $this->belongsToMany(Recipe::class, 'tb_favourite', 'id_member', 'id_recipe');
    }

    public function following()
    {
        return $this->belongsToMany(Member::class, 'tb_following', 'id_following', 'id_followed')
            ->withPivot("state", "timestamp");
    }

    public function followers()
    {
        return $this->belongsToMany(Member::class, 'tb_following', 'id_followed', 'id_following')
            ->withPivot("state", "timestamp");
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'tb_group_member', 'id_member', 'id_group');
    }

    public function getBiographyAttribute()
    {
        return $this->attributes['bio'];
    }

    public function getNumberOfRecipesAttribute()
    {
        return $this->recipes()->count();
    }

    public function getNumberOfFollowersAttribute()
    {
        return $this->followers()->where("state", "accepted")->count();
    }

    public function getNumberOfFollowingAttribute()
    {
        return $this->following()->where("state", "accepted")->count();
    }

    public function getNumberOfPostedRecipesAttribute() {
        return $this->recipes()->count();
    }

    public function getNumberOfPostedCommentsAttribute() {
        return $this->comments()->count();
    }

    public function getNumberOfReportsAttribute() {
        return RecipeReport::all()->where('id_reporter', $this->id)->count() +
            CommentReport::all()->where('id_reporter', $this->id)->count();
    }
}
