<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client}}`.
 */
class m240708_031858_create_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'cpf' => $this->string()->unique(),
            'address' => $this->string(),
            'city' => $this->string(),
            'state' => $this->string(),
            'zip' => $this->string(),
            'photo' => $this->string(),
            'gender' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client}}');
    }
}
