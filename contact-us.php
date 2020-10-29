<?
/*session_start();
if(!isset($_SESSION['lid']))
{
	header("location:login.php");	
}*/
include("connect.php");
$fullpagename =  basename($_SERVER['PHP_SELF']); /* Returns The Current PHP File Name */
$arr = explode(".", $fullpagename);
$pagename = $arr[0];

//get pageid from pagename
$pagesql = mysqli_query($link,"select pgid from pages where name = '".$pagename."' ");
$pagerow = mysqli_fetch_array($pagesql);

$pageid = $pagerow['pgid'];

//get all page details from db

$sql_details = mysqli_query($link,"select * from detail_page where pgid = '".$pageid."' ");
while($row=mysqli_fetch_array($sql_details))
{
	$title = $row['title'];	
	$desc = $row['description'];
	$img = $row['image'];
	$content = $row['content'];
	$search_index = $row['search_index'];
	$demail = $row['email'];
}


//get all tags details
$sqltag = mysqli_query($link,"select * from tags");
while($rtag=mysqli_fetch_array($sqltag))
{
	$google = $rtag['google'];	
	$facebook = $rtag['facebook'];	
	$remarketing = $rtag['remarketing'];	
}

if($_POST['submit']=='Submit')
{
	$name = $_POST['name'];	
	$email = $_POST['email'];	
	$comment = $_POST['comment'];	
	
	mysqli_query($link,"insert into contactus (name,email,comment) values ('".$name."','".$email."','".$comment."')");
	
								$to = $demail;
								$subject = 'Comment from ContactUS';
								$txt = "Name: ".$name."<br><br>";
								$txt .= "Email: ".$email."<br><br>";
								$txt .= "Comment: ".$comment."<br><br>";			
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$headers .= "From:".$email."\r\n";								
								mail($to,$subject,$txt,$headers); 
								
							   header('location:contact-us.php?succ=succ');
				
}


//get footer details
$footer = mysqli_query($link,"select * from footer");
$rfooter = mysqli_fetch_array($footer);

?>

<!doctype html>
<html lang="en">
	
	<head>
	<meta name="viewport" content="initial-scale=1 maximum-scale=1"/>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<title><? echo $title;?></title>
		<meta name="description" content="<? echo $desc;?>" />
		
		<? if($search_index=='no') { ?>
		<meta name="robots" content="noindex" />
		<? } ?>
		
		<link rel="stylesheet" type="text/css" media="screen" href="themes/styles.css"  />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/colourtag-page3.css"  />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/flexslider.css"  />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/contentcenter.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/sidenone.css" />
		
		
		<style type="text/css" media="all">#feature {background-image: url(image/<? echo $img;?>);}</style>
					
		
		<script type="text/javascript" src="themes/scripts/jquery-1.7.1.min.js"></script>
		
		<script type="text/javascript" src="themes/scripts/function.js"></script>
		<script type="text/javascript" src="themes/scripts/jquery.fitvids.js"></script>
		
		
		<meta property="og:image" content="image/<? echo $img;?>" />
		
<!-- Start Google Analytics -->
<? echo html_entity_decode($google, ENT_QUOTES);?>
<!-- end google-->	

<!-- Start facebook -->
<? echo html_entity_decode($facebook, ENT_QUOTES);?>	
<!-- end -->	
</head>
		
<body>


	<div id="wrapper">
	
		
