<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
            error_reporting(0);
            ini_set("display_errors", 0); 
 
                if($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    include_once('database.php');
                    $connection=connect("localhost","root","","youtube");
                    $errors=register($_POST['email'],$_POST['pass'],$connection);
                    if(count($errors)==0)
                    {
                        echo "Succes";
                    }
                    else
                    {
                        for ($i=0;$i<count($errors);$i++)
                            echo $errors[$i];
                    }
                }
              
                if(isset($_GET['r']))
                {
                    include_once('database.php');
                    if(!isset($connection))
                        $connection=connect("localhost","root","","youtube");
                    echo confirm_token($_GET['r'],$connection);
                  
                }
                if(isset($_GET['v'])) {
                        echo $_GET['v'];
                }     
        
        ?>
        <form id="registerId" name="register" method="POST">
            <input type="text" name="email">
            <input type="password" name="pass">
            <input type="submit" name="registerBtn" value="Register">
        </form>
        
    </body>
</html>
