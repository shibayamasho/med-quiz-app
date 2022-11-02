<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\Http\Requests\QuizRequest;
use App\Services\QuizService;

class QuizzesController extends Controller
{
    private $quizService;

    function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    // 問題一覧
    public function index(Request $request)
    {
        $categoryId = $request->categoryId;
        $category   = $this->quizService->getCategory((int) $categoryId);
        $quizzes    = $this->quizService->getQuizzesByCategoryId((int) $categoryId);
        return view('quizzes.index')
                ->with('quizzes', $quizzes)
                ->with('category', $category);
    }

    // 問題登録画面
    public function edit(Request $request, Category $categoryModel)
    {
        $categories = $categoryModel->getCategories();
        return view('quizzes.edit')->with("categories", $categories);
    }

    // 問題登録
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

    // 問題解答画面
    public function challenge(Request $request)
    {
        $categoryId = $request->categoryId;
        $category   = $this->quizService->getCategory((int) $categoryId);
        $quizzes    = $this->quizService->getQuizzesByCategoryId((int) $categoryId);
        return view('quizzes.challenge')
                ->with('quizzes', $quizzes)
                ->with('category', $category);
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
