<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Image;

class AnswerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|min:1|max:16000',
            'question_id' => 'required|exists:questions,id',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $answer = new Answer();
        $answer->content = $request->content;
        $answer->question_id = $request->question_id;
        $answer->author_id = Auth::id();
        $answer->created_date = now();
        $answer->validated = false;

        $answer->save();

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {

                $imageRecord = Image::create([
                    'question_id' => $answer->question_id,
                    'answer_id' => $answer->id,
                    'path' => '',
                ]);

                $path = $image->storeAs(
                    'images/question' . $answer->question_id . '/answer' . $answer->id,
                    $imageRecord->id . '_' . $image->getClientOriginalName(),
                    'public'
                );
                $imageRecord->path = $path;
                $imageRecord->save();
            }
        }

        return redirect()->route('questions.show', ['question' => $answer->question_id]);
    }

    public function upvote(Request $request, $answerId)
    {
        $user = User::findOrFail(Auth::id());
        $answer = Answer::findOrFail($answerId);

        $hasUpvoted = $user->upvotedAnswers->contains($answer->id);

        if ($hasUpvoted) {
            $user->upvotedAnswers()->detach($answer->id);
        } else {
            $user->upvotedAnswers()->attach($answer->id);
        }

        // Retourne une réponse JSON avec l'état actuel des votes
        return response()->json([
            'success' => true,
            'upvoted' => !$hasUpvoted,
            'upvoters_count' => $answer->upvoters()->count(),
        ]);
    }

    /**
     * Mark the answer as accepted.
     */
    public function accept(string $id)
    {
        // validate the request if the user is the author of the question and if the answer belongs to the question and if the answer is not already accepted
        $answer = Answer::findOrFail($id);
        $question = $answer->question;

        if ($question->author_id !== Auth::id() || $answer->question_id !== $question->id || $answer->validated) {
            return redirect()->route('questions.show', ['question' => $question->id]);
        }else{
            $answer->validated = true;
            $answer->save();
            $question->resolved = true;
            $question->save();
            return redirect()->route('questions.show', ['question' => $question->id]);
        }

    }

    /**
     * Cancel the accepted answer.
     */
    public function cancel(string $id)
    {
        // validate the request if the user is the author of the question and if the answer belongs to the question and if the answer is accepted
        $answer = Answer::findOrFail($id);
        $question = $answer->question;

        if ($question->author_id !== Auth::id() || $answer->question_id !== $question->id || !$answer->validated) {
            return redirect()->route('questions.show', ['question' => $question->id]);
        }else{
            $answer->validated = false;
            $answer->save();
            $question->resolved = false;
            $question->save();
            return redirect()->route('questions.show', ['question' => $question->id]);
        }
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
