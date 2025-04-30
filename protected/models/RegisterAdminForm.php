<?php

class RegisterAdminForm extends CFormModel
{
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $confirm_password;

    public function rules()
    {
        return [
            ['first_name, last_name, username, email, password, confirm_password', 'required'],
            ['email', 'email'],
            ['username', 'unique', 'className' => 'User'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
            ['password', 'length', 'min' => 6],
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = CPasswordHelper::hashPassword($this->password);
        $user->role = 2; // admin

        return $user->save();
    }
}
