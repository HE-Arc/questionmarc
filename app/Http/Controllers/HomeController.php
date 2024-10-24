<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        return View('index', [
            'questions' => Question::paginate(5)
        ]);
    }
}
