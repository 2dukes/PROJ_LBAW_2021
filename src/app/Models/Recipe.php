<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class Recipe extends Model
{
    public $timestamps = false;
    protected $table = "tb_recipe";

    protected $fillable = [
        'name', 'difficulty', 'description', 'servings', 'preparation_time',
        'cooking_time', 'additional_time', 'creation_time'
    ];

    protected $cast = [
        'creation_time' => 'datetime'
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'tb_ingredient_recipe', 'id_recipe', 'id_ingredient')
            ->withPivot("id_unit", "quantity");
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tb_tag_recipe', 'id_recipe', 'id_tag');
    }

    public function membersWhoFavourited()
    {
        return $this->belongsToMany(Member::class, 'tb_favourite', 'id_recipe', 'id_member');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_recipe');
    }

    public function reviews()
    {
        return $this->comments()->where('rating', '<>', null);
    }

    public function getNumReviews() {
        return $this->reviews()->count();
    }

    public function steps()
    {
        return $this->hasMany(Step::class, 'id_recipe');
    }

    public function reports()
    {
        return $this->hasMany(RecipeReport::class, 'id_recipe');
    }

    public function author()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'id_group');
    }

    public function getImages()
    {
        $paths = File::files(storage_path('app/public/images/recipes/' . $this->id . '/'));
        $images = array();
        foreach ($paths as $idx => $path) {
            array_push($images, asset('storage/images/recipes/' . $this->id . '/' . $path->getBasename()));
        }
        return $images;
    }

    public function getProfileImage()
    {
        $images = $this->getImages();
        return sizeof($images) > 0 ? $images[0] : asset("storage/images/no_image.jpg");
    }

    public function isFavourited()
    {
        if (!Auth::check()) return false;

        $membersWhoFavourited = $this->membersWhoFavourited()->where('id_member', '=', Auth::user()->id)->get();
        return sizeof($membersWhoFavourited) != 0;
    }
}
