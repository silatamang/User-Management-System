<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

// suppress php auto warning.
ini_set( "display_errors", 0);  

// obtain input from dept_delete.php
$userid = $_GET["userid"];
$password = $_POST["password"];
$utype = $_GET["utype"];

//$sql = "select dnumber, dname, location from dept where dnumber = $q_dnumber";
// Form the sql string and execute it.
$sql = " DELETE FROM usersession WHERE userid='$userid'";



$result_array = execute_sql_in_oracle ($sql);
$sql = " DELETE FROM users WHERE userid='$userid'";
$result_array = execute_sql_in_oracle ($sql);

$result = $result_array["flag"];
$cursor = $result_array["cursor"];

if ($result == false){ // error unlikely
  display_oracle_error_message($cursor);
  die("Client Query Failed.");
}

if (!($values = oci_fetch_array ($cursor))) {
  // Record already deleted by a separate session.  Go back.
  //Header("Location:display_users.php?sessionid=$sessionid");

}
oci_free_statement($cursor);

// Record deleted.  Go back automatically.
Header("Location:display_users.php?sessionid=$sessionid");
?>