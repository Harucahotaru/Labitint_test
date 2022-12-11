<?php

use yii\db\Migration;

/**
 * Class m221211_172631_add_news_table
 */
class m221211_172631_add_news_table extends Migration
{
    const NEWS_TABLE = '{{%news}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::NEWS_TABLE, [
            'id' => $this->primaryKey()->comment('Id'),
            'title' => $this->string()->comment('Заголовок'),
            'announcement' => $this->text()->comment('Анонс'),
            'content' => $this->text()->notNull()->comment('Основной текст'),
            'tags' => $this->json()->comment('Теги'),
            'date_c' => $this->dateTime()->comment('Дата создания'),
        ]);
        $this->addCommentOnTable(self::NEWS_TABLE, 'Таблица новостей');
        $this->createIndex('title_index', self::NEWS_TABLE, [
            'title',
        ]);
        $this->createIndex('date_c_index', self::NEWS_TABLE, [
            'date_c',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::NEWS_TABLE);

        return true;
    }
}
