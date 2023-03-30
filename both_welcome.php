<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);


echo("Click <A HREF = \"student_welcome.php?sessionid=$sessionid\">here</A> to go to your student user page.");
echo("<br />");
echo("Click <A HREF = \"admin_welcome.php?sessionid=$sessionid\">here</A> to go to your Administrator user page.");
echo("<br />");
echo("<br />");
echo("Click <A HREF = \"logout_action.php?sessionid=$sessionid\">here</A> to Logout.");
?>