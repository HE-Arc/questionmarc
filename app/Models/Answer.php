<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function author() {
        return $this->belongsTo(User::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function upvoters() {
        return $this->belongsToMany(User::class, 'answers_users_upvote', 'answer_id', 'user_id');
    }
}
