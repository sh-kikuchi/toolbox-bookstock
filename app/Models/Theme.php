<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongTo('app\Models\User');
    }
    public function books(){
        return $this->belongsToMany('app\Models\Book');
    }
}
