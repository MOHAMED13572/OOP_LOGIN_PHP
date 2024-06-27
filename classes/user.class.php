<?php

Class User {
    private $dbh ; 

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }



public function Register(string $email, string $pwd){

$pwd = password_hash($pwd,PASSWORD_BCRYPT,['cost'=>12]); 

$sql = 'INSERT INTO users(user_email,user_pwd) values(?,?);';
$stmt = $this->dbh->prepare($sql);
$stmt->execute([$email,$pwd]);

}



public function Login(string $email, string $pwd){

//Query database for info based on username or email
    $sql = 'SELECT * FROM users WHERE user_email = ?;';
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([$email]);
    $result = $stmt->fetch();
//If info is found get info, else return error
if($result != null){

//if password matches return true, else return error
if(password_verify($pwd,$result['user_pwd']))
{
    session_start(); 
    $_SESSION['user_id'] = $result['user_id'];
    $_SESSION['user_email'] = $result['user_email'];
    return true;
}
    else return 'Wrong Password !'; 
    }else return 'Wrong Email !'; 

}

public function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();
    }

}