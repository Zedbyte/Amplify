<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;

    public function authenticate()
    {
        $user = User::model()->findByAttributes(['username' => $this->username]);

        if ($user === null) {
            Yii::log("Authentication failed: user '{$this->username}' not found", CLogger::LEVEL_ERROR);
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            Yii::log("Authentication failed: invalid username '{$this->username}'", CLogger::LEVEL_ERROR);
        } elseif (!CPasswordHelper::verifyPassword($this->password, $user->password)) {
            Yii::log("Authentication failed: invalid password for '{$this->username}'", CLogger::LEVEL_ERROR);
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            Yii::log("Authentication failed: invalid password for this: '{$this->username}'", CLogger::LEVEL_ERROR);
            Yii::log("Authentication failed: invalid password for user: '{$user->username}'", CLogger::LEVEL_ERROR);
        } else {
            $this->_id = $user->id;
            $this->setState('role', $user->role); // Set role in session
            $this->username = $user->username;
            $this->errorCode = self::ERROR_NONE;
            Yii::log("Authentication successful for '{$this->username}'", CLogger::LEVEL_INFO);
        }

        return !$this->errorCode;
    }


    public function getId()
    {
        return $this->_id;
    }
}