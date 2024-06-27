<?php

class Validate{
private $email; 
private $pwd;
private $confirmPwd;
private $dbh;

public function __construct(string $email , string $pwd ,string $confirmPwd, object $dbh) {
    $this->email = $email;
    $this->pwd = $pwd;
    $this->dbh = $dbh;
    $this->confirmPwd = $confirmPwd;
}


protected function isInputEmpty():bool
{
    return (empty($this->email) || empty($this->pwd)); 
}

protected function isInvalidEmail():bool
{
    return !filter_var($this->email,FILTER_VALIDATE_EMAIL); 
}

protected function isEmailTaken():bool
{
    $sql = 'SELECT user_email FROM users WHERE user_email = ?;';
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([$this->email]);
    $result = $stmt->fetch();
    return ($result!=null); 
}

protected function isPasswordShort():bool
{
    return (strlen($this->pwd)<8); 
}

protected function passwordNotConfirmed():bool
{
    return ($this->pwd != $this->confirmPwd); 
}

protected function isPasswordWeak():bool
{

$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&^])[A-Za-z\d@.#$!%*?&]{8,63}$/';
return !preg_match($pattern, $this->pwd);
}


public function validate(){
if($this->isInputEmpty()){return 'Input empty!';}else
if($this->isInvalidEmail()){return 'Invalid email!';}else
if($this->isEmailTaken()){return 'Email taken!';}else
if($this->isPasswordShort()){return 'Password is too short!';}else
if($this->isPasswordWeak()){return 'Password is week!';}else
if($this->passwordNotConfirmed()){return 'Password didnt confirmed!';}else
return 'validated';
}


}
