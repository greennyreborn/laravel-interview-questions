<?php
/**
 * Created by IntelliJ IDEA.
 * User: michael
 * Date: 17/10/2016
 * Time: 10:51 AM
 */

namespace App\Libraries\InterviewQuestions;

class LineSum
{
    const MIN_NUM = 0;
    const MAX_NUM = 20;

    public function run($n)
    {
        $lines = $this->generateRandomLines($n);
        $this->printLines($lines);
        $res = $this->calLinesV2($lines);
        echo "resultV2: $res<br>";
        usort($lines, [$this, 'cmp']);
        $this->printLines($lines);
        $res = $this->calLines($lines);
        echo "result: $res";
    }

    /**
     * @param $lines
     * @return mixed
     */
    private function calLines($lines)
    {
        $currLine = [$lines[0][0], $lines[0][1]]; // 用于计算下一条线段所属范围的基准线段
        $sum = $currLine[1] - $currLine[0];
        $len = count($lines);
        for ($i = 1; $i < $len; $i++) {
            $nextLine = $lines[$i];
            if ($nextLine[0] >= $currLine[1]) {
                $sum += $nextLine[1] - $nextLine[0];
                $currLine = $nextLine;
            } elseif ($nextLine[1] - $currLine[1] > 0) {
                $sum += $nextLine[1] - $currLine[1];
                $currLine = $nextLine;
            } else {
                $currLine = [$nextLine[0], $currLine[1]];
            }
        }
        return $sum;
    }

    private function calLinesV2($lines)
    {
        $points = $this->genereatePoints($lines);
        usort($points, [$this, 'cmpPoints']);
        $startPoints = [];
        $sum = 0;
        $len = count($points);
        for ($i = 0; $i < $len; $i++) {
            $point = $points[$i];
            if ($point['isX']) {
                $startPoints[] = $point;
            } else {
                $startPoint = array_pop($startPoints);
                if (empty($startPoints)) {
                    $sum += $point['value'] - $startPoint['value'];
                }
            }
        }

        return $sum;
    }

    private function cmpPoints($a, $b)
    {
        if ($a['value'] === $b['value']) {
            return 0;
        }

        return $a['value'] < $b['value'] ? -1 : 1;
    }

    private function genereatePoints($lines)
    {
        $points = [];
        foreach ($lines as $line) {
            $pointPair = $this->getPointPair($line);
            $points[] = $pointPair[0];
            $points[] = $pointPair[1];
        }

        return $points;
    }

    private function getPointPair($line)
    {
        return [
            [
                'value' => $line[0],
                'isX' => true
            ],
            [
                'value' => $line[1],
                'isX' => false
            ]
        ];
    }

    private function printLines($lines)
    {
        foreach ($lines as $line) {
            echo "($line[0], $line[1])  ";
        }
        echo '<br>';
    }

    private function cmp($a, $b)
    {
        if ($a[0] === $b[0]) {
            return 0;
        }

        return $a[0] < $b[0] ? -1 : 1;
    }

    private function generateRandomLines($n)
    {
        $lines = [];
        for ($i = 0; $i < $n; $i++) {
            $lines[] = $this->getRandomLine();
        }
        return $lines;
    }

    /**
     * @return array
     */
    private function getRandomLine()
    {
        $x = mt_rand(self::MIN_NUM, self::MAX_NUM - 1);
        $y = mt_rand($x + 1, self::MAX_NUM > $x + 6 ? $x + 6 : self::MAX_NUM);
        return [$x, $y];
    }
}