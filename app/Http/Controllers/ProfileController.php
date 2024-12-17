<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

const TABS = ['questions', 'answers', 'upvotes'];

class ProfileController extends Controller
{
    public function show($profile): View
    {
        $user = User::with(['questions', 'answers', 'upvotedAnswers'])->findOrFail($profile);

        $questions = $user->questions()
            ->orderBy('created_date', 'desc')
            ->paginate(5, ['*'], 'questions_page');
        $upvotedAnswers = $user->upvotedAnswers()
            ->withCount('upvoters')
            ->orderBy('created_date', 'desc')
            ->paginate(5, ['*'], 'upvotes_page');
        $answers = $user->answers()
            ->withCount('upvoters')
            ->orderBy('created_date', 'desc')
            ->paginate(5, ['*'], 'answers_page');

        if (Auth::check()) {
            $userUpvotes = Auth::user()->upvotedAnswers->pluck('id')->toArray();

            foreach ($answers as $answer) {
                $answer->userHasUpvoted = in_array($answer->id, $userUpvotes);
            }
            foreach ($upvotedAnswers as $answer) {
                $answer->userHasUpvoted = in_array($answer->id, $userUpvotes);
            }
        } else {
            foreach ($answers as $answer) {
                $answer->userHasUpvoted = false;
            }
            foreach ($upvotedAnswers as $answer) {
                $answer->userHasUpvoted = false;
            }
        }

        $tab = request('tab', '');
        if (!in_array($tab, TABS)) {
            $tab = 'questions';
        }

        return view('profile.show', [
            'user' => $user,
            'questions' => $questions,
            'answers' => $answers,
            'upvotedAnswers' => $upvotedAnswers,
            'tab' => $tab
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $filieres = Module::select('filiere_name')->distinct()->pluck('filiere_name');
        return view('profile.edit', [
            'user' => $request->user(),
            'filieres' => $filieres,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
