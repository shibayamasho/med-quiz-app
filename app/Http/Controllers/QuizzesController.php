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
            // 問題文を登録
            $quiz = new Quiz;
            $quiz->user_id     = $request->user()->id;
            $quiz->category_id = $request->category_id;
            $quiz->description = $request->description;
            $quiz->save();

            // 問題の選択肢を登録
            $correction_1 = ($request->correction_1 == 1) ? true : false;
            $correction_2 = ($request->correction_2 == 1) ? true : false;
            $this->quizService->saveQuizOption((int) $quiz->id, $request->sentence_1, $correction_1);
            $this->quizService->saveQuizOption((int) $quiz->id, $request->sentence_2, $correction_2);
            if ($request->choices >= 3) {
                $correction_3 = ($request->correction_3 == 1) ? true : false;
                $this->quizService->saveQuizOption((int) $quiz->id, $request->sentence_3, $correction_3);
            }
            if ($request->choices >= 4) {
                $correction_4 = ($request->correction_4 == 1) ? true : false;
                $this->quizService->saveQuizOption((int) $quiz->id, $request->sentence_4, $correction_4);
            }
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

    // ランダムに挑戦
    public function randomChallenge(Request $request)
    {
        $count = 1; // 問題数
        $categoryId = $request->categoryId;
        $category   = $this->quizService->getCategory((int) $categoryId);
        // 問題IDをランダムに抽出
        $quizIds = $this->quizService->getRandomQuizIds((int) $categoryId, $count);
        // 問題IDから問題を取得
        $quizzes = $this->quizService->getRandomQuizzes((int) $categoryId, $quizIds);
        return view('quizzes.challenge')
                ->with('quizzes', $quizzes)
                ->with('category', $category);
    }

    public function answer(Request $request)
    {
        // TODO ランダムの時の答え画面対応
        $categoryId = $request->categoryId;
        $category   = $this->quizService->getCategory((int) $categoryId);
        $quizzes    = $this->quizService->getQuizzesByCategoryId((int) $categoryId);
        $answerArray = []; //正解・不正解を返すarray
        foreach($quizzes as $quiz) {
            $answerArray[$quiz->id] = true;
            foreach($quiz->quiz_options as $option) {
                $select = (int)$request['sentence_' . $option->id];
                $correctAnswer = (int)$option->correction;
                if ($select === $correctAnswer) {
                    // 正解
                } else {
                    // 不正解
                    $answerArray[$quiz->id] = false;
                }
            }
        }
        // TODO 正解不正解をviewに表示
        return view('quizzes.answer')
                ->with('quizzes', $quizzes)
                ->with('answers', $answerArray)
                ->with('category', $category);
    }
}
