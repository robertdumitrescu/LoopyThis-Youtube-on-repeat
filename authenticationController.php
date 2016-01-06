<?php
require_once 'classes/auth.php';

// session_start();

$auth = new Auth();

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);

//var_dump($request);


if (property_exists($request, "userMail") && property_exists($request, "userPassword") && property_exists($request, "userRepeatedPassword")) {


//////////////////////////////////////////////////////////////////////////////
// REGISTER
//////////////////////////////////////////////////////////////////////////////


    $email = $request->userMail;
    $password = $request->userPassword;
    $repeatedPassword = $request->userRepeatedPassword;


    if ($auth->checkMailAdress($email) && ($password == $repeatedPassword)) {
        // Totul e valid, dam drumu la crearea userului

        $new_user_message = $auth->createUser($email, $password);

        if ($new_user_message == true) {
            echo "Successfully registration. Check your email adress for verification.";
        } else {
            echo "There was a problem in the registering process";
        }
    } else if ($auth->checkMailAdress($email)) {
        echo "The passwords doesn't match";
    } else if ($password == $repeatedPassword) {
        echo "Your e-mail adress looks invalid";
    } else if (!$auth->checkMailAdress($email) && !($password == $repeatedPassword)) {
        echo "Your e-mail adress is invalid and your passwords doesn't match";
    } else {
        echo "It was an unexpected error with your register credentials";
    }

} else if (property_exists($request, "loginUserMail") && property_exists($request, "loginUserPassword")) {

//////////////////////////////////////////////////////////////////////////////
// LOGIN
//////////////////////////////////////////////////////////////////////////////


    $login_email = $request->loginUserMail;
    $login_password = $request->loginUserPassword;

    if ($auth->checkMailAdress($login_email)) {
        echo $auth->login($login_email, $login_password);
    } else if (!$auth->checkMailAdress($login_email)){
        echo "Your e-mail adress looks invalid";
    } else {
        echo "Login unexpected error";
    }

} else if (property_exists($request, "logoutToken")) {

//////////////////////////////////////////////////////////////////////////////
// LOGOUT
//////////////////////////////////////////////////////////////////////////////


 $auth->logout();
/*    echo("lalala");
    var_dump($_COOKIE);*/

} else if (property_exists($request, "rdTkn")) {


//////////////////////////////////////////////////////////////////////////////
// Read Cookie
//////////////////////////////////////////////////////////////////////////////

/*    $login_email = $request->rdTkn;

    $id = $auth->decrypt_data($login_email);

echo($id);*/


    $current_cookie = $auth->readCookie();

    echo($current_cookie);

} else if (property_exists($request, "rdTkn2")) {


//////////////////////////////////////////////////////////////////////////////
// Read Cookie
//////////////////////////////////////////////////////////////////////////////

    /*    $login_email = $request->rdTkn;

        $id = $auth->decrypt_data($login_email);

    echo($id);*/

    $login_email = $request->rdTkn2;
    echo($auth->decode($login_email));




} else {

    echo "Server error: There was a problem with your request";
}







// echo "Asta e de pe server - email: " . $email;
// echo "Asta e de pe server - password: " .  $password;
// echo "Asta e de pe server - Repeatedpassword: " .  $repeatedPassword;


