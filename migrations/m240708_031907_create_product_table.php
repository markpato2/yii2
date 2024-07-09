<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m240708_031907_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'price' => $this->decimal(),
            'client_id' => $this->integer(),
            'photo' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk-product-client_id',
            'product',
            'client_id',
            'client',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