<div id="hwrap">
			<header class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
			<div id="headwrap">
			
					<div id="titlelogo">
							<a href="https://cdainterview.com/">				
							<div id="logo"><img src="image/<? echo $rfooter['site_logo'];?>" width="167" height="100" alt="Site logo"/></div>	
							<h1></h1></a>
							<h2></h2>
					</div>
						
						
						<div id="mwrap">
							<div id="lt"></div>
							<div id="lm"></div>
							<div id="lb"></div>
						</div>
						
						
						<div id="nwrap">
							<div id="menuBtn"></div>
							<nav><ul class="navigation"><li><a href="index.php" rel="self">Main</a></li><li id="current"><a href="contact-us.php" rel="self" id="current">Contact Us</a></li></ul></nav>						
						</div>
				</div>
			</header>
		
			
				
				<div class="banner video_banner">
					<div id="feature">
					<div id="extraContainer11">
						<div class="videoWrapper">
								    
						</div>
					</div>
					
						<div id="extraContainer1">
						</div>
					
						
						<div class="banner-text">
						
						</div>
							<div id="extraContainer9"></div>
					</div>
					
					
				</div>	
					
					
								
			</div>												
				
		
					
	
			<div class="clear"></div>
			
		
			<div id="container">
					<div id="extraContainer7"></div>
					<div id="extraContainer8"></div>
							
							<section>
								
								<div id="padding">
									<div class="message-text">
										<? echo $content;?>
									</div><br />

									
									


<form  method="post" enctype="multipart/form-data">
	<div>
		<label>Name:</label> *<br />
		<input class="form-input-field" type="text" value="" name="name" size="40" required/><br /><br />

		<label>Email Address:</label> *<br />
		<input class="form-input-field" type="text" value="" name="email" size="40" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"/><br /><br />

		<label>How can we help you?</label> *<br />
		<textarea class="form-input-field" name="comment" rows="8" cols="38" required ></textarea><br /><br />
		<? if($_GET['succ']!=''){echo "Thank you, your email has been sent. We will get back to you shortly.";?><br>
		<a href="contact-us.php">Back</a>
		
		<? } else { ?><input class="form-input-button" type="submit" name="submit" value="Submit" /><? } ?>
	</div>
</form>

<br />
<div class="form-footer"><span style="font-size:15px; font-weight:bold; "><u>Note</u></span><span style="font-size:15px; ">: If you are having difficulties with our contact us form above, send us an email to <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="dab3b4bcb59ab8bfb7b5bbb9bbbebfb7b3b9b9b5b4a9afb6aeb3b4bdf4b9b5b7"><? echo $demail;?></a> </span><span style="font-size:13px; "><br /></span></div><br />

</div>
								
							</section>
						<div id="asidewrap">
							<aside>
								<div id="sidecontent">
									<div id="sideTitle"></div>	
									<? if($rfooter['facebook_url']!='') {?><a class= "social" href= "<? echo $rfooter['facebook_url'];?>" target="_blank"><img src="image/fb.png" width="30" ></a><? } ?>
									<? if($rfooter['twitter_url']!='') { ?><a class= "social" href= "<? echo $rfooter['twitter_url'];?>"><img src="image/twitter.png" width="30" ></a>	<? } ?>
									<? if($rfooter['linkdin_url']!='') { ?><a class= "social" href= "<? echo $rfooter['linkdin_url'];?>"><img src="image/linkdin.png" width="30" ></a>	<? } ?>	
									
								</div>	
							</aside>
						</div>	
						<div class="clear"></div>
				
								<div id="ecwrap"></div>
								<div id="ec2wrap">	<div id="extraContainer2"></div></div>
								<div id="ec3wrap">	<div id="extraContainer3"></div></div>
								<div id="ec4wrap">	<div id="extraContainer4"></div></div>
								<div id="ec5wrap">	<div id="extraContainer5"></div></div>
								<div id="ec6wrap">	<div id="extraContainer6"></div></div>

								<div id="extraContainer10"></div></div>		
						<footer>
						
							<div id="footer">
							<? 
								echo html_entity_decode($rfooter['content'], ENT_QUOTES);
							?>
							</div>
								
								<div id="socialicons">
								<div id="socialicons1"></div>
								</div>
							
						  </footer>
							
							
			</div>
			 			
					<a href="#" class="scrollup">Scroll</a>	
	
				
<!-- Start LiveStats -->
<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<? echo html_entity_decode($remarketing, ENT_QUOTES);?>

<!-- End LiveStats -->
</body>
</html>
