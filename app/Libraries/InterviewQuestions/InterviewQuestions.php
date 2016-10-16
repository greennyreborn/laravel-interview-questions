<?php
/**
 * Created by IntelliJ IDEA.
 * User: michael
 * Date: 16/10/2016
 * Time: 5:04 PM
 */

namespace App\Libraries\InterviewQuestions;

class InterviewQuestions
{
    public function __construct()
    {
        $this->snakeMatrix = new SnakeMatrix();
    }

    public function snakeMatrix($num)
    {
        $this->snakeMatrix->runV2($num);
    }
}