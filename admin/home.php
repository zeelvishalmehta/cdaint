<?
session_start();

if(!isset($_SESSION['aid']))
{
	header("location:index.php");	
}
?>
<!DOCTYPE html>
<html lang="en">   
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!--<meta http-equiv="X-UA-Compatible" content="ie=edge">-->
    <link rel="stylesheet" href="css/style.css">  
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet" />
    <title>Home Page</title> 
</head> 
	
<body>
	<? include("menu.php");?>
	<div class="main">
		<table class="innermain" width="60%">
			<tr><td colspan="4" class="admin"><u>WELCOME ADMIN</u></td></tr>
			
			<tr class="rowedit">
				<td width="20%" class="tdedit"><a href="all_page.php">Active Pages</a></td>
				<td width="40%"><b>NOTE:</b> All pages are activated and go inside it and select a particular page for further edit.</td>				
			</tr>	
			
			<tr class="rowedit">
				<td width="20%" class="tdedit"><a href="edit_tags.php" class="tdedit">Tracking Pixels</a></td>
				<td width="40%"><b>NOTE: </b>Please will submit google analytics, facebook and remarketing tags and it will auto implemented for all activated pages.</td>				
			</tr>	
			
			<tr class="rowedit">
				<td width="20%" class="tdedit"><a href="edit_footer.php" class="tdedit">Footer / Site Logo</a></td>
				<td width="40%"><b>NOTE: </b> Easy to edit website logo and footer section and it will auto implemented for all activated pages.</td>				
			</tr>	
			
						
		</table>	
	</div>	
</body>	
	
</html>	
	
	