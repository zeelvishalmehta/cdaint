<?
session_start();

if(!isset($_SESSION['aid']))
{
	header("location:index.php");	
}

include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">   
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!--<meta http-equiv="X-UA-Compatible" content="ie=edge">-->
    <link rel="stylesheet" href="css/style.css">  
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet" />
	<title>ALl Page</title> 
</head> 
  
<body> 
    <? include("menu.php");?>
<form method="post">
  <div class="textcontainer">
	  <label>Edit Page</label>
  </div>

  <div class="container">
		<table border="1" id="pages">
			<tr>
				<td colspan="3">Page Name</td>
				
			</tr>	
			<?
			$get = mysqli_query($link,"select * from pages where status='active'");
			while($row=mysqli_fetch_array($get))
			{
				echo "<tr>";
				echo "<td>".$row['name']."</td>";
				echo "<td><a href=edit_page.php?id=".$row['pgid'].">Edit</a></td>";
				echo "</tr>";
			}
			?>
	   </table>	
  </div>

  
</form>
</body>
</html>