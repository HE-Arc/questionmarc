<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    /**
     * The validation rules.
     */
    private $rules = [
        'title' => 'required|min:5|max:100',
        'content' => 'required|min:1|max:16000',
    ];

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Getting modules from the database Filtered modules by user filiere and year
        $modules = Module::where('filiere_name', Auth::user()->filiere)
            ->where('year', Auth::user()->year)
            ->orderBy('name')
            ->get();


        return view(view: 'questions.create', data: [
            'modules' => $modules
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);

        $question = new Question();
        $question->title = $request->title;
        $question->content = $request->content;
        $question->module_id = $request->module_id;
        $question->author_id = Auth::id();
        $question->created_date = now();
        $question->resolved = false;

        $question->save();

        return redirect()->route('welcome');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = Question::findOrFail($id);
        $answers = Answer::withCount('upvoters')
            ->where('question_id', $question->id)
            ->orderBy('created_date', 'desc')
            ->paginate(5);

    if (Auth::check()) {
        $userUpvotes = Auth::user()->upvotedAnswers->pluck('id')->toArray();

        foreach ($answers as $answer) {
            $answer->userHasUpvoted = in_array($answer->id, $userUpvotes);
        }
    } else {
        foreach ($answers as $answer) {
            $answer->userHasUpvoted = false;
        }
    }

        return view('questions.show', [
            'question' => $question,
            'answers' => $answers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
