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
            $this->quizService->saveQuizOption((int) $quiz->id, $request->sentence_1, $correction_1);
            $this->quizService->saveQuizOption((int) $quiz->id, $request->sentence_2, $correction_2);
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

    public function answer(Request $request)
    {
        $categoryId = $request->categoryId;
        //カテゴリーから、問題の選択肢のデータを取ってくる
        // リクエストから、$request->sentence_XXX（option_id）を抽出する
        // リクエスト value=1:チェック、value=0:未チェック
        $quizzes = $this->quizService->getQuizzesByCategoryId((int) $categoryId);
        $answerArray = []; //正解・不正解を返すarray
        foreach($quizzes as $quiz) {
            $answerArray[$quiz->id] = true;
            foreach($quiz->quiz_options as $option) {
                $select = (int)$request['sentence_' . $option->id];
                $correctAnswer = (int)$option->correction;
                if ($select === $correctAnswer) {
                    // dump('正解');
                } else {
                    $answerArray[$quiz->id] = false;
                    // dump('はずれ');
                }
            }
        }
        dd($answerArray);
        // TODO 正解不正解をviewに表示
    }
}
