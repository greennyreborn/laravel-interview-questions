<?php
/**
 * Created by IntelliJ IDEA.
 * User: michael
 * Date: 16/10/2016
 * Time: 4:54 PM
 */

namespace App\Libraries\InterviewQuestions;

class SnakeMatrix
{
    /**
     * @param int $num
     * @return bool
     */
    public function run(int $num)
    {
        if ($num < 0) {
            return false;
        }
        $matrix = $this->initEmptyMatrix($num);
        $x = 0;
        $y = $num - 1;
        $xLast = -1;
        $yLast = $num - 1;
        $index = 1;
        $matrix[$x][$y] = $index;

        while (true) {
            $index++;
            if ($index > $num * $num) {
                break;
            }
            $i = $x;
            $j = $y;
            list($x, $y) = $this->move($x, $y, $xLast, $yLast, $matrix);
            $matrix[$x][$y] = $index;
            $xLast = $i;
            $yLast = $j;
        }

        $this->printMatrix($matrix, $num);
        return true;
    }

    /**
     * @param $x
     * @param $y
     * @param $xLast
     * @param $yLast
     * @param $matrix
     *
     * @return array
     */
    private function move($x, $y, $xLast, $yLast, $matrix)
    {
        $vector = [$x - $xLast, $y - $yLast];
        $vectorStraight = $vector; // 走直线
        $nextPoint = [$x + $vectorStraight[0], $y + $vectorStraight[1]];
        if (isset($matrix[$nextPoint[0]][$nextPoint[1]]) && $matrix[$nextPoint[0]][$nextPoint[1]] === 0) {
            return $nextPoint;
        }

        $turnRightVector = [$y - $yLast, $xLast - $x];
        $turnRightPoint = [$x + $turnRightVector[0], $y + $turnRightVector[1]]; // 右转
        if (isset($matrix[$turnRightPoint[0]][$turnRightPoint[1]]) && $matrix[$turnRightPoint[0]][$turnRightPoint[1]] === 0) {
            return $turnRightPoint;
        }

        return [];
    }


    /**
     * @param int $num
     * @return array
     */
    private function initEmptyMatrix(int $num)
    {
        $arr = [];
        for ($i = 0; $i < $num; $i++) {
            for ($j = 0; $j < $num; $j++) {
                if (!isset($arr[$i])) {
                    $arr[$i] = [];
                }
                $arr[$i][$j] = 0;
            }
        }
        return $arr;
    }

    private function printMatrix($matrix, $num)
    {
        echo '<table>';
        for ($j = $num - 1; $j >= 0; $j--) {
            echo '<tr>';
            for ($i = 0; $i < $num; $i++) {
                echo '<td>';
                echo $matrix[$i][$j] . ' ';
                echo '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    public function runV2($num)
    {
        $count = 1;
        $directions = [
            [1, 0],
            [0, 1],
            [-1, 0],
            [0, -1]
        ];

        $matrix = $this->initEmptyMatrix($num);

        $x = 0;
        $y = 0;
        $matrix[$x][$y] = $count;
        $directionIndex = 0;
        while ($count < $num * $num) {
            $xNext = $x + $directions[$directionIndex][0];
            $yNext = $y + $directions[$directionIndex][1];
            if (isset($matrix[$xNext][$yNext]) && $matrix[$xNext][$yNext] === 0) {
                $count++;
                $matrix[$xNext][$yNext] = $count;
                $x = $xNext;
                $y = $yNext;
            } else {
                $directionIndex = ($directionIndex + 1) % count($directions);
            }
        }

        $this->printMatrixV2($matrix, $num);
    }

    private function printMatrixV2($matrix, $num)
    {
        echo '<table>';
        for ($j = 0; $j < $num; $j++) {
            echo '<tr>';
            for ($i = 0; $i < $num; $i++) {
                echo '<td>';
                echo $matrix[$i][$j] . ' ';
                echo '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
}