<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $cpf
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property string|null $photo
 * @property string|null $gender
 *
 * @property Product[] $products
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'cpf', 'address', 'city', 'state', 'zip', 'photo', 'gender'], 'string', 'max' => 255],
            [['cpf'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cpf' => 'Cpf',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'photo' => 'Photo',
            'gender' => 'Gender',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['client_id' => 'id']);
    }
}
