<?
include "utility_functions.php";

// Get the client id and password and verify them
$userid = $_POST["userid"];
$password = $_POST["password"];
//$utype = $_POST["uype"];

$sql = "select * " .
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

  oci_free_statement($cursor);

  // found the user
  $userid = $values[0];
  $utype = $values[2];

  
  
  
  
  // create a new session for this client
  $sessionid = md5(uniqid(rand()));

  // store the link between the sessionid and the clientid
  // and when the session started in the session table

  $sql = "insert into usersession " .
    "(sessionid, userid, sessiondate) " .
    "values ('$sessionid', '$userid', sysdate)";

  $result_array = execute_sql_in_oracle ($sql);
  $result = $result_array["flag"];
  $cursor = $result_array["cursor"];
  if ($result == false){
    display_oracle_error_message($cursor);
    die("Failed to create a new session");
  }
  else if($utype == "Student") {
    header("Location:student_welcome.php?sessionid=$sessionid");
  }
  else if($utype == "Administrator"){
	header("Location:admin_welcome.php?sessionid=$sessionid");
  }
  else {
	  echo("<p>$utype anything</p>");
	header("Location:both_welcome.php?sessionid=$sessionid");
  }
}
else { 
  // client username not found
  
  die ('Login failed.  Click <A href="login.html">here</A> to go back to the login page.');
} 
?>
