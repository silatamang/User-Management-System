<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);


// Generate the query section

echo("
  <form method=\"post\" action=\"display_users.php?sessionid=$sessionid\">
  UserID: <input type=\"text\" size=\"5\" maxlength=\"12\" name=\"userid\"> 
  Password: <input type=\"text\" size=\"20\" maxlength=\"12\" name=\"password\">
  User Type: <input type=\"text\" size=\"20\" maxlength=\"20\" name=\"user_type\">   
  <input type=\"submit\" value=\"Search\">
  </form>

  <form method=\"post\" action=\"admin_welcome.php?sessionid=$sessionid\">
  <input type=\"submit\" value=\"Go Back\">
  </form>

  <form method=\"post\" action=\"add_new_user.php?sessionid=$sessionid\">
  <input type=\"submit\" value=\"Add A New User\">
  </form>
  ");
  
  $userid = $_POST["userid"];
  $password = $_POST["password"];
  $user_type = $_POST["user_type"];
  
  $whereClause = " 1=1 ";
  
if (isset($userid) and trim(userid)!= "") { 
  $whereClause .= " and userid like = '%$userid'"; 
}

if (isset($password) and $password!= "") { 
  $whereClause .= " and password like '%$password%'"; 
}

if (isset($user_type) and $user_type!= "") { 
  $whereClause .= " and user_type like '%$user_type%'"; 
}

$sql = "select userid, password, utype from users where $whereClause order by userid";

$result_array = execute_sql_in_oracle ($sql);
$result = $result_array["flag"];
$cursor = $result_array["cursor"];

if ($result == false){
  display_oracle_error_message($cursor);
  die("Client Query Failed.");
}

echo "<table border=1>";
echo "<tr> <th>UserID</th> <th>Password</th> <th>User Type</th> <th>Update</th> <th>Delete</th> <th>Reset Default Password</th></tr>";

while ($values = oci_fetch_array ($cursor)){
  $userid = $values[0];
  $password = $values[1];
  $user_type = $values[2];
  echo("<tr>" . 
    "<td>$userid</td> <td>$password</td> <td>$user_type</td> ".
    " <td> <A HREF=\"update_user.php?sessionid=$sessionid&userid=$userid\">Update</A> </td> ".
    " <td> <A HREF=\"delete_user.php?sessionid=$sessionid&userid=$userid\">Delete</A> </td> ".
	" <td> <A HREF=\"reset_default_password.php?sessionid=$sessionid&userid=$userid\">Reset Default Password</A> </td> ".
    "</tr>");
}
oci_free_statement($cursor);

echo "</table>";
?>
