<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password
 * @property string|null $name
 * @property string|null $auth_key
 * @property string|null $access_token
 */
class User extends ActiveRecord implements IdentityInterface
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'name', 'auth_key', 'access_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['auth_key'], 'unique'],
            [['access_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'name' => 'Name',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given access token.
     *
     * @param string $token the access token to be looked for
     * @param string|null $type the type of the token. For example, 'bearer' and 'refresh'.
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Returns the ID of the current user.
     *
     * @return string|int the ID of the current user.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the authentication key used for cookie-based login.
     *
     * @return string the authentication key.
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given authentication key.
     *
     * @param string $authKey the given authentication key.
     * @return bool whether the given authentication key is valid.
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Finds a user by the given username.
     *
     * @param string $username the username to be looked for
     * @return static|null the user object that matches the given username.
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Validates the password against the hashed password stored in the database.
     *
     * @param string $password the password to be validated
     * @return bool whether the password is valid
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates a new access token for the user and saves it.
     */
    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString();
        $this->save(false); // Save without validating again
    }

    /**
     * Generate access token after saving the user.
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert && !$this->access_token) {
            $this->generateAccessToken();
        }
    }
}
