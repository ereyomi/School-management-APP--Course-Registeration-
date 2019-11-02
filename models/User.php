<?php

namespace app\models;

use yii;
use yii\base\Model;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;



class User extends ActiveRecord implements IdentityInterface
{
    /*
    * default is students type
    */
    const DEFAULT = 0;

    const ADMIN = 1;

    public $password_repeat;

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            [['fullname', 'email', 'password', 'password_repeat'], 'required'],
            ['email', 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password']
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

    public function validatePassword($password)
    {
        if (Yii::$app->getSecurity()->validatePassword($password, $this->password)) {
            // all good, logging user in
            return true;
        } else {
            // wrong password
            return false;
        }
    }

    public function findByEmail($email){
        return User::findOne(['email' => $email]);
    }
    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        //return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            /*if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }*/
            if (isset($this->password)) {
                $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
                $this->type = self::DEFAULT;
                return parent::beforeSave($insert);
            }
        }
        return true;
    }

    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['user_id' => 'id'])->where(['type' => self::DEFAULT]);
    }


}
