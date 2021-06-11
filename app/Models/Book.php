<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\Theme;
use Kyslik\ColumnSortable\Sortable; // sort

class Book extends Model
{
    use HasFactory;
    public function themes(){
    return $this->belongsToMany(Theme::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    use Sortable;
    public $sortable = [ 'name', 'title', 'publisher', 'year' ,'updated_at'];
}
