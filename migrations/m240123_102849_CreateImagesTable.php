<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images}}`.
 */
class m240123_102849_CreateImagesTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%images}}', [
            'id' => $this->smallInteger()->unsigned()->unique(),
            'status' => $this->string(),
            'created_at' => $this->integer()->unsigned(),
            'updated_at' => $this->integer()->unsigned(),
        ]);

        $this->addPrimaryKey('images_pk', 'images', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%images}}');
    }
}
