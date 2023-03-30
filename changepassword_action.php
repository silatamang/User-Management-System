<?
include "utility_functions.php";
$sessionid =$_GET["sessionid"];
verify_session($sessionid);

// Get the client id and password and verify them
$userid = $_POST["userid"];
$password = $_POST["password"];
$newpassword = $_POST["newpassword"];
//$utype = $_POST["uype"];

$sql = "select userid " .
       "from users " .
       "where userid='$userid'
         and password ='$password'";

$result_array = execute_sql_in_oracle ($sql);
$result = $result_array["flag"];
$cursor = $result_array["cursor"];

if ($result == false){
  display_oracle_error_message($cursor);
  die("Client Query Failed.");
}
  
if($values = oci_fetch_array ($cursor)){

 /* oci_free_statement($cursor);

  // found the client
  $userid = $values[0];

  // create a new session for this client
  $sessionid = md5(uniqid(rand()));

  // store the link between the sessionid and the clientid
  // and when the session started in the session table

  $sql = "insert into usersession " .
    "(sessionid, userid, sessiondate) " .
    "values ('$sessionid', '$userid', sysdate)";

  $result_array = execute_sql_in_oracle ($sql);
  $result = $result_array["flag"];
  $cursor = $result_array["cursor"];*/

  if ($result == false){
    display_oracle_error_message($cursor);
    die("Failed to create a new session");
  }
  else {
    // insert OK - we have created a new session
	
	//echo("<h1>NOT WORKING</h1>");
	$sql = "UPDATE users SET password='$newpassword' WHERE userid='$userid'";
	execute_sql_in_oracle ($sql);
	
    header("Location:student_welcome.php?sessionid=$sessionid");
  }
}
else { 
  // client username not found
  
  die ('Login failed.  Click <A href="login.html">here</A> to go back to the login page.');
} 
?>
