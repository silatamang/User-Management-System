<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

// Get values for the record to be added if from emp_add_action.php
$userid = $_POST["userid"];
$password = $_POST["password"];
$utype = $_POST["utype"];

// display the insertion form.
echo("
  <form method=\"post\" action=\"add_user_action.php?sessionid=$sessionid\">
  UserID: <input type=\"text\" value = \"$userid\" size=\"10\" maxlength=\"10\" name=\"userid\"> <br /> 
  Password: <input type=\"password\" value = \"$password\" size=\"20\" maxlength=\"30\" name=\"password\">  <br />
  ");

// display the department list in the insertion form.
// create the dropdown list for the departments.
$sql = "select distinct utype from users";

$result_array = execute_sql_in_oracle ($sql);
$result = $result_array["flag"];
$cursor = $result_array["cursor"];

if ($result == false){
  display_oracle_error_message($cursor);
  die("Query Failed.");
}

echo("
  Department (Required):
  <select name=\"utype\">
  <option value=\"\">Choose One:</option>
  ");

// fetch the departments from the cursor one by one and put into the dropdown menu
while ($values = oci_fetch_array ($cursor)){
  $utype = $values[0];
  echo($utype == utype);
  if (!isset($utype) or $utype == "" or $utype != $utype) {
    echo("
      <option value=\"$utype\">$utype</option>
      ");
  } else if ($utype == $values) {
	  echo('duplicate');
  }
  else {
    echo("
      <option selected value=\"$utype\">$utype</option>
      ");
  }
}
oci_free_statement($cursor);

echo("
  </select>
  <input type=\"submit\" value=\"Add\">
  <input type=\"reset\" value=\"Reset to Original Value\">
  </form>

  <form method=\"post\" action=\"display_users.php?sessionid=$sessionid\">
  <input type=\"submit\" value=\"Go Back\">
  </form>");
?>