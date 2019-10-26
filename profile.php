<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}
$DATABASE_HOST = 'sql107.epizy.com';
$DATABASE_USER = 'epiz_24346645';
$DATABASE_PASS = 'D3WNKOZQ05qCZw';
$DATABASE_NAME = 'epiz_24346645_Calls';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="shortcut icon" href="avatar.png" />
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Call System</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Index</h2>
			<div>
				<p>Your account details are below:</p>
				<form method="get" name="form" action="popup.php"> 
        			<input type="text" placeholder="Enter ID" name="idc"> 
        			<input type="submit" value="Submit"> 
    				</form>
				<table id="tableMain">
					<!--
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					-->
					<tr>
						<th>ID</th>
						<th>Username</th>
					</tr>
					<?php
					$DATABASE_HOST = 'sql107.epizy.com';
					$DATABASE_USER = 'epiz_24346645';
					$DATABASE_PASS = 'D3WNKOZQ05qCZw';
					$DATABASE_NAME = 'epiz_24346645_Calls';
					$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
					if (mysqli_connect_errno()) {
						die ('Failed to connect to MySQL: ' . mysqli_connect_error());
					}
					$sql = "SELECT id, username FROM clients";
					$result = $con-> query($sql);

					if ($result-> num_rows > 0) {
						while ($row = $result-> fetch_assoc()) {
							echo "<tr><td>". $row["id"] ."</td><td>". $row["username"] ."</td></tr>";
							
						}
					}
					echo "</table>"
					?>

				</table>
				
			</div>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	$(document).ready(function () {   
		 
                //=================================================================
                //click on table body
                $("#tableMain tbody tr").click(function () {
                //$('#tableMain tbody').on('click', 'tr', function() {
                    //get row contents into an array
                    var tableData = $(this).children("td").map(function() {
                        return $(this).text();
                    }).get();
                    var td=tableData[0];
					
		    	});
            });   
	 
	</script>
</html>