<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $password_hash
 * @property string $phone
 * @property string $email
 * @property string $access_token
 * @property string $create_time
 * @property string $auth_key
 *
 * @property Product[] $products
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time'], 'safe'],
            [['username'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 30],
            [['password_hash'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 50],
            [['access_token', 'auth_key'], 'string', 'max' => 64],
            [['phone'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'password_hash' => 'Password Hash',
            'phone' => 'Phone',
            'email' => 'Email',
            'access_token' => 'Access Token',
            'create_time' => 'Create Time',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * Finds an identity by username
     * @param null $username
     * @return null|static
     */
    public static function findByUsername($username = null) {
        return static::findOne(['username' => $username]);
    }

    /**
     * Validates password
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return void whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * Generated random accessToken with timestamp
     * @throws \yii\base\Exception
     */
    public function generateAccessToken() {
        $this->access_token = Yii::$app->security->generateRandomString() . '-' . time();
    }

    /**
     * Validates if accessToken expired
     * @param null $token
     * @return bool
     */
    public static function validateAccessToken($token = null) {
        if ($token === null) {
            return false;
        } else {
            $timestamp = (int) substr($token, strrpos($token, '-') + 1);
            $expire = Yii::$app->params['user.accessTokenExpire'];
            return $timestamp + $expire >= time();
        }
    }
}
