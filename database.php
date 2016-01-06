<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function connect($host,$username,$password,$database) {
//    define("HOST","localhost");
//    define("USERNAME","root");
//    define("PASSWORD","");
//    define("DATABASE",'youtube');
    $link=mysqli_connect($host,$username,$password,$database) or die("Error " . mysqli_error($link)); 
    return $link;
    }
    
function register($email,$password,$passwordRe,$connection) {
    //test if user exists
    include_once('functions.php');
    $errors=  check_validity($email, $password,$passwordRe,$connection);
    if(count($errors)>0) {
        return $errors;
    }
    $k=0;
    if ($stmt = mysqli_prepare($connection, "SELECT id FROM users WHERE email=?")) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($col1);
    while ($stmt->fetch()) {
        $k++;
    }
    $stmt->close();
    if($k==0) //if the user doesn't exist in the database
    {
       include_once("functions.php");
       $generatedToken=  generate_token();
       $sql='INSERT INTO users(email,password,date_registration,generated_token) VALUES(?,SHA(?),NOW(),?)';
       $stmt = mysqli_prepare($connection,$sql);
       $stmt->bind_param("sss", $email,$password,$generatedToken);
       $stmt->execute();
       if(mysqli_affected_rows($connection)==0) {
         $errors[]='Unfortunately registration failed!';
         return $errors;
       }
       $stmt->close();
    }
        else
    {
        $errors[]="E-mail already registered!";
        return $errors;
    }}
    return $errors;     
}

function login($email,$password,$connection) {
    include_once('functions.php');
    $errors=check_validity_for_login($email, $password,$connection);
    if(count($errors)>0)
        return $errors;
    $k=0;
    if($stmt = mysqli_prepare($connection,"SELECT id FROM users WHERE email=? AND password=SHA1(?)")) {
    $stmt->bind_param("ss", $email,$password);
    $stmt->execute();
    $stmt->bind_result($col1);
        while ($stmt->fetch()) {
        $k++;
        }
    $stmt->close();
    if($k==1) {
            return $col1;
    }
    return 0;
}
    mysqli_stmt_close($stmt);             
}

function confirm_token($id,$connection)
{
    $id=trim($id);
    if(strlen($id)==40) {
        $id=mysqli_real_escape_string ($connection,$id);
        $sql='UPDATE users SET activated=1 WHERE generated_token=? LIMIT 1';
    if ($stmt = mysqli_prepare($connection,$sql)) {
    $stmt->bind_param("s", $id);
    $stmt->execute();
    if(mysqli_affected_rows($connection)==0) {
         $errors[]='Unfortunately there was a problem!';
         return $errors;
       }
    else {
        return "Welcome boss!";
    }
    $stmt->close();
    if($k==1) {
            return 1;
    }}
}}

function add_to_playlist($song_url,$user_id,$connection)
{
       include_once("functions.php");
}

function create_first_playlist($id_user,$connection)
{
       include_once("functions.php");
       $sql='INSERT INTO playlist VALUES(NULL,?,NULL)';
        if ($stmt = mysqli_prepare($connection,$sql)) {                 
       $stmt->bind_param("s", $id_user);
       $stmt->execute();
       if(mysqli_affected_rows($connection)==0) {
        return "Welcome abroad chief!";
       }
         $errors[]='Unfortunately a problem appeared when creating a playlist!';
         return $errors;
}}