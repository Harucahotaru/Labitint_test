<?php

namespace app\controllers;

use app\classes\Evolution;
use Yii;
use yii\web\Controller;

class EvolutionController extends Controller
{
    /**
     * @throws \Exception
     */
    public function actionIndex()
    {
        return $this->render(
            'index'
        );
    }


    /**
     * @return string
     */
    public function actionCycle()
    {
        $request = Yii::$app->request;
        $post = $request->post();
        if (!empty($post)) {
            var_dump($post);
        }
        $evolution = Evolution::createLife();
        return $this->render(
            'cycle', ['evolution' => $evolution]
        );
    }

    /**
     * @return string
     */
    public function actionUpdateLife()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $cellsList = $request->post('cells');
        if (!empty($cellsList)) {
            return Evolution::updateLife($cellsList);
        }
    }
}