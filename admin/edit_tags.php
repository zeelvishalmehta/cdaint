<?
session_start();

if(!isset($_SESSION['aid']))
{
	header("location:index.php");	
}
include("connect.php");

	$getinfo = mysqli_query($link,"select * from tags");
	while($info=mysqli_fetch_array($getinfo))
	{
			$dbgoogle = $info['google'];
			$dbfacebook = $info['facebook'];
			$dbremarketing = $info['remarketing'];
			
	}

if($_POST['Submit'] == "Edit")
{
		
	$oupgoogle = base64_encode($_POST['google']);
	$oupfacebook = base64_encode($_POST['facebook']);	
	$oupremarketing = base64_encode($_POST['remarketing']);
	
	//check if page in db
	$check = mysqli_query($link,"select count(*) as count from tags");
	$rcheck = mysqli_fetch_array($check);
	
	$breaks = array("<br />","<br>","<br/>");  
    $upgoogle = str_ireplace($breaks, "\r\n", $oupgoogle);
	$upfacebook = str_ireplace($breaks, "\r\n", $oupfacebook);
	$upremarketing = str_ireplace($breaks, "\r\n", $oupremarketing);
	
	
	if($rcheck['count']==0)
	{
		mysqli_query($link,"insert into tags (google,facebook,remarketing) values ('".$upgoogle."','".$upfacebook."','".$upremarketing."') ");
	}
	else
	{
	mysqli_query($link,"update tags set google = '".$oupgoogle."' , facebook = '".$upfacebook."' , remarketing = '".$upremarketing."' ");
	}
	
	header('location:edit_tags.php');
	
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
	<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <title>Edit Tags</title> 
	
</head> 
  
<body> 
    <? include("menu.php");?>
<form method="post" enctype="multipart/form-data">
  <div class="textcontainer">
	  <label>Edit Tags</label>
  </div>

  <div class="edittag">
	 
	 <table>
		<tr>
			<td>Google Analytics</td>
			<td>
			<textarea name="google" rows="5" cols="30"><? echo base64_decode($dbgoogle);?></textarea>
		  <!-- <script type="text/javascript">
			  CKEDITOR.replace( 'google' );
			  CKEDITOR.add            
		   </script>-->
			</td>
		 </tr>	
		 
		<tr>
			<td>Facebook</td>
			<td>
			<textarea name="facebook" rows="5" cols="30"><? echo base64_decode($dbfacebook);?></textarea>
			</td>
		 </tr>	
		 
		 <tr>
			<td>Remarketing</td>
			<td>
			<textarea name="remarketing" rows="5" cols="30"><? echo base64_decode($dbremarketing);?></textarea>
			</td>
		 </tr>	
		 
		 
		 <tr>
			<td></td>
			<td>
			<input type="submit" name="Submit" value="Edit" class="editbtn">
			</td>
		 </tr>	
		
	  </table>	
	
	
    </div>

  
</form>
</body>
</html>