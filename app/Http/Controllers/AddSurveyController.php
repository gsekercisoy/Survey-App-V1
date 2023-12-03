<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;

class AddSurveyController extends Controller
{
    public function create()
    {
        return view('add-survey');
    }

    public function store(Request $request)
    {
        $survey = Survey::create([
            'survey_name' => $request->input('survey_name'),
            'end_date' => $request->input('end_date'),
        ]);

        $questions = $request->input('questions');
        foreach ($questions as $questionText) {
            $question = new Question(['question' => $questionText]);
            $survey->questions()->save($question);
        }

        // Diğer işlemler...

        return redirect()->route('admin')->with('success', 'Anket başarıyla eklendi.');
    }
}
