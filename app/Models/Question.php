<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    use HasFactory;
    public $timestamps = false;

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Module() {
        return $this->belongsTo(Module::class);
    }

}
