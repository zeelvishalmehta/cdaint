<?

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
}

//get all tags details
$sqltag = mysqli_query($link,"select * from tags");
while($rtag=mysqli_fetch_array($sqltag))
{
	$google = $rtag['google'];	
	$facebook = $rtag['facebook'];	
	$remarketing = $rtag['remarketing'];	
}

//get footer details
$footer = mysqli_query($link,"select * from footer");
$rfooter = mysqli_fetch_array($footer);
?>

<!doctype html>
<html lang="en">
	
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="google-site-verification" content="XHAz5PWm2RHaIVuVJQ-gwi54Wn5O-LVlXL7QCExSSzA" />
	<meta name="online" content="true">
	<meta name="viewport" content="initial-scale=1 maximum-scale=1"/>	
	
		<title><? echo $title;?></title>	
		
		<meta name="description" content="<? echo $desc;?>" />
		
		<? if($search_index=='no') { ?>
		<meta name="robots" content="noindex" />
		<? } ?>
		
		
		<link rel="stylesheet" type="text/css" media="screen" href="themes/styles.css"  />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/colourtag-page0.css"  />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/olight90.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/sidenone.css" />		
		<style type="text/css" media="all">#feature {background-image: url(image/<? echo $img;?>);}</style>
		<script type="text/javascript" src="themes/scripts/jquery-1.7.1.min.js"></script>		
		<script type="text/javascript" src="themes/scripts/function.js"></script>
		<script type="text/javascript" src="themes/scripts/jquery.fitvids.js"></script>
		<meta property="og:image" content="image/<? echo $img;?>" />
		
	
		
<!-- Start Google Analytics -->
<? //echo html_entity_decode($google, ENT_QUOTES);
	echo base64_decode($google);		
?>

<!-- end google-->	

<!-- Start facebook -->
<? echo base64_decode($facebook);?>	
<!-- end -->		

</head>
		
<body>

<div id="wrapper">
<div id="hwrap">
			<header class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
			<div id="headwrap">
			
					<div id="titlelogo">
							<a href="https://cdainterview.com/">				
							<div id="logo"><img src="image/<? echo $rfooter['site_logo'];?>" width="167" height="100" 

alt="Site logo"/></div>	
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
							<nav><ul class="navigation"><li id="current"><a href="index.php" rel="self" id="current">Main</a></li><li><a href="contact-us.php" rel="self" >Contact Us</a></li></ul></nav>						
						</div>
				</div>
			</header>
		
				 <div class="banner video_banner">
					<div id="feature">
					<div id="extraContainer11">
						<div class="videoWrapper">
								    
						</div>
					</div>					
				
					</div>
					
				</div>	
					
			</div>												
				
	 	<div class="clear"></div>
			
		
			<div id="container">
					
					<section>
								
					<div id="padding">

					<!-- Stacks v1198 -->
						<div id='stacks_out_7815_page0' class='stacks_top'>
							<div id='stacks_in_7815_page0' class=''>
								<div id='stacks_out_7822_page0' class='stacks_out'>
									<div id='stacks_in_7822_page0' class='stacks_in com_joeworkman_stacks_justifytext_stack'>
										<? echo $content;?>
									</div></div></div></div>
					<!-- End of Stacks Content -->


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
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and 

instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->

<? echo base64_decode($remarketing);?>
	
<!-- End LiveStats -->
</body>
</html>
