<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Answer;

class SurveyController extends Controller
{
    public function index($id)
    {
        $survey = Survey::findOrFail($id);
        $questions = Question::where('survey_id', $id)->get();

        return view('survey', compact('survey', 'questions'));
    }

    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
        $questions = Question::where('survey_id', $id)->get();

        return view('edit-survey', compact('survey', 'questions'));
    }

    public function delete($id)
    {
        $survey = Survey::findOrFail($id);
        $survey->delete();

        return redirect()->route('admin');
    }
    public function remove_question(Request $request)
    {
        $question = Question::findOrFail($request->input('question_id'));
        $question->delete();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'survey_name' => 'required|string|max:255',
            'end_date' => 'required|date',
            'questions' => 'required|array',
            'questions.*' => 'required|string',
        ]);
    
        $survey = Survey::findOrFail($id);
        $survey->update([
            'survey_name' => $request->input('survey_name'),
            'end_date' => $request->input('end_date'),
        ]);
    
        // Assuming you want to update questions
        $questions = $request->input('questions');
        $survey->questions()->delete(); // Remove existing questions
    
        foreach ($questions as $questionText) {
            $question = new Question(['question' => $questionText]);
            $survey->questions()->save($question);
        }
    
        return redirect()->route('admin')->with('success', 'Survey updated successfully');
    }

    public function show($id)
    {
        $survey = Survey::findOrFail($id);
        $questions = Question::where('survey_id', $id)->get();
    
        // Assuming you have a User model, get the authenticated user
        $user = auth()->user();
    
        // Get answers for the current user and survey
        $answers = Answer::where('survey_id', $id)
            ->where('user_id', $user->id)
            ->get();
    
        return view('show-survey', compact('survey', 'questions', 'answers'));
    }
    
}
