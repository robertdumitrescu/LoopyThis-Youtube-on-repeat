<?php

 require("classes/database.php");


class Auth extends DatabaseQuery
{
    private $_siteKey;

    private $encryption_key = "abc";

    public function __construct()
    {
        $this->siteKey = 'my site key will go here';
    }


    private function randomString($length = 35)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function hashData($data)
    {
        return hash_hmac('sha512', $data, $this->_siteKey);
    }

    public function isAdmin()
    {
        $selection = 1;
        //$selection being the array of the row returned from the database.
        if ($selection['is_admin'] == 1) {
            return true;
        }

        return false;
    }


    public function createUser($email, $password, $is_admin = 0)
    {
        //Generate users salt
        $user_salt = $this->randomString();


        //Salt and Hash the password
        $password = $user_salt . $password;
        $password = $this->hashData($password);

        //Create verification code
        $verification_code = $this->randomString();


// PUNELE IN DB



        $message = parent::addUserToDb($email, $password, $user_salt, $verification_code);

        return $message;


    }

    public function getUserData($user_id){

        parent::fetchDbUserData($user_id);

    }

    public  function safe_b64encode($string) {

        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }


    public function encode($data){

        if(!$data){return false;}
        $text = $data;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->siteKey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext));

    }

    public function decode($encrypted_data){

        if(!$encrypted_data){return false;}
        $crypttext = $this->safe_b64decode($encrypted_data);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->siteKey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);

    }



    public function login($email, $password)
    {
        //Select users row from database base on $email
        $selection = 1;





        $login_connection_select_result = parent::findUserForLogin($email);



            while ($login_connection_select_result) {


                // echo $login_connection_select_result['email'];





                $password = $login_connection_select_result['user_salt'] . $password;
/*                echo "<br>";
                echo "<br>";
                echo $r['user_salt'];*/


                $password = $this->hashData($password);
/*                echo "<br>";
                echo "<br>";
                echo $password;*/




                $is_active = (boolean)$login_connection_select_result['is_active'];
                $is_verified = (boolean)$login_connection_select_result['is_verified'];
/*                echo $is_active;
                echo $is_verified;*/
                if ($password == $login_connection_select_result['password']) {

                    if (($is_active == true) && ($is_verified == true)) {

/*                        echo "Sucess";*/



                        $random = $this->randomString();
                        $token = $_SERVER['HTTP_USER_AGENT'] . $random;
                        $token = $this->hashData($token);
                        $user_agent = $_SERVER['HTTP_USER_AGENT'];
                        $session_id = 1;

                        $user_id = $login_connection_select_result['id'];
                        $encryption_key = $this->encryption_key;

                        $encrypted_user_id = $this->encode($user_id);
                        $time=time();
                        setcookie("athToken", $encrypted_user_id, time()+86400);


                        //Setup sessions vars
                        if (!isset($_SESSION)) {


                        session_start();


                        }



                        $message = parent::insertLoginSession($login_connection_select_result['id'], $session_id, $token, $user_agent);

/*                        echo "0";*/
                        return "0";

                    } else if (($is_active == true)){

                        echo "You're not an verified user";
/*                        echo "2";*/
                        return "2";


                    } else if ($is_verified == true){
                        echo "You're not an activated user";
/*                        echo "3";*/
                        return "3";
                    } else {
                        echo "You're not activated/verified";
/*                        echo "4";*/
                        return "4";
                    }

                } else {
                    echo "You're credentials are incorect";
/*                    echo "1";*/
                    return "1";
                }


            }



       /* } catch (PDOException $pe) {
            die("Could not connect to the database $dbname :" . $pe->getMessage());
        }*/


    }


    public function checkSession()
    {
        //Select the row
        $selection = 1;


        if ($selection) {
            //Check ID and Token
            if (session_id() == $selection['session_id'] && $_SESSION['token'] == $selection['token']) {
                //Id and token match, refresh the session for the next request
                $this->refreshSession();
                return true;
            }
        }

        return false;
    }

    public function logout()
    {

        session_destroy();

        if (isset($_COOKIE['PHPSESSID'])) {
            unset($_COOKIE['PHPSESSID']);
            setcookie('PHPSESSID', null, -1, '/');
        }

        if (isset($_COOKIE['athToken'])) {
            unset($_COOKIE['athToken']);
            setcookie('athToken', null, -1, '/');
        }

    }

    public function readCookie()
    {

        if (isset($_COOKIE["athToken"])) {

            $encrypted_user_id = $_COOKIE["athToken"];

        } else {

            $encrypted_user_id = "";

        }

        return $encrypted_user_id;

    }


    public function sendVerification($user_id)
    {

        $verification_code = 1;
        $email = 1;

        //$email = users email taken from table
        $subject = 'Your verification code';
        $header = 'Sent by my website';
        $message = 'Your verification code is' . $verification_code;

        mail($email, $subject, $message, $header);


    }

    public function checkMailAdress($email)
    {


        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

        if (preg_match($pattern, $email) == true) {

            return true;

        } else {

            return false;

        }

    }


}