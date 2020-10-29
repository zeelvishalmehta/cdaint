<?
session_start();

if(!isset($_SESSION['aid']))
{
	header("location:index.php");	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  overflow: hidden;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
</head>
<body>

<div class="navbar">
  <a href="home.php">Home</a>
  		
   <a href="logout.php" >Logout</a>	
	
	
</div>	
	
<!--<div class="topnav">
  <a class="active" href="generate.php">Home</a>
  <a href="task.php">Daily Task</a>
  <a href="daily_fund.php">Daily Fund</a>
  <a href="table.php">Trash</a>
  <a href="help.php">Help desk</a>
  <a href="admin_withdrawal.php">Withdrawal</a>	
	<a href="online_withdrawal.php">Revenue</a>	
   <a href="demo_ticket.php">Demo</a> 
   <a href="game_ticket.php">Ticket select</a>	
	 <a href="auto_ticket_select.php">Auto Ticket select</a>
	<a href="upload_image.php">Upload Image</a>	
	<a href="package_cost.php">Package Cost</a>	
	<a href="users.php">Users</a>	
   <a href="admin_name.php">Auto Start</a>	
</div> -->

</body>
</html>
