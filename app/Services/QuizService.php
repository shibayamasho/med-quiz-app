<?php

namespace App\Services;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\Models\Category;

class QuizService
{
    // すべての問題を返す
    public function getQuizzes()
    {
        return Quiz::orderBy('created_at', 'DESC')->get();
    }

    // 該当カテゴリーのすべての問題を返す
    public function getQuizzesByCategoryId($categoryId)
    {
        if ($categoryId) {
            $quizzes = Quiz::where('category_id', $categoryId)
                        ->orderBy('created_at', 'DESC')
                        ->get();
        } else {
            $quizzes = [];
        }
        return $quizzes;
    }

    public function getCategory($categoryId)
    {
        return Category::find($categoryId);
    }

    public function saveQuizOption($quizId, $sentence, $correction)
    {
        $quizOption = new QuizOption;
        $quizOption->quiz_id    = $quizId;
        $quizOption->sentence   = $sentence;
        $quizOption->correction = $correction;
        $quizOption->save();
    }
}