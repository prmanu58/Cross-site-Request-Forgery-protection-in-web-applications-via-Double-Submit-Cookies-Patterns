<?php

//start session - server
session_start();


if(isset($_POST['submit123']))
{
    ob_end_clean(); //clean previous echo
    
    loginvalidate($_POST['XYZ'],$_COOKIE['session_id2'],$_POST['usrnm'],$_POST['usrpwd']);

}


//validate Login funtion
function loginvalidate($user_CSRF,$user_SID, $username, $password)
{
    if($username=="pramesh" && $password=="pramesh123" && $user_CSRF==$_COOKIE['csrf_token'] && $user_SID==session_id())
    {
        echo "<script> alert('Login Sucessful') </script>";
        echo "Welcome Pramesh Anuradha"."<br/>"; 
        apc_delete('CSRF_token');
    }
    else
    {
        echo "<script> alert('Login Failed!') </script>";
        echo "Login Failed!!! "."<br/>"."Failed to Authorize!";
        
    }
}


?>