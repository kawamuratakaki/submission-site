<?php

// app/Http/Controllers/QuestionController.php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Answer;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->get();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Question::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(), // Assuming you have user authentication
        ]);

        return redirect()->route('questions.index')->with('success', 'Question created successfully.');
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
        $answers = $question->answers()->latest()->get();

        return view('questions.show', compact('question', 'answers'));
    }

    public function storeAnswer(Request $request, $questionId)
{
    $request->validate([
        'content' => 'required',
    ]);

    Answer::create([
        'content' => $request->content,
        'user_id' => auth()->id(),
        'question_id' => $questionId,
    ]);

    return redirect()->route('questions.index')->with('success', 'Answer submitted successfully.');
}
}
