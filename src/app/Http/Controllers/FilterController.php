<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController
{
    public static function filter(Request $request, $query, $comesFromSearch=false) {
        return $query
            ->when($comesFromSearch ? false : $request->input('sort'), function($query, $sortOrder) {  // in search it is ordered by how well it matches the query
                // TODO
                return $query;
            })
            ->when($request->query('category'), function($query, $category) {
                return $query->where('id_category', '=', $category);   // selects recipes of this category
            })
            ->when($request->query('tags'), function($query, $tags) {  // selecting recipes that have the selected tags
                $tagList = explode(',', $tags);
                foreach($tagList as $tag) {
                    $query = $query->whereExists(function($query) use($tag) {
                        $query->select(DB::raw(1))
                            ->from('tb_tag_recipe')
                            ->where('id_tag', '=', $tag)
                            ->whereColumn('id_recipe', 'recipe_id');
                    });
                }
                return $query;
            })
            ->when($request->query('rating'), function($query, $rating) {  // selecting recipe in the rating range
                $ratingParts = explode(',', $rating);
                if (sizeof($ratingParts) != 2) return $query;

                if (!is_numeric($ratingParts[0]) || !is_numeric($ratingParts[1])) return $query;

                return $query->whereBetween('score', [$ratingParts[0], $ratingParts[1]]);
            })
            ->when($request->query('ingredients'), function($query, $ingredients) {   // selecting recipe that has the selected ingredients
                $ingredientList = explode(',', $ingredients);
                foreach($ingredientList as $ingredient) {
                    $query = $query->whereExists(function($query) use($ingredient) {
                        $query->select(DB::raw(1))
                            ->from('tb_ingredient_recipe')
                            ->where('id_ingredient', '=', $ingredient)
                            ->whereColumn('id_recipe', 'recipe_id');
                    });
                }
                return $query;
            })
            ->when($request->query('date'), function($query, $date) {  // selecting recipe in the date range
                $dateParts = explode(',', $date);
                if (sizeof($dateParts) != 2) return $query;

                return $query->whereBetween('creation_time', [$dateParts[0], $dateParts[1]]);
            })
            ->when($request->query('duration'), function($query, $duration) {   // selecting recipe in the duration range
                $durationParts = explode(',', $duration);
                if (sizeof($durationParts) != 2) return $query;

                if (!is_numeric($durationParts[0]) || !is_numeric($durationParts[1])) return $query;

                if ($durationParts[1] == 300) {
                    return $query->where('total_duration', '>=', $durationParts[0]);
                }

                return $query->whereBetween('total_duration', [$durationParts[0], $durationParts[1]]);
            })
            ->when($request->query('difficulty'), function($query, $difficulty) {   // selecting recipes with the selected difficulty
                return $query->where('difficulty', '=', $difficulty);
            });
    }
}


?>
