<?
session_start();

if(!isset($_SESSION['aid']))
{
	header("location:index.php");	
}
include("connect.php");

	$getinfo = mysqli_query($link,'select * from footer');
	while($info=mysqli_fetch_array($getinfo))
	{
			$content = $info['content'];
			$facebook_url = $info['facebook_url'];
			$twitter_url = $info['twitter_url'];
			$linkdin_url = $info['linkdin_url'];
			$site_logo = $info['site_logo'];
			
	}

if($_POST['Submit'] == "Edit")
{
	$file_name = $_FILES['image']['name'];

	
	if($file_name!='')
	{
		  $file_size =$_FILES['image']['size'];
		  $file_tmp =$_FILES['image']['tmp_name'];
		  $file_type=$_FILES['image']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

		  $extensions= array("jpeg","jpg","png");
	
		  if(in_array($file_ext,$extensions)=== false){
			 header('location:edit_footer.php?error=extension not allowed, please choose a JPEG or PNG file.');
			  exit;
		  }

		  if($file_size > 2097152){
			 header('location:edit_footer.php?error=File size must be excately 2 MB');
			 exit; 
		  }
		  move_uploaded_file($file_tmp,"../image/".$file_name);	
	}	
	else
	{
		$file_name = $site_logo;
	}	
	
	$uupcontent = $_POST['editor1'];
	$furl = $_POST['furl'];
	$turl = $_POST['turl'];
	$lurl = $_POST['lurl'];
	
	
	$breaks = array("<br />","<br>","<br/>");  
    $upcontent = str_ireplace($breaks, "\r\n", $uupcontent);
	
	
	//check if page in db
	$check = mysqli_query($link,"select count(*) as count from footer");
	$rcheck = mysqli_fetch_array($check);
	
	if($rcheck['count']==0)
	{
		mysqli_query($link,"insert into footer (content,facebook_url,twitter_url,linkdin_url,site_logo) values ('".$upcontent."','".$furl."','".$turl."','".$lurl."','".$file_name."') ");
	}
	else
	{
	mysqli_query($link,"update footer set content = '".$upcontent."' , facebook_url = '".$furl."' , twitter_url = '".$turl."', linkdin_url = '".$lurl."', site_logo = '".$file_name."'");
	}
	
	header('location:edit_footer.php');
	
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
    <title>Edit Footer / Site Logo</title> 
</head> 
  
<body> 
    <? include("menu.php");?>
<form method="post" enctype="multipart/form-data">
  <div class="textcontainer">
	  <label>Edit Footer / Site Logo</label>
  </div>

  <div class="editcontainer">
	
	 <table>
	   <? if($_GET['error']!=''){ ?>
		 <tr>
			<td class="emsg" colspan="2"><? echo $_GET['error'];?></td>
		 </tr>	
		<? } ?>
	  <tr>
		  <td><b>Footer Content:</b></td>
	  		<td><textarea name="editor1" required><? echo $content;?></textarea>
        	<script>
            CKEDITOR.replace( 'editor1' );
        	</script>
		  </td>
	  </tr>
		 
	 <tr>
		  <td><b>Facebook Url:</b></td>
	  		<td><input type="text" name="furl" value="<? echo $facebook_url;?>" > </td>
	  </tr>	 
		 
	 <tr>
		  <td><b>Twitter Url:</b></td>
	  		<td><input type="text" name="turl" value="<? echo $twitter_url ;?>" > </td>
	  </tr>		
		 
	<tr>
		 	 <td><b>Linkdin Url:</b></td>
	  		<td><input type="text" name="lurl" value="<? echo $linkdin_url;?>" > </td>
	  </tr>		 
		 
	 <tr>
		 <td><b>Site Logo:</b></td>
	  	 <td><input type="file" name="image" <? if($site_logo=='') { ?>required <? } ?>>
		 <img src="../image/<? echo $site_logo;?>" width="60px" height="60px">
		 </td>	
	 </tr> 
    
	  
		 <tr><td></td>
		  <td><input type="submit" name="Submit" value="Edit" class="editbtn"></td>
	  </tr>
	  </table>
    </div>

  
</form>
</body>
</html>