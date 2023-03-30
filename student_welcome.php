<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

// Here we can generate the content of the welcome page
echo("<h1> WELCOME Student</h1>");
echo("<br />");
echo("<br />");
echo("Click <A HREF = \"changepassword.php?sessionid=$sessionid\">here</A> to change password");
echo("<br/>");
echo("Click <A HREF = \"logout_action.php?sessionid=$sessionid\">here</A> to Logout.");
?>