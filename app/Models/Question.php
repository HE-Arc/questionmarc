<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    use HasFactory;
    public $timestamps = false;


    public function author() {
        return $this->belongsTo(User::class);
    }

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
}
