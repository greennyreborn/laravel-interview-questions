<?php

namespace App\Http\Controllers;

use App\Libraries\InterviewQuestions\InterviewQuestions;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $interviewQuestions;
    public function __construct()
    {
        parent::__construct();
        $this->interviewQuestions = new InterviewQuestions();
    }

    public function snakeMatrix(Request $request, $num)
    {
        $this->interviewQuestions->snakeMatrix(intval($num));
    }

    private function test($params)
    {
        $params = func_get_args();
        dd($params);
    }


}
