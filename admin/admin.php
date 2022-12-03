<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
include "config.php";

$sql = "SELECT * FROM form";

$result = $conn->query($sql);
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin Panel</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<style>

	</style>
	<body>
		<nav class="nav">
			<div class="nav_container">
				<div class="logo_holder">
					<a id="logo" href="../home/home.php">
						<img src="../photos/wma-logo.png" id="logo-img">
					</a>
				</div>
				<div class="redirect">
					<a href="welcome.php"><i class="fas fa-user-circle"></i>Profile</a>
					<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
				</div>
			</div>
		</nav>
		<div class="content">
			<h2>Dashboard</h2>
			<p>Welcome back, <?=$_SESSION['username']?>!</p>
		</div>

		<div class="applicants">
			<h2>Applicant Data</h2>

			<table class="table">
				<thead class="header">
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Address</th>
						<th>Phone Number</th>
						<th>BackUp Phone#</th>
						<th>EMail Address</th>
						<th>Profession</th>
						<th>Files Directory</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody> 
					<?php
						if ($result-> num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
					?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['firstname']; ?></td>
						<td><?php echo $row['lastname']; ?></td>
						<td><?php echo $row['address'] . ", " . $row['country'];?></td>
						<td><?php echo $row['phone_number']; ?></td>
						<td><?php echo $row['back_up']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['profession']; ?></td>
						<td>
							<a href="show_files.php?id=<?php echo $row['file']; ?>">
								<?php echo $row['file']; ?>
							</a>
						</td>
						<td>
							<a 	class="btn btn-danger" 
								href="delete.php?id=<?php echo $row['id']; echo $row['file'];?>">
								Delete
							</a>
						</td>
					</tr>                       
					<?php   
							}
						}
					?>                
				</tbody>
			</table>
		</div> 
	</body>
</html>