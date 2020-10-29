<?
session_start();

if(!isset($_SESSION['aid']))
{
	header("location:index.php");	
}
include("connect.php");

if($_GET['id']!='')
{
	$getinfo = mysqli_query($link,'select * from detail_page where pgid = '.$_GET['id'].' ');
	while($info=mysqli_fetch_array($getinfo))
	{
			$title = $info['title'];
			$description = $info['description'];
			$image = $info['image'];
			$content = $info['content'];
			$search_index = $info['search_index'];
			$email = $info['email'];
	}
}
if($_POST['Submit'] == "Edit")
{
	$uptitle = $_POST['title'];
	$updesc = $_POST['description'];
	
	$file_name = $_FILES['image']['name'];
	
	$upemail = $_POST['email'];
	
	if($file_name!='')
	{
		  $file_size =$_FILES['image']['size'];
		  $file_tmp =$_FILES['image']['tmp_name'];
		  $file_type=$_FILES['image']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

		  $extensions= array("jpeg","jpg","png");
	
		  if(in_array($file_ext,$extensions)=== false){
			 header('location:edit_page.php?id='.$_GET['id'].'&error=extension not allowed, please choose a JPEG or PNG file.');
			  exit;
		  }

		  if($file_size > 2097152){
			 header('location:edit_page.php?id='.$_GET['id'].'&error=File size must be excately 2 MB');
			 exit; 
		  }
		  move_uploaded_file($file_tmp,"../image/".$file_name);	
	}	
	else
	{
		$file_name = $image;
	}	
	
	$upcontent = $_POST['editor1'];	
	
	$upoption = $_POST['option'];
	
	//check if page in db
	$check = mysqli_query($link,"select count(*) as count from detail_page where pgid = ".$_GET['id']."");
	$rcheck = mysqli_fetch_array($check);
	
	if($rcheck['count']==0)
	{
		mysqli_query($link,"insert into detail_page (pgid,title,description,image,content,search_index,email) values (".$_GET['id'].",'".$uptitle."','".$updesc."','".$file_name."','".$upcontent."','".$upoption."','".$upemail."') ");
	}
	else
	{
	mysqli_query($link,"update detail_page set title = '".$uptitle."' , description = '".$updesc."' , image = '".$file_name."', content = '".$upcontent."', search_index = '".$upoption."', email = '".$upemail."' where pgid = ".$_GET['id']." ");
	}
	
	header('location:edit_page.php?id='.$_GET['id'].'');
	
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
    <title>Edit Page</title> 
</head> 
  
<body> 
    <? include("menu.php");?>
<form method="post" enctype="multipart/form-data">
  <div class="textcontainer">
	  <label>Edit Page</label>
  </div>

  <div class="editcontainer">
	
	  <table>
		  <? if($_GET['error']!=''){ ?>
		 <tr>
			<td class="emsg" colspan="2"><? echo $_GET['error'];?></td>
		 </tr>	
		<? } ?>
	 
    <tr><td><b>Title:</b></td>
		<td><textarea name="title" required rows="20" columns="15"><? echo $title;?></textarea><td></tr>
	  
	<tr><td><b>Description:</b></td>
	  <td><textarea name="description" required rows="20" columns="15"><? echo $description;?></textarea> </td> </tr>
	  
	  
	 <tr><td><b>Background Image:</b></td>
	  <td><input type="file" name="image" <? if($image=='') { ?>required <? } ?>>
		 <img src="../image/<? echo $image;?>" width="60px" height="60px"></td>
	 </tr> 
     
	  <tr>
		  <td><b>Page Content:</b></td>
	  		<td><textarea name="editor1" required><? echo $content;?></textarea>
        <script>
            CKEDITOR.replace( 'editor1' );
        </script></td>
	  </tr>
	  
	  
	  <tr><td><b>Search Engine:</b></td>
	 <td> <input type="radio" name="option" value="yes" <? if($search_index=='yes'){?> checked <? } ?>>index
	  <input type="radio" name="option" value="no" <? if($search_index=='no'){?> checked <? } ?>>no-index
	</td>	 
	 </tr> 
	  
	  <?
	  if($_GET['id']==2)
	  { ?>
		 <tr><td><b>Email address:</b></td>
	  <td><input type="text" name="email" value="<? echo $email;?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
	  </td>
	 </tr>  
	  <? }
	  ?>
		  <tr></tr>
		  <tr><td></td>
		 <td > <input type="submit" name="Submit" value="Edit" class="editbtn"></td>
	  </tr>
	  </table>
    </div>

  
</form>
</body>
</html>