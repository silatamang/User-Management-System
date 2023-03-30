<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

// Verify how we reach here
if (!isset($_POST["update_fail"])) { // from display_users.php
  // Get the user id, fetch the record to be updated from the database 
  $q_userid = $_GET["userid"];

  $sql = "select userid, password, utype from users where userid = '$q_userid'";

  $result_array = execute_sql_in_oracle ($sql);
  $result = $result_array["flag"];
  $cursor = $result_array["cursor"];

  if ($result == false){
    display_oracle_error_message($cursor);
    die("Query Failed.");
  }

  $values = oci_fetch_array ($cursor);
  oci_free_statement($cursor);

  $userid = $values[0];
  $password = $values[1];
  $utype = $values[2];
}
else { // from update_user_action.php
  // Get the values of the record to be updated directly
  $userid = $_POST["userid"];
  $password = $_POST["password"];
  $utype = $_POST["utype"];
}

// display the record to be updated.  
echo("
  <form method=\"post\" action=\"user_update_action.php?sessionid=$sessionid&userid=$userid&utype=$utype\">
  UserID: $userid <br /> 
  User Type: <select name=\"combobox\"> 
  <option value=\"Administrator\">Administrator</option>
  <option value=\"Student\">Student</option>
  <option value=\"Both\">Both</option>
</select>  <br />
<input type=\"submit\" value=\"Update\">


  </form>

  <form method=\"post\" action=\"display_users.php?sessionid=$sessionid\">
  <input type=\"submit\" value=\"Go Back\">
  </form>
  ");
  
  
?>