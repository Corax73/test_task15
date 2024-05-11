<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images}}`.
 */
class m240505_153909_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%images}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'original_title' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()'))
        ]);

        $this->createIndex(
            'idx-images-author_id',
            'images',
            'title'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%images}}');
    }
}
