
<!DOCTYPE html>

<html>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="avatar.png" />
	<?php

        $id = $_GET["idc"];
        $DATABASE_HOST = 'sql107.epizy.com';
        $DATABASE_USER = 'epiz_24346645';
        $DATABASE_PASS = 'D3WNKOZQ05qCZw';
        $DATABASE_NAME = 'epiz_24346645_Calls';
        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if (mysqli_connect_errno()) {
            die ('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        // We don't have the password or email info stored in sessions so instead we can get the results from the database.
        $stmt = $con->prepare('SELECT username, phonenum FROM clients WHERE id = ?');
        // In this case we can use the account ID to get the account info.
        $stmt->bind_param('i', $_GET["idc"]);
        $stmt->execute();
        $stmt->bind_result($user, $phone);
        $stmt->fetch();
        $stmt->close();	
        echo "The ID is: " . $id . "<br>";
        echo "The username is: " . $user . "<br>";
        echo "The phone number is: " . $phone . "<br>";
    ?>
    <form action="action.php" method="POST">
        <input  type="checkbox" id="maincheck" onclick="mainfunc()" value="1">Called<br>
        <div style="display: none" id="main">
        <p>Answer status</p>
        <input id="radio" type="radio" name="answerend" value="answer">Answer<br>
        <input id="radio" type="radio" name="answerend" value="noanswer">No answer<br>
        <input id="radio" type="radio" name="answerend" value="busy">Busy<br>
        <p> </p>
        <input id="check" onclick="myFunction()" type="checkbox" name="reserved" value="1">Reserved<br>
        <p> </p>
        <div id="div1" style="display: none">
        <p>When is the reserve</p>
        <input type="date" name="fdate" placeholder="From"><input type="time" name="ftime">
        <p>-</p>
        <input type="date" name="tdate" placeholder="To"><input type="time" name="ttime">
        <p> </p>
        </div>
        <input type="submit" name="submit" value="Submit"><br>
    </div>
    </form>



<script>
function mainfunc() {
  // Get the checkbox
  var checkBox = document.getElementById("check");
  // Get the output text
  var text = document.getElementById("div1");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}
function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("maincheck");
  // Get the output text
  var text = document.getElementById("maindiv");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}
</script>
</html>