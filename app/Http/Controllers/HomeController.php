<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        // sending user related questions to the view
        return view('index', [
            'questions' => Question::with(relations: 'author')->paginate(5)
        ]);
    }
}
