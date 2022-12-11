<?php

namespace app\controllers;

use app\classes\Currency;
use app\classes\Weather;
use yii\web\Controller;

class CurrencyWeatherController extends Controller
{
    /**
     * @throws \Exception
     */
    public function actionIndex()
    {
        return $this->render(
            'index',
            [
                'currency' => Currency::getNeededCurrency(),
                'weather' => Weather::getWeather(),
            ]
        );
    }

    /**
     * @return array
     *
     * @throws \Exception
     */
    public function actionGetData()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'currency' => Currency::getNeededCurrency(),
            'weather' => Weather::getWeather(),
        ];
    }
}