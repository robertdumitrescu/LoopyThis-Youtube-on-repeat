<?php

    if(!isset($_SESSION))
    {
        session_start();
    }

$config_file = file_get_contents("config/config.json");
$config_file_parsed=json_decode($config_file,true);
$GLOBALS['v'] = $config_file_parsed;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registerBtn'])) {
    include_once('database.php');
    $connection = connect($config_file_parsed["database"]["host"], $config_file_parsed["database"]["user"], $config_file_parsed["database"]["pass"], $config_file_parsed["database"]["database"]);
    $errors = register($_POST['emailRegister'], $_POST['passwordRegister'], $_POST['passwordReRegister'], $connection);
    if (count($errors) == 0) {
        echo "<script>"."generate_snackbar('Success!');"."</script>";
    } else {
        $i = 0;
        $total=$errors[$i];
        for ($i = 0; $i < count($errors); $i++) {
            $total=$total.$errors[$i]." ";    
        }
        echo "<script>"."generate_snackbar("."'"."$total"."'".");"."</script>";
        }
       
        
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginBtn'])) {
    include_once('database.php');
    $connection = connect($config_file_parsed["database"]["host"], $config_file_parsed["database"]["user"], $config_file_parsed["database"]["pass"], $config_file_parsed["database"]["database"]);
    $choice = login($_POST['loginEmail'], $_POST['loginPassword'], $connection);
    if ($choice >= 1) {
        $_SESSION['email']=$_POST['loginEmail'];
        $_SESSION['id'] = session_generator();
        $_SESSION['real_id']=$choice;
    } else {
        echo "<script>"."generate_snackbar('Login credentials are wrong!');"."</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logoutBtn'])) {
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        session_destroy();
        $_SESSION = array();
    }
}

function verify_authenticity($ipUser)
{
    $config_file_parsed=$GLOBALS['v'];
    include_once('database.php');

$connection = connect($config_file_parsed["database"]["host"], $config_file_parsed["database"]["user"], $config_file_parsed["database"]["pass"], $config_file_parsed["database"]["database"]);
if($stmt = mysqli_prepare($connection,"SELECT attempt FROM blocked_ip WHERE ip=?")){
    $k=0;
    $stmt->bind_param("s", $ipUser);
    $stmt->execute();
    $stmt->bind_result($col1);
    while ($stmt->fetch()) {
        $k++;
    }
    
    if($k>=3) {
        exit();
    }
    $stmt->close();
}}

function block_temporary($ipUser) {
    $config_file_parsed=$GLOBALS['v'];
    include_once('database.php');

$connection = connect($config_file_parsed["database"]["host"], $config_file_parsed["database"]["user"], $config_file_parsed["database"]["pass"], $config_file_parsed["database"]["database"]);
if($stmt = mysqli_prepare($connection,"SELECT attempt FROM blocked_ip WHERE ip=?")){
    $k=0;
    $stmt->bind_param("s", $ipUser);
    $stmt->execute();
    $stmt->bind_result($col1);
    echo 'salam: '.$col1;
        while ($stmt->fetch()) {
        $k++;
       // printf("%i %i", $col1,$k);
    }
    echo $col1;
    $sql='';
    if($col1==0) {
        $temp="'".$ipUser."'";
        $sql="INSERT INTO `blocked_ip` VALUES (NULL,$temp,NOW(),NOW(),1)";
        }
    if($col1==1)
        $sql="UPDATE `blocked_ip` SET `start_date`=NOW(),`end_date`=NOW() + INTERVAL 1 HOUR,`attempt`=2 WHERE ip="."'".$ipUser."'";
    if($col1==2)
        $sql="UPDATE `blocked_ip` SET `start_date`=NOW(),`end_date`=NOW() + INTERVAL 1000 HOUR,`attempt`=3 WHERE ip="."'".$ipUser."'";

    echo $sql;
    if($col1>=0&&$col1<3) {
        mysqli_query($connection,$sql);
        //echo "<h1>afectate:</h1>".mysqli_affected_rows($connection);
    }
    $stmt->close();
}}