<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    public $timestamps = false;
    protected $table = "tb_step";

    protected $fillable = [
        'name', 'description'
    ];

    public function recipe() {
        return $this->belongsTo('App\Models\Recipe', 'id_recipe', 'id');
    }
}
