<?php

class RegisterForm extends CFormModel
{
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $address;
    public $phone_number;

    public function rules()
    {
        return [
            ['first_name, last_name, username, email, password, confirm_password, address, phone_number', 'required'],
            ['email', 'email'],
            ['username', 'unique', 'className' => 'User'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
            ['password', 'length', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'confirm_password' => 'Confirm Password',
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
        $user->role = 1; // customer
        
        if ($user->save()) {
            $customer = new Customer();
            $customer->address = $this->address;
            $customer->phone_number = $this->phone_number;
            $customer->user_id = $user->id;
            return $customer->save();
        }

        // DEBUG: Output errors if save fails
        var_dump($user->getErrors());
        exit;
    }
}
