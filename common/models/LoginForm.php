<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login(bool $adminRequired = false)
    {
        if ($this->validate()) {
            $rememberME = $this->rememberMe ? 3600 * 24 * 30 : 0;
            $userIdentity = $this->getUser($adminRequired);
            if (! $userIdentity) {
                return false;
            }
            return Yii::$app->user->login($userIdentity, $rememberME);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser(bool $adminRequired = false)
    {
        if ($adminRequired) {
            if ($this->_user === null) {
                $this->_user = User::findByUsername($this->username);
            }

            if ($this->_user && $this->_user->role !== User::ROLE_ADMIN) {
                // return an  type yii\web\IdentityInterface
                return null;

            }
        }

        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
