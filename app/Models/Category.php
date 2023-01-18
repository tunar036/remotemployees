<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name'];


    public function lots()
    {
        return $this->belongsToMany(Lot::class, 'category_lots', 'category_id', 'lot_id');
    }
}
