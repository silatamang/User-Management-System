<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);


// Here we can generate the content of the welcome page
echo("<h1> WELCOME ADMIN</h1>");

echo("<UL>
  <LI><A HREF=\"changepassword.php?sessionid=$sessionid\">Change Password</A></LI>
  <LI><A HREF=\"display_users.php?sessionid=$sessionid\">List Users</A></LI>
  </UL>");
echo("<br />");
echo("<br />");
echo("Click <A HREF = \"logout_action.php?sessionid=$sessionid\">here</A> to Logout.");
?>