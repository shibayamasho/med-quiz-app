<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\Http\Requests\QuizRequest;

class QuizzesController extends Controller
{
    public function edit(Request $request, Category $categoryModel)
    {
        $categories = $categoryModel->getCategories();
        return view('quizzes.edit')->with("categories", $categories);
    }

    public function create(QuizRequest $request)
    {
        try {
            $quiz = new Quiz;
            $quiz->user_id     = $request->user()->id;
            $quiz->category_id = $request->category_id;
            $quiz->description = $request->description;
            $quiz->save();

            $correction_1 = ($request->correction_1 == 1) ? true : false;
            $correction_2 = ($request->correction_2 == 1) ? true : false;
            $this->saveQuizOption((int) $quiz->id, $request->sentence_1, $correction_1);
            $this->saveQuizOption((int) $quiz->id, $request->sentence_2, $correction_2);
        }
        catch (\Exception $e) {
            dd($e);
            // return self::renderError($e->getMessage());
        }

        return redirect()->route('top');
    }

    private function saveQuizOption($quizId, $sentence, $correction)
    {
        $quizOption = new QuizOption;
        $quizOption->quiz_id = $quizId;
        $quizOption->sentence = $sentence;
        $quizOption->correction = $correction;
        $quizOption->save();
    }
}
