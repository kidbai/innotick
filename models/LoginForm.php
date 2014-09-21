<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\component\WebUser;
use app\models\Admin;
use app\models\Student;
use app\models\Teacher;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    private $_type = 1;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required', 'message' => '{attribute}不能为空'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
        ];
    }    

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', '用户名或密码错误');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login($type = WebUser::TYPE_STUDENT)
    {
        $this->_type = $type;

        if ($this->validate()) 
        {
            if ($this->_type == WebUser::TYPE_ADMIN) 
            {
                $this->rememberMe = false;
                return app()->admin->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            }

            return false;
        } 
        else 
        {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            if ($this->_type == WebUser::TYPE_ADMIN) 
            {
                $this->_user = Admin::findByUsername($this->username); 
            }
            
        }

        return $this->_user;
    }
}
