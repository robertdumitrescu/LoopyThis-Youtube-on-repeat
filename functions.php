<?php
if(!isset($_SESSION))
{
    session_start();
}
function generate_token() {
    return sha1(uniqid(mt_rand().date('Y-m-d H:i:s'), true));
}

function check_validity($email,$password,$passwordRe,$connection) {
     $server_errors=array();
     $email=  mysqli_real_escape_string($connection,trim($email));
     $password=mysqli_real_escape_string($connection,trim($password));
     $passwordRe=mysqli_real_escape_string($connection,trim($passwordRe));
     if(strlen($email)<4||strlen($password)<4) {
         $server_errors[]='Your email or password is too short!';
         return $server_errors;
     }
     if(strcmp($password, $passwordRe)!=0) {
         $server_errors[]="The passwords do not match!";
         return $server_errors;
     }
     if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
         $server_errors[]="You have to provide a valid email!";
         return $server_errors;
     }
     return;
}

function session_generator() {
    $session=md5($_SERVER['HTTP_USER_AGENT'].uniqid(mt_rand().date('Y-m-d H:i:s'), true));
    return $session;
}

function check_validity_for_login($email,$password,$connection) {
         $server_errors=array();
     $email=  mysqli_real_escape_string($connection,trim($email));
     $password=mysqli_real_escape_string($connection,trim($password));
     if(strlen($email)<4||strlen($password)<4) {
         $server_errors[]='Your email or password is too short!';
         return $server_errors;
     }
     if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
         $server_errors[]='You have to provide a valid email!';
         return $server_errors;
     }
     return;
}