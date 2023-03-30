<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

// Here we can generate the content of the welcome page
echo("<h1> CHANGE YOUR PASSWROD HERE</h1>");
echo("<br />");
echo("
<FORM name='changepass' method='POST' action=\"changepassword_action.php?sessionid=$sessionid\"> 
Student ID: <INPUT type='text' name='userid' size='8' maxlength='8'> <br />
Password: <input type='password' name='password' size='12' > 
New Password: <input type='password' name='newpassword' size='12' > 
<INPUT type='submit' name='submit' value='submit'> 
</FORM>

");
?>