<?php

namespace app\classes;

use Yii;

class Evolution
{
    public const OPERATION_LIST = [
        'activation',
        'reload',
        'insulation',
        'extinction',
    ];
    public const ALIVE = 'alive';
    public const DIE = 'die';
    public const STATES = [self::ALIVE, self::DIE];
    public static function createLife()
    {
        $request = Yii::$app->request;
        $get = $request->get();
        $rows = $get['rows'];
        $cells = $get['cells'];
        for ($i = 1; $i <= $rows; $i++) {
            for ($j = 1; $j <= $cells; $j++) {
                $lifeList[$i][$j] = self::randState();
            }
        }
        return $lifeList;
    }

    /**
     * @return string
     */
    private static function randState()
    {
        return self::STATES[rand(0, 1)];
    }

    /**
     * @param $cellsList
     * @return false|mixed
     */
    public static function updateLife($cellsList)
    {
        foreach (self::OPERATION_LIST as $operation) {
            $allDie = true;
            foreach ($cellsList as $row => $cells) {
                foreach ($cells as $cell => $state) {
                    $countNeighbours = self::getActiveNeighbours($cellsList, $row, $cell);
                    $newStatus = self::$operation($countNeighbours, $state);
                    $cellsList[$row][$cell] = $newStatus;
                    if ($newStatus !== 'die') {
                        $allDie = false;
                    }
                }
            }
        }
        if ($allDie) {
            return false;
        }

        return $cellsList;
    }

    /**
     * @param array $cellsList
     * @param array $row
     * @param string $cell
     * @return int
     */
    private static function getActiveNeighbours(array $cellsList, array $row, string $cell):int
    {
        $count = 0;
        for ($i = -1; $i<=1; $i++) {
            for ($j = -1; $j<=1; $j++) {
                if (!empty($cellsList[$row + $i][$cell + $j]) && !($i == 0 && $j ==0) && $cellsList[$row + $i][$cell + $j] == 'alive') {
                    $count ++;
                }
            }
        }
        return $count;
    }

    /**
     * @param array $countNeighbours
     * @param string $state
     * @return string
     */
    private static function activation(array $countNeighbours, string $state): string
    {
        return ($state == 'die' && $countNeighbours == 3) ? 'alive' : $state;
    }

    /**
     * @param array $countNeighbours
     * @param string $state
     * @return string
     */
    private static function reload(array $countNeighbours, string $state): string
    {
        return ($state == 'alive' && $countNeighbours >= 4) ? 'die' : $state;
    }

    /**
     * @param array $countNeighbours
     * @param string $state
     * @return string
     */
    private static function insulation(array $countNeighbours, string $state): string
    {
        return ($state == 'alive' && $countNeighbours <= 1) ? 'die' : $state;
    }

    /**
     * @param array $countNeighbours
     * @param string $state
     * @return string
     */
    private static function extinction(array $countNeighbours, string $state): string
    {
        return ($state == 'alive' && ($countNeighbours == 3 || $countNeighbours == 2)) ? 'alive' : $state;
    }
}