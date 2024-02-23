<?php

declare(strict_types=1);

namespace app\models;

use yii\base\Model;

class LoginForm extends Model
{
    /**
     * @var string|null
     */
    public $username;

    /**
     * @var string|null
     */
    public $password;

    /**
     * @var bool
     */
    public $rememberMe = true;

    /**
     * @var User|null
     */
    private $_user = null;


    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [
                ['username', 'password'],
                'required',
            ],
            [
                ['rememberMe'],
                'boolean',
            ],
            [
                ['password'],
                'validatePassword',
            ],
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
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
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        $duration = $this->rememberMe ? (3600 * 24 * 30) : 0;

        return $this->validate() && \Yii::$app->user->login($this->getUser(), $duration);
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
