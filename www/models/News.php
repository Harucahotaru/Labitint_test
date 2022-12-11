<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "news".
 *
 * @property int $id Id
 * @property string|null $title Заголовок
 * @property string|null $announcement Анонс
 * @property string $content Основной текст
 * @property string|null $tags Теги
 * @property string|null $date_c Дата создания
 */
class News extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date_c',
                ],
                'value' => function () {
                    return Yii::$app->formatter->asDate('now', 'php:Y-m-d H:i:s');
                },
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['announcement', 'content'], 'string'],
            [['content'], 'required'],
            [['tags', 'date_c'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'title' => 'Заголовок',
            'announcement' => 'Анонс',
            'content' => 'Основной текст',
            'tags' => 'Теги',
            'date_c' => 'Дата создания',
        ];
    }
}
