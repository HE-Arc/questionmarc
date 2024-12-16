<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['question_id', 'answer_id', 'path'];
    use HasFactory;
    public $timestamps = false;

    public function answers() {
        return $this->belongsTo(Answer::class);
    }

    public function questions() {
        return $this->belongsTo(Question::class);
    }
}
