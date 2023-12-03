<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\UserSurveyStatus;


class AnswerController extends Controller
{
    public function store(Request $request)
    {
        // $request'ten gelen cevapları al
        $answers = $request->input('answers');

        $user_id = auth()->user()->id;

        foreach ($answers as $question_id => $answer_value) {
            Answer::create([
                'user_id'     => $user_id,
                'survey_id'   => $request->input('survey_id'), // Eğer survey_id formda gönderilmiyorsa, uygun şekilde düzenle
                'question_id' => $question_id,
                'answer'      => $answer_value,
            ]);
            UserSurveyStatus::updateOrCreate(
                ['user_id' => $user_id, 'survey_id' => $request->input('survey_id')],
                ['question_status' => 0]
            );
        }   

        return redirect()->route('dashboard');
    }
}
