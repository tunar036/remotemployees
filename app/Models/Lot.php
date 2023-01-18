<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lot extends Model
{
    use SoftDeletes;
    protected $table = 'lots';

    protected $fillable = ['name', 'description'];

    // if you want to make a many to many relation, please uncomment this
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_lots', 'lot_id', 'category_id');
    }
}
