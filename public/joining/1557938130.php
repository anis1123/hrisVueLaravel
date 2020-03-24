<?php
ob_start();

$cache = 1;

date_default_timezone_set("Asia/Kathmandu");

/*if($_SERVER['QUERY_STRING']==""){
  //echo "home";
  // TOP of your script
  //$cachefile = 'cache/'.basename($_SERVER['REQUEST_URI']);
  $cachefile = 'cache/index.html';
  $cachetime = 5 * 60; // 2 hours
  //$cachetime = 1;
  // Serve from the cache if it is younger than $cachetime
  if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
	if($cache==1){
	  include($cachefile);
	  echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->";
	  exit;
	}
  }
}*/
//echo $cachefile;

session_start();
error_reporting(E_ALL);
error_reporting(E_ERROR);

function striptags(&$value, $key) {
  $value = strip_tags($value, ENT_QUOTES);
}

array_walk($_POST, 'striptags');
array_walk($_GET, 'striptags');

include "data/conn.php";
include "data/constants.php";
include "data/sqlinjection.php";
include "data/youtubeimagegrabber.php";

include "data/groups.php";
include "data/listings.php";
include "data/listingfiles.php";
include "data/galleries.php";
include "data/videos.php";

include("data/news.php");
include("data/generalvideos.php");
include("data/polls.php");
include("data/adds.php");
include("data/comments.php");
include("data/categories.php");
include("data/videocategories.php");
include("data/photos.php");
include("data/excerpt.php");
include("data/menu.php");
include "data/testimonials.php";
require_once("data/metahome.php");
require_once("data/horoscopes.php");
require_once("data/status.php");

$groups = new Groups();
$listings = new Listings();
$listingFiles = new ListingFiles();
$galleries = new Galleries();
$videos = new Videos();

$news = new News();
$generalvideos = new GeneralVideos();
$polls = new Polls();
$adds = new Adds();
$comments = new Comments();
$categories = new Categories();
$videocategories = new VideoCategories();
$photos = new Photos();

$excerpt = new Excerpt();
$menu = new menu();
$testimonials = new Testimonials();
$metahome = new metaHome();

function escapeString(&$value, $key) {
  global $conn;
  $value = $conn->links->real_escape_string($value);
}

array_walk($_GET, "escapeString");
array_walk($_POST, "escapeString");

if (isset($_GET['title'])) {
  $title = $_GET['title'];

  if (file_exists("includes/" . $title . ".php")) {
	$_GET['action'] = $title;
  } else {
	$row = $listings->getByURLName($title);

	if ($row) {
	  $listId = $row['id'];
	  $_GET['listId'] = $row['id'];
	} else {
	  $row = $groups->getByURLName($title);
	  if ($row) {
		if (isset($_GET['action'])) {
		  $_GET['id'] = $row['id'];
		} else {
		  $linkId = $row['id'];
		  $_GET['linkId'] = $row['id'];
		}
	  }
	}
  }
}//if(isset($_GET['title']))

$action = $_GET['action'];

$pageTitle = $metaTitle = $metaKeyword = $metaDescription = $ogImage = $ogUrl = "";

if (isset($_GET['linkId'])) {
  $result = $groups -> getById($_GET['linkId']);
  if($conn -> numRows($result) > 0) {
	$row = $conn -> fetchArray($result);
	
	$pageTitle = $row['name'];
	$metaTitle = !empty($row['pageTitle']) ? $row['pageTitle'] : $row['name'];
	$metaKeyword = !empty($row['pageKeyword']) ? $row['pageKeyword'] : '';
	$metaDescription = !empty($row['metaDescription']) ? $row['metaDescription'] : !empty($row['contents']) ? substr(strip_tags($row['contents']), 150) : '';
  }  
} elseif (isset($_GET['listId'])) {
  $row = $listings -> getById($_GET['listId']);
  if($conn -> numRows($result) > 0) {
	$row = $conn -> fetchArray($result);
	
	$pageTitle = $row['title'];
	$ogTitle = $metaTitle = !empty($row['pageTitle']) ? $row['pageTitle'] : $row['title'];
	$metaKeyword = !empty($row['pageKeyword']) ? $row['pageKeyword'] : '';
	$ogDescription = $metaDescription = !empty($row['listMetaDescription']) ? $row['listMetaDescription'] : !empty($row['description']) ? $excerpt->excerptWithOutTags($row['description'], 150) : '';
	
	$ogImage = "https://" . $_SERVER['HTTP_HOST'] . "/" . "images/sharer.jpg";
	if (!empty($row['ext']) && file_exists(CMS_LISTINGS_DIR . $row['id'] . "." . $row['ext']))
	  $ogImage = "https://" . $_SERVER['HTTP_HOST'] . "/" . CMS_LISTINGS_DIR . $row['id'] . "." . $row['ext'];	
    $ogUrl = "https://" . $_SERVER['HTTP_HOST'] . "/" . $row['urltitle'] . PAGE_EXTENSION;
  }  
}
elseif (isset($_GET['galleryId'])) {
  $result = $galleries->getParentDetailsById($_GET['galleryId']);
  
  if($conn -> numRows($result) > 0) {
	$row = $conn -> fetchArray($result);
	
	$pageTitle = $row['name'];
	$metaTitle = !empty($row['pageTitle']) ? $row['pageTitle'] : $row['name'];
	$metaKeyword = !empty($row['pageKeyword']) ? $row['pageKeyword'] : '';
	$metaDescription = !empty($row['metaDescription']) ? $row['metaDescription'] : !empty($row['contents']) ? substr(strip_tags($row['contents']), 150) : '';
  }
} elseif ($action == "news") {
  $ayo = $news->getById($_GET['id']);
  
  $metaTitle = !empty($ayo['pageTitle']) ? $ayo['pageTitle'] : $ayo['headline'];
  $metaKeyword = $ayo['pageKeyword'];
  $metaDescription = !empty($ayo['pageDescription']) ? $ayo['pageDescription'] : $excerpt->excerptWithOutTags($ayo['description'], 40);
  
  $ogImage = "https://" . $_SERVER['HTTP_HOST'] . "/" . "images/sharer.jpg";
  
  if (!empty($ayo['filename']) && file_exists(CMS_NEWS_DIR . $ayo['filename']))
	$ogImage = "https://" . $_SERVER['HTTP_HOST'] . "/" . CMS_NEWS_DIR . $ayo['filename'];
  $ogUrl = "https://" . $_SERVER['HTTP_HOST'] . "/news/" . $_GET['id'];
}
else if ($action == "video") {
  $pageTitle = $generalvideos->getTitle($_GET['id']);
  $ayo = $generalvideos->getById($_GET['id']);
  $metaTitle = $ayo['title'] . "";
  $metaDescription = $excerpt->excerptWithOutTags($ayo['description'], 40);
  $ogImage = getYouTubeImage(formatYoutubeImageLink($ayo['link']), "big");
  $ogUrl = "https://" . $_SERVER['HTTP_HOST'] . "/video/" . $_GET['id'];
} else if ($action == "category") {
  $metaTitle = $categories->getTitle($_GET['id']);
  $ogUrl = "https://" . $_SERVER['HTTP_HOST'] . "/category/" . $_GET['id'];
} else if ($action == "videos-category") {
  $metaTitle = $videocategories->getTitle($_GET['id']);
} else if ($action == "photos") {
  $ayo = $photos->getById($_GET['id']);
  $metaTitle = $ayo['title'] . "";
  $metaDescription = $excerpt->excerptWithOutTags($ayo['description'], 40);
  $ogImage = "https://" . $_SERVER['HTTP_HOST'] . "/" . "files/photos/$ayo[filename]";
  $ogUrl = "https://" . $_SERVER['HTTP_HOST'] . "/photos/" . $_GET['id'];
  if (!$ayo['filename'])
	$ogImage = "https://" . $_SERVER['HTTP_HOST'] . "/" . "images/logo.png";
}
elseif ($_GET['title'] == 'videos') {
  $metaTitle = "Videos";
  $_GET['action'] = "videos";
} else {
  $meta = $metahome->getById(1);
  $row = $conn->fetchArray($meta);
  $metaKo = $row;
  $metaKeyword = $row["pageKeyword"];
  $metaTitle = $row["pageTitle"];
  $metaDescription = $row['metaDescription'];
}

if (empty($ogUrl)) {
  $ogUrl = "https://www.aahakhabar.com";
}

if (empty($ogImage)) {
  $ogImage = "https://" . $_SERVER['HTTP_HOST'] . "/" . "images/logo.png";
}

function news_short($id, $tot = 20) {
  global $excerpt, $news;
  return $excerpt->excerptWithOutTags($news->getSubHeadlineById($id), $tot);
}

if(isset($_POST['key'])) {
  $key = $_POST['key'];
} else if(isset($_GET['key'])) {
  $key = $_GET['key'];
}
?>
<!doctype html>
<html lang="ne">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-site-verification" content="3k9ZLww72sZUN-q3jinEkwMm6WEw8XNomeJMYyJIE8o" />
	<title><?php echo $ogTitle = !empty($metaTitle) ? $metaTitle : $pageTitle; ?></title>
	<meta name="keywords" content="<?php echo $metaKeyword; ?>">
	<meta name="description" content="<?php echo $ogDescription = $metaDescription; ?>">

	<meta property="og:url" content="<?php echo $ogUrl; ?>" />
	<meta property="og:type" content="article" />
	<?php if(!isset($_GET['action']) || $_GET['action'] != "status") { ?>
	<meta property="og:title" content="<?php echo $ogTitle; ?>" />
	<meta property="og:description" content="<?php echo $ogDescription; ?>" />
	<meta property="og:image" content="<?php echo $ogImage; ?>" />
	<?php if (isset($_GET['action']) && $_GET['action'] == "news") { ?>
  	<meta property="og:image:width" content="470">
  	<meta property="og:image:height" content="246">
	<?php } ?>
	<?php } ?>
	<meta property="fb:pages" content="647184108812763" />
	<meta property="fb:app_id" content="170334086869699">
	<meta property="og:locale" content="ne_NP" />

	<!-- Twitter Card -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@aahakhabar">
	<meta name="twitter:title" content="<?php echo $ogTitle; ?>">
	<meta name="twitter:description" content="<?php echo $ogDescription; ?>">
	<meta name="twitter:url" content="<?php echo $ogUrl; ?>">
	<meta name="twitter:image" content="<?php echo $ogImage; ?>">

	<?php include "baselocation.php"; ?><!-- Bootstrap -->
	<link rel="shortcut icon" href="favicon.ico">	
	<link rel="dns-prefetch" href="https://fonts.googleapis.com/">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ek+Mukta:400,600,700">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/jquery.bxslider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/poll.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/hover-min.css" />
	<!-- our css style -->
	<!--<link rel="stylesheet" type="text/css" href="css/cnstyle_new.css">-->
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<!-- js -->
	<link rel="stylesheet" type="text/css" href="css/cms.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	
	<script src="js/modernizr.custom.js"></script>
	<script src="js/jquery-1.9.1.min.js"></script>
	<script type='text/javascript' src='js/jquery.bxslider.min.js'></script>
	<script>
      $(document).ready(function (e) {
        $('.bxslider').bxSlider({
          mode: 'fade',
          auto: true,
          captions: true,
          //    pagerCustom: '#bx-pager'
        });
        $('.bxslider2').bxSlider({
          mode: 'fade',
          auto: true,
          pager: 0,
          captions: true
        });
      });
	</script>
	
  <div id="fb-root"></div>
  <script>(function (d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id))
	  return;
	js = d.createElement(s);
	js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.1";
	fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  
  <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=59b4f4b23bc6590014ffc3ac&product=inline-share-buttons"></script>

</head>

<body>
  <div class="container">
	<div class="row">
	  <div class="col-md-12">
		<?php
		$result = $adds->getByPosition("topfirst");
		if ($conn->numRows($result) > 0) {
		  ?>
  		<div class="add-wrapper pad-bottom-5">
			<?php echo $adds->getAddByPositionWithLimit("topfirst", 0, 1, "add"); ?>
  		</div>
		  <?php
		}
		?>
		<div class="hidden-xs hidden-sm hidden-md hidden-lg top-bar">
		  <div class="row">
			<div class="col-sm-3">
			  <?php //include "nepali_clock.php"; ?>
			</div>
			<div class="col-sm-6 text-center">
			  Contact: aahakhabar@gmail.com &nbsp;
			  <span class="social">
				<a href="https://www.facebook.com/aahakhabar" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="https://www.twitter.com/aahakhabar" target="_blank"><i class="fa fa-twitter"></i></a>
			  </span>
			</div>
			<div class="col-sm-3">
			  <div class="wedtime">
				<iframe src="https://free.timeanddate.com/clock/i5wl0j2i/n117/tlnp/fn16/fs12/fcfff/tct/pct/ahr/tt0/tw1/tm1/tb2" frameborder="0" width="150" height="16" allowTransparency="true"></iframe>
			  </div>
			</div>
		  </div>
		</div>
	  </div>

	  <div class="col-md-12">
		<div class="row">
		  <div class="col-sm-4 col-md-4">
			<div class="logo">
			  <a href="<?php echo $BaseNew; ?>"><img src="images/logo.jpg" class="img-responsive" alt="Aaha Khabar"></a>
			</div>
		  </div><!-- logo end -->
		  <div class="col-sm-8 col-md-8">
			<div class="add-wrapper pad-bottom-5">
			  <?php
			  echo $adds->getAddByPositionWithLimit("top", 0, 1, "add");
			  ?>
			</div>
		  </div><!-- advertise end -->
		</div>
	  </div><!-- header end -->

	  <div class="col-md-12 clearfix">
		<div class="navi">
		  <div class="hgmenu">
			<div role="navigation" id="nav">
			  <div class="lang"><a href="https://www.aahakhabar.com/english">English</a></div>
			  <span class="search" data-toggle="modal" data-target="#searchModal"><i class="fa fa-search"></i></span>
			  <a class="toggleMenu" href="#" style="display:none;">Menu</a>
			  <?php
			  $menu->dropDown($groups->getByTypeParentId("Header Links", 0), " class='nav' ");
			  ?>
			  
			</div>
		  </div>
		  <div class="clearfix"></div>
		</div>		
	  </div><!-- menu end -->
	  
	  <?php
	  $result = $news -> getByTypeWithLimit("latest", 0, 15);
	  if($conn -> numRows($result) > 0) {
		?>
		<div class="col-md-12">
		  <div class="scrollnews">
				<div class="row">
					<div class="col-md-2 hidden-xs hidden-sm">
			<?php include "nepali_clock.php"; ?>
						</div>
					<div class="col-md-10">
			<marquee direction="left" truespeed scrollamount="1" scrolldelay="15" onmouseover="this.stop()" onmouseout="this.start()">
			<?php
			while($row = $conn -> fetchArray($result)) {
			  ?>
			  <a href="news/<?php echo $row['id']; ?>"><?php echo $row['headline']; ?></a> <span class="aaha" style="color: #ffff00;">#आहा खबर#</span>
			  <?php
			}
			?>
			</marquee>
					</div>
				</div>
		  </div>
		</div>
		<?php
	  }
	  ?>
	 
	  <?php
	  $result = $adds -> getByPosition("banner");
	  if($conn -> numRows($result) > 0) {
		?>
		<div class="col-md-12">
		  <div class="add-wrapper pad-top-5">
			<?php echo $adds->getAddByPositionWithLimit("banner", 0, 1, "add"); ?>
		  </div>
		</div>
		<?php
	  }
	  ?>
	  
	  <?php
	  if (count($_GET) != 0) {
		?>
		<div class="col-md-9">
		  <?php
		  //print_r($_GET);
		  if ($_GET['action']) {
			if (file_exists("includes/" . $_GET['action'] . ".php")) {
			  include("includes/" . $_GET['action'] . ".php");
			}
		  } else if (isset($_GET['linkId'])) {
			include("includes/cmspage.php");
		  } else if (isset($_GET['bookId'])) {
			include("includes/booking.php");
		  } elseif (isset($_GET['listId'])) {
			include "includes/showlistsingle.php";
		  } elseif (isset($_GET['galleryId'])) {
			include("includes/showgallerysingle.php");
		  } elseif ($_GET['grab']) {
			include("includes/cmspage.php");
		  } else {
			echo "<h2>404, Page not Found !!</h2>";
		  }
		  ?>   
		</div>
		<div class="col-md-3">
		  <?php
		  include "includes/right_bar.php";
		  ?> 
		</div>
		<div class="clearfix"></div>
		<?php
	  }
	  ?>

	  <?php
	  if (count($_GET) == 0) {
		$result = $groups->getById(LIVE);
		if ($conn->numRows($result) > 0) {
		  $row = $conn->fetchArray($result);
		  if (strlen($row['contents']) > 10) {
			?>
			<div class="col-md-12">
			  <div style="padding: 5px; background: #bd172d; color: #fff; font-weight: bold; font-size: 20px; line-height: 28px; margin-top: 5px;"><?php echo $row['name']; ?></div>
			  <div style="border: 1px solid #ccc; margin: 0 0 5px 0; height: 400px; overflow-x: auto;">
				  <?php echo $row['contents']; ?>
			  </div>
			</div>
			<?php
		  }
		}

		$result = $news -> getByTypeWithLimit("taja", 0, 1);
		if($conn -> numrows($result) > 0) {
			while($row = $conn -> fetchArray($result)) {
				?>
				<div class="col-md-12">
					<div class="bannerNews second" style="border-bottom: 1px solid #eee;">
					  <h2><a href="news/<?php echo $row['id']; ?>"><?php echo $row['headline']; ?></a></h2>
					</div>
			  </div>
				<?php
			}
		}
		
		$arr = $news->getFeaturedWthLimit(0, 1);
		while ($ayo = $conn->fetchArray($arr)) {
		  $texttoshow = "विशेष समाचार";
		  if($ayo['featured'] == "no")
			$texttoshow = "विशेष अन्तरवार्ता";
		  ?>
		  <div class="col-md-12">
			<div class="bannerNews featured">
			  <!-- <span><?php //echo $texttoshow; ?></span> -->
			  <h2><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h2>
			  <!-- <h3><?php echo $ayo['subheadline']; ?></h3> -->
			  <?php if($ayo['mainImage'] == "yes" && !empty($ayo['filename']) && file_exists(CMS_NEWS_DIR . $ayo['filename'])) { ?>
			  <div class="text-center"><img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" alt="<?php echo $ayo['headline']; ?>" class="img-responsive" style="display: inline-block; width: auto; max-height: 550px;"></div>
			  <?php } ?>
			</div>
		  </div>
		  <?php
		}
		
		
		$i=0;
		$arr = $news->getBreakingScrollNews(0, 2);
		while ($ayo = $conn->fetchArray($arr)) {
		  $i++;
		  ?>
		  <div class="col-md-12">
			<div class="bannerNews second">
			  <h2><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h2>
			</div>
		  </div>
		  <?php
		}
		 /*
		$arr = $news->getBreakingScrollNews(0, 4);
		if($conn -> numRows($arr) > 0) {
		  ?>
		  <div class="col-md-12 special">
			<div class="panel panel-default">
			  <!--<div class="panel-heading">आहा खोज</div>-->
			  <div class="panel-body">
				<div class="row">
				  <?php
				  while($row = $conn -> fetchArray($arr)) {
					?>
					<div class="col-md-3">
					  <div class="row">
						<div class="col-md-12 text-center">
						  <span style="padding-bottom: 5px; display: inline-block;"><a href="news/<?php echo $row['id']; ?>"><?php echo $row['headline']; ?></a></span>
						  <a href="news/<?php echo $row['id']; ?>"><img src="<?php echo CMS_NEWS_DIR . $row['filename']; ?>" class="img-responsive img-shadow" alt="<?php echo $row['headline']; ?>"></a>
						  
						</div>
						
					  </div>
					  
					</div>
					<?php
				  }
				  ?>				  
				</div>
			  </div>
			</div>
		  </div>
		  <?php
		}*/
		?>
		
		<div class="col-md-12">
		  <div class="row">
			<div class="col-md-9">
			<?php
			$rajyaSamajId = 71;
			?>
			<h3 class="title"><?php echo $categories->getTitle($rajyaSamajId); ?></h3>
			<div class="row">
			  <div class="col-md-6">
				<?php
				$i = 0;
				$arrflash1 = array();
				$arrflash2 = array();
				$result = $news->getByCategoryIdWithLimit($rajyaSamajId, 0, 5);
				while ($ayo = $conn->fetchArray($result)) {
				  if ($i == 0) {
					$arrflash1[] = $ayo;
				  } else {
					$arrflash2[] = $ayo;
				  }
				  $i++;
				}

				foreach ($arrflash1 as $key => $ayo) {				  
				  $length = 80;
				  ?>
				  <div class="main-block no-border">
					<h4 class="pad-left-0"><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					<div class="bg">
					  <?php
					  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						$length = 40;
						?>						  
						<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
						<?php
					  }
					  ?>
					  <div class="caption pad-top-15">
						<?php
						echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length);
						?>
					  </div>
					</div>
				  </div>
				  <?php
				}
				?>
			  </div>
			  <div class="col-md-6">
				<?php
				foreach ($arrflash2 as $key => $ayo) {
				  $length = 40;
				  if ($key == 0) {
					?>
					<div class="list list1">
					  <ul>  
						<?php
						}
						?>
						<li class="clearfix">
						  <h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php
						  if($key < 2) {
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
						  <span class="hidden-overflow">
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:120px; max-height: 80px;" alt="<?php echo $ayo['headline']; ?>" class="img-responsive img-big hvr-grow">
						  </span>
							<?php
						  }
						  
						  echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length);
						  }
						  ?>
						</li>
						<?php
						if ($key == 3) {
						  ?>
					  </ul>
					</div>
					<?php
				  }
				}
				if (count($arrflash2) > 0 && count($arrflash2) < 4) {
				  echo '</ul></div>';
				}
				?>
			  </div>
			</div>  
			
			<?php
			$result = $adds->getByPositionWithLimit("mid1-1", 0, 1);
			if ($conn->numRows($result) > 0) {
			  ?>
			  <!-- Middle Add1 Starts -->
			  <div class="add-wrapper">
				<?php echo $adds->getAddByPositionWithLimit("mid1-1", 0, 1, "add"); ?>
			  </div>
			  <!-- Middle Add1 Ends -->
			  <?php
			}
			?>
			
			<?php
			  $paryatanIds = "88, 89, 90";
			  ?>
			  <h3 class="title">टुर ट्राभल</h3>
			  <div class="row">
				<div class="col-md-6">
				  <?php
				  $i = 0;
				  $arrnews1 = array();
				  $arrnews2 = array();
				  $arr = $news->getByCategoryIdsWithLimit($paryatanIds, 0, 5);
				  while ($ayo = $conn->fetchArray($arr)) {
					if ($i == 0) {
					  $arrnews1[] = $ayo;
					} else {
					  $arrnews2[] = $ayo;
					}
					$i++;
				  }

				  foreach ($arrnews1 as $key => $ayo) {					
					$length = 80;
					?>
					<div class="main-block no-border">
					  <h4 class="pad-left-0"><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					  <div class="bg">
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayoa['filename'])) {
						  $length = 40;
						  ?>
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
						  <?php
						}
						?>
						<div class="caption pad-top-15">
						  <?php
						  echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length);
						  ?>
						</div>
					  </div>
					</div>
					<?php
				  }
				  ?>
				</div>
				<div class="col-md-6">
				  <?php
				  foreach ($arrnews2 as $key => $ayo) {
					$length = 40;
					if ($key == 0) {
					  ?>
					  <div class="list list1">
						<ul>  
						  <?php
						  }
						  ?>
						  <li class="clearfix">
							<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
							<?php
							if($key <= 1) {
							  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
								$length = 20;
								?>
							  <span class="hidden-overflow">
								<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" alt="<?php echo $ayo['headline']; ?>" class="img-responsive img-big hvr-grow">
							  </span>
								<?php
							  }

							  echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length);
							}
							?>
						  </li>
						  <?php
						  if ($key == 3) {
							?>
						</ul>
					  </div>
					  <?php
					}
				  }
				  if (count($arrnews2) > 0 && count($arrnews2) < 4)
					echo '</ul></div>';
				  ?>
			  </div>
			</div>

			<?php
			$result = $adds->getByPositionWithLimit("mid1-1", 0, 1);
			if ($conn->numRows($result) > 0) {
			  ?>
			  <div class="add-wrapper pad-top-5 pad-bottom-5">
				<?php echo $adds->getAddByPositionWithLimit("mid1-2", 0, 1, "add"); ?>
			  </div>
			  <?php
			}
			?>
			
			<?php $kalaSaundaryaId = 86; ?>
			<h3 class="title pad-top-15"><?php echo $categories->getTitle($kalaSaundaryaId); ?></h3>
			<div class="row">
			  <div class="col-md-6">
				<?php
				$i = 0;
				$arrflash1 = array();
				$arrflash2 = array();
				$result = $news->getByCategoryIdWithLimit($kalaSaundaryaId, 0, 5);
				while ($ayo = $conn->fetchArray($result)) {
				  if ($i == 0) {
					$arrflash1[] = $ayo;
				  } else {
					$arrflash2[] = $ayo;
				  }
				  $i++;
				}

				foreach ($arrflash1 as $key => $ayo) {
				  $length = 80;
				  ?>
				  <div class="main-block no-border">
					<h4 class="pad-left-0"><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					<div class="bg">
					  <?php
					  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						$length = 40;
						?>						  
					  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" alt="<?php echo $ayo['headline']; ?>" class="img-responsive">							
						<?php
					  }
					  ?>
					  <div class="caption pad-top-15">
						<?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
					  </div>
					</div>
				  </div>
				  <?php
				}
				?>
			  </div>
			  <div class="col-md-6">
				<?php
				foreach ($arrflash2 as $key => $ayo) {
				  $length = 40;
				  if ($key == 0) {
					?>
					<div class="list list1">
					  <ul>  
						<?php
						}
						?>
						<li class="clearfix">
						  <h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php
						  if($key <= 1) {
							if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							  $length = 20;
							  ?>
							<span class="hidden-overflow">
							  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:120px; max-height: 80px;" alt="<?php echo $ayo['headline']; ?>" class="img-responsive img-big hvr-grow">
							</span>
							  <?php
							}

							echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length);
						  }
						  ?>
						</li>
						<?php
						if ($key == 3) {
						  ?>
					  </ul>
					</div>
					<?php
				  }
				}
				if (count($arrflash2) > 0 && count($arrflash2) < 4) {
				  echo '</ul></div>';
				}
				?>
			  </div>
			</div>
		  </div>
			
		  <div class="col-md-3">
			<?php
			$result = $adds -> getByPosition("top2");
			if($conn -> numRows($result) > 0) {
			  ?>
			  <div class="add-wrapper pad-bottom-5">
				<?php
				echo $adds->getAddByPositionWithLimit("top2", 0, 0, "add");
				?>
			  </div>
			  <?php
			}
			?>

			<!-- Tab menu starts -->
			<div class="tabbedPanels">
			  <ul class="tabs clearfix">
				<li><a href="#taaja" tabindex="1">ताजा अपडेट</a></li>
				<li><a href="#lokpriya" tabindex="2">लोकप्रिय</a></li>
			  </ul>
			  <div class="panelContainer">
				<div id="taaja" class="tab-panel">
				  <ul>
					  <?php
					  $arr = $news->getLatestWithLimit(0, 5);
					  $i = 0;
					  while ($ayo = $conn->fetchArray($arr)) {
						?>
						<li class="clearfix"><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></li>
						<?php
						$i++;
					  }
					  ?>
				  </ul>
				</div>
				<div id="lokpriya" class="tab-panel">
				  <ul>
					  <?php
					  $arr = $news->getLokpriya(0, 5);
					  $i = 0;
					  while ($ayo = $conn->fetchArray($arr)) {
						?>
						<li class="clearfix"><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a>  <span><?php echo $arrNumbers[$i]; ?></span></li>
						<?php
						$i++;
					  }
					  ?>
				  </ul>
				</div>
			  </div>
			</div>
			<!-- Tab menu ends -->

			<?php
			$result = $adds -> getByPosition("top2");
			if($conn -> numRows($result) > 0) {
			  ?>
			  <div class="add-wrapper pad-top-5">
				<?php
				echo $adds->getAddByPositionWithLimit("top2right2", 0, 0, "add");
				?>
			  </div>
			  <?php
			}
			?>			
			</div>
		  </div>

		  <div class="row">
			<div class="col-md-8">
			  <!-- Photo Feature Starts -->
			  <h3 class="title1">फोटो अफ द डे</h3>
			  <div class="main-block no-border">
				<div class="bg">
				  <div class="bxslider">
					  <?php
					  $arr_photo = array();
					  $arr = $photos->getLatestWithLimit(5);
					  while ($ayo = $conn->fetchArray($arr)) {
						$arr_photo[] = $ayo;
						?>
						<div class="slide" style="display:none;background:#F0EBF0;">
						  <a href="photos/<?php echo $ayo['id']; ?>"><img src="<?php echo CMS_PHOTOS_DIR . $ayo['filename']; ?>" alt="<?php echo $ayo['headline']; ?>" class="img-responsive photo-feature"></a>
						  <h4><a href="photos/<?php echo $ayo['id']; ?>"><?php echo $ayo['title']; ?></a></h4>
						  <div class="caption"><?php echo $excerpt->excerptWithOutTags($ayo['description'], 20); ?></div>
						</div>
						<?php
					  }
					  ?>  
				  </div>
				  <?php /* <div id="bx-pager">
					<?php
					foreach($arr_photo as $key => $val) {
					?>
					<a data-slide-index="<?php echo $key; ?>" href=""><img src="<?php echo CMS_PHOTOS_DIR . $val['filename']; ?>" alt=""></a>
					<?php
					}
					?>
					</div> */ ?>
				</div>
			  </div>
			  <!-- Photo Feature Ends -->
			</div>
			<div class="col-md-4">
			  <?php
			  $khelSansarId = 69;
			  ?>
			  <h3 class="title2"><a href="category/<?php echo $khelSansarId; ?>"><?php echo $categories->getTitle($khelSansarId); ?></a></h3>
			  <div class="main-block no-border">
				<div class="bg">
					<?php
					$arr = $news->getByCategoryIdWithLimit($khelSansarId, 0, 1);
					while ($ayo = $conn->fetchArray($arr)) {					 
					  $length = 80;
					  ?>
					  <h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					  <?php
					  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayoa['filename'])) {
						$length = 40;
						?>
					  <div class="hidden-overflow">
						<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" alt="<?php echo $ayo['headline']; ?>" class="img-responsive img-block img-pad hvr-grow">
					  </div>
						<?php
					  }
					  ?>
					  <p class="caption pad-top-15">
						<?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
					  </p>
					  <?php
					}
					?>
				</div>
			  </div>
			  <div class="list list1">
				<?php
				$arr = $news->getByCategoryIdWithLimit($khelSansarId, 1, 2);
				if ($conn->numRows($arr) > 0) {
				  echo "<ul>";
				  while ($ayo = $conn->fetchArray($arr)) {
					?>
					<li class="clearfix">
					  <h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					</li>
					<?php
				  }
				  echo "</ul>";
				}
				?>
			  </div>
			</div>
		  </div>

		  <?php
		  $result = $adds -> getByPosition("mid1");
		  if($conn -> numRows($result) > 0) {
			?>
			<div class="add-wrapper">
			  <?php echo $adds->getAddByPositionWithLimit("mid1", 0, 1, "add"); ?>
			</div>
			<?php
		  }
		  ?>
		  
		  <div class="row">
			<div class="col-md-4">
			  <?php $arthikKhabarId = 91; ?>
			  <h3 class="title2"><a href="category/<?php echo $arthikKhabarId; ?>"><?php echo $categories ->getTitle($arthikKhabarId); ?></a></h3>
			  <div class="main-block no-border">
				<div class="bg">
				  <?php
				  $arr = $news->getByCategoryIdWithLimit($arthikKhabarId, 0, 1);
				  while ($ayo = $conn->fetchArray($arr)) {
					$length = 60;
					?>
					<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					<?php
					if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filanem'])) {
					  $length = 30;
					  ?>
					<div class="hidden-overflow">
					  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
					</div>
					  <?php
					}
					?>
					<p class="caption pad-top-15">
					  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>  
					</p>
					<?php
				  }
				  ?>
				</div>
			  </div>
			  <div class="list list1">
				<?php
				$i = 0;
				$arr = $news->getByCategoryIdWithLimit($arthikKhabarId, 1, 2);
				if ($conn->numRows($arr) > 0) {
				  echo "<ul>";
				  while ($ayo = $conn->fetchArray($arr)) {
					$length = 40;
					$i++;
					?>
				  <li class="clearfix">
					<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					  <?php /*
					  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						$length = 20;
						?>
						<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;"  alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
						<?php
					  }
					  ?>
					 <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
				  </li>
					<?php
				  }
				  echo "</ul>";
				}
				?>
			  </div>
			</div>
			
			<div class="col-md-4">
			  <?php $swadParikarId = 99; ?>
			  <h3 class="title2"><a href="category/<?php echo $swadParikarId; ?>"><?php echo $categories ->getTitle($swadParikarId); ?></a></h3>
			  <div class="main-block no-border">
				<div class="bg">
				  <?php
				  $arr = $news->getByCategoryIdWithLimit($swadParikarId, 0, 1);
				  while ($ayo = $conn->fetchArray($arr)) {
					$length = 60;
					?>
					<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					<?php
					if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filanem'])) {
					  $length = 30;
					  ?>
					<div class="hidden-overflow">
					  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
					</div>
					  <?php
					}
					?>
					<p class="caption pad-top-15">
					  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>  
					</p>
					<?php
				  }
				  ?>
				</div>
			  </div>
			  <div class="list list1">
				<?php
				$i = 0;
				$arr = $news->getByCategoryIdWithLimit($swadParikarId, 1, 2);
				if ($conn->numRows($arr) > 0) {
				  echo "<ul>";
				  while ($ayo = $conn->fetchArray($arr)) {
					$length = 40;
					$i++;
					?>
				  <li class="clearfix">
					<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					  <?php /*
					  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						$length = 20;
						?>
						<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;"  alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
						<?php
					  }
					  ?>
					 <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
				  </li>
					<?php
				  }
				  echo "</ul>";
				}
				?>
			  </div>
			</div>
			
			<div class="col-md-4">
			  <?php $krishiUrjaId = 95; ?>
			  <h3 class="title2"><a href="category/<?php echo $krishiUrjaId; ?>"><?php echo $categories ->getTitle($krishiUrjaId); ?></a></h3>
			  <div class="main-block no-border">
				<div class="bg">
				  <?php
				  $arr = $news->getByCategoryIdWithLimit($krishiUrjaId, 0, 1);
				  while ($ayo = $conn->fetchArray($arr)) {
					$length = 60;
					?>
					<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					<?php
					if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filanem'])) {
					  $length = 30;
					  ?>
					<div class="hidden-overflow">
					  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
					</div>
					  <?php
					}
					?>
					<p class="caption pad-top-15">
					  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>  
					</p>
					<?php
				  }
				  ?>
				</div>
			  </div>
			  <div class="list list1">
				<?php
				$i = 0;
				$arr = $news->getByCategoryIdWithLimit($krishiUrjaId, 1, 2);
				if ($conn->numRows($arr) > 0) {
				  echo "<ul>";
				  while ($ayo = $conn->fetchArray($arr)) {
					$length = 40;
					$i++;
					?>
				  <li class="clearfix">
					<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					  <?php /*
					  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						$length = 20;
						?>
						<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;"  alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
						<?php
					  }
					  ?>
					 <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
				  </li>
					<?php
				  }
				  echo "</ul>";
				}
				?>
			  </div>
			</div>
		  </div>

		  <div class="row">
			<div class="col-md-6">
			  <!-- Feature Starts -->
			  <h3 class="title2"><?php echo $metaKo['feature1']; ?></h3>
			  <div class="main-block no-border">
				<div class="bg">
				  <?php
				  $arr = $news->getRelatedWithLimit(1, 0, 1);
				  while ($ayo = $conn->fetchArray($arr)) {					
					$length = 80;
					?>
					<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					<?php
					if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
					  $length = 40;
					  ?>
					  <div class="hidden-overflow">
						<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
					  </div>
					  <?php
					}
					?>
					<div class="caption pad-top-15">
					  <?php
					  echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length);
					  ?>
					</div>
					<?php
				  }
				  ?>
				</div>
			  </div>  
			  <div class="list list1">
				<?php
				$arr = $news->getRelatedWithLimit(1, 1, 2);
				if ($conn->numRows($arr) > 0) {
				  echo "<ul>";
				  while ($ayo = $conn->fetchArray($arr)) {
					?>
					<li class="clearfix">
					  <h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					</li>
					<?php
				  }
				  echo "</ul>";
				}
				?>
			  </div>
			  <!-- Feature Ends -->
			</div>
			<div class="col-md-6">
			  <!-- Video Starts -->
			  <h3 class="title3"><a href="videos/0">भिडियोहरू</a></h3>
			  <div class="main-block no-border">
				<div class="bg">
				  <?php
				  $arr = $generalvideos->getByTypeAndCategoryWithLimit("videos", 1, 0, 1);
				  while ($ayo = $conn->fetchArray($arr)) {
					$link = formatYoutubeIframeLink($ayo['link']);
					?>
					<div class="embed-responsive embed-responsive-16by9">
					  <iframe class="embed-responsive-item" src="<?php echo $link; ?>"></iframe>
					</div>
					<h4><a href="video/<?php echo $ayo['id']; ?>"><?php echo $ayo['title']; ?></a></h4>
					<?php
				  }
				  ?>	
				</div>
			  </div>

			  <?php
			  $arr = $generalvideos->getByTypeAndCategoryWithLimit("videos", 1, 1, 2);
			  if ($conn->numRows($arr) > 0) {
				?>
				<div class="row">
				  <?php
				  while ($ayo = $conn->fetchArray($arr)) {
					$vid = end(explode("?v=", $ayo['link']));
					?>
				  <div class="col-md-6">
					<a title="<?php echo $ayo['title']; ?>" href="video/<?php echo $ayo['id']; ?>"><img class="img-responsive margin-bottom-5" src="<?php echo getYouTubeImage(formatYoutubeImageLink($ayo['link']), "big"); ?>" alt="<?php echo $ayo['headline']; ?>"></a>
					<a href="video/<?php echo $ayo['id']; ?>"><?php echo $ayo['title']; ?></a>
				  </div>
					<?php
				  }
				  ?>
				</div>
				<?php
			  }
			  ?>
			  <!-- Video Ends -->
			</div>
		  </div>

		  <div class="row">
			<div class="col-md-12">
			  <div class="border-gray">
				<h4 class="title5"><?php echo $metaKo['feature2']; ?></h4>
				<?php
				$arr = $news->getRelatedWithLimit(2, 0, 4);
				if ($conn->numRows($arr) > 0) {
				  ?>
				  <div class="row budb margin-0">
					<?php
					while ($ayo = $conn->fetchArray($arr)) {
					  ?>
					  <div class="col-md-3 pad-5">
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						  ?>
						  <a href="news/<?php echo $ayo['id']; ?>"><img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" alt="<?php echo $ayo['headline']; ?>" class="img-responsive"></a>
						  <?php
						}
						?> 
						<p style="margin-bottom: 0;"><?php echo $ayo['headline']; ?></p>
					  </div>
					  <?php
					}
					?>
				  </div>
				  <?php
				}
				?>
			  </div>
			</div>
		  </div>

		  <?php
		  $result= $adds -> getByPosition("mid2");
		  if($conn -> numRows($result) > 0) {
			?>
			<div class="add-wrapper pad-top-5">
			  <?php echo $adds->getAddByPositionWithLimit("mid2", 0, 1, "add"); ?>
			</div>
			<?php
		  }
		  ?>
			

		  <div class="row">
			<div class="col-md-9">
			  <div class="row">
				<div class="col-md-12 pad-top-5">
				  <?php $OMGId = 87; ?>
				  <h3 class="title2"><?php echo $categories ->getTitle($OMGId); ?></h3>
				  <div class="row">
					<div class="col-md-6">
					  <div class="main-block no-border">
						<div class="bg">
						  <?php
						  $arr = $news->getByCategoryIdWithLimit($OMGId, 0, 1);
						  while ($ayo = $conn->fetchArray($arr)) {							
							$length = 80;
							?>
							<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
							<?php
							if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							  $length = 40;
							  ?>
							<div class="hidden-overflow">
							  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
							</div>
							  <?php
							}
							?>
							<p class="caption pad-top-15">
							  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
							</p>
							<?php
						  }
						  ?>
						</div>
					  </div>
					</div>
					<div class="col-md-6">
					  <div class="list list1">
						<?php
						$i = 0;
						$arr = $news->getByCategoryIdWithLimit($OMGId, 1, 5);
						if ($conn->numRows($arr) > 0) {
						  echo "<ul>";
						  while ($ayo = $conn->fetchArray($arr)) {
							$length = 40;
							$i++;
							?>
							<li class="clearfix">
							  <h4<?php if($i==1){ echo ' class="margin-0"'; } ?>><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
								<?php if($i<=2) {
								if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
								  $length = 20;
								  ?>
								  <span class="hidden-overflow">
									<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" alt="<?php echo $ayo['headline']; ?>" class="img-responsive hvr-grow">
								  </span>
								  <?php
								}
								?>
								<p><?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?></p><?php } ?>
							</li>
							<?php
						  }
						  echo "</ul>";
						}
						?>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			
			<div class="col-md-3">
			  <div class="pad-top-15"></div>
			  <?php 
			  $result = $adds -> getByPosition("top2right3");
			  if($conn -> numRows($result) > 0) {
				?>
				<div class="add-wrapper pad-bottom-5">
				  <?php echo $adds->getAddByPositionWithLimit("top2right3", 0, 1, "add"); ?>
				</div>
				<?php
			  }
			  ?>
				
			  <!-- Poll Starts -->
			  <div class="poll">
				<h3 class="gtitle"> <i class="fa fa-bar-chart"></i> Aaha Khabar Poll </h3>
				<div class="gpblock">
				  <div id="quickMessageDiv"></div>
				  <div id="result"></div>
				  <div class="SP"></div>
				  <div class="jes">
					<div id="pollDiv">
					  <div class="jes_txt">
						<?php
						$arr = $polls->getLatest();
						$ayo = $conn->fetchArray($arr);
						echo $ayo['title'];
						?>
					  </div>

					  <form name="pollForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="pollForm">
						<input type="hidden" name="pollId" id="pollId"  value="<?php echo $ayo['id']; ?>">    
						<div class="cme">
						  <div class="cme1">
							<?php
							$arr = $polls->getOptions($ayo['id']);
							while ($ayo = $conn->fetchArray($arr)) {
							  ?>
							  <input type="radio" name="poll" id="p<?php echo $ayo['id']; ?>" value="<?php echo $ayo['id']; ?>">
							  <label for="p<?php echo $ayo['id']; ?>"> <?php echo $ayo['option']; ?></label>
							  <br />
							  <?php
							}
							?>
						  </div>
						</div>

						<div class="suba">
						  <input class="btn btn-success" onclick="sendPoll();"  type="button" value="Vote Now">
						  <input class="btn btn-primary" onclick="showResult();"  type="button" value="Result">
						</div>
					  </form>
					</div>
				  </div>
				  <div class="clear"></div>       
				</div>				
			  </div>
			  <!-- Poll Ends -->
			</div>
		  </div>

		  <?php
		  $result = $adds -> getByPosition("mid3");
		  if($conn -> numRows($result) > 0) {
			?>
			<div class="add-wrapper pad-top-15">
			  <?php echo $adds->getAddByPositionWithLimit("mid3", 0, 1, "add"); ?>
			</div>
			<?php
		  }
		  ?>

		  <div class="row">
			<div class="col-md-4">
			  <?php $bigyanPrabidhiId = 97; ?>
			  <h4 class="title4"><a href="category/<?php echo $bigyanPrabidhiId; ?>"><?php echo $categories->getTitle($bigyanPrabidhiId); ?></a></h4>
			  <div class="main-block no-border">
				<div class="bg">
				  <?php
				  $arr = $news->getByCategoryIdWithLimit($bigyanPrabidhiId, 0, 1);
				  while ($ayo = $conn->fetchArray($arr)) {
					$length = 80;
					?>
					<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					<?php
					if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
					  $length = 40;
					  ?>
					<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad" alt="<?php echo $ayo['headline']; ?>">
					  <?php
					}
					?>
					<p class="caption pad-top-15">
					  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?></p>
					<?php
				  }
				  ?>
				</div>
			  </div>
			</div>
			<div class="col-md-8">
			  <div class="row">
				<div class="col-md-12 pad-top-5">
					<?php $shareBazarId = 92; ?>
				  <h3 class="title2"><a href="category/<?php echo $shareBazarId; ?>"><?php echo $categories->getTitle($shareBazarId); ?></a></h3>
				  <div class="row">
					<div class="col-md-6">
					  <div class="main-block no-border">
						  <?php
						  $arr = $news->getByCategoryIdWithLimit($shareBazarId, 0, 1);
						  while ($ayo = $conn->fetchArray($arr)) {
							$shortdesc = !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $ayo['description'];
							$length = 40;
							?>
							<h4 class="pad-left-0"><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
							<?php
							if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							  $length = 20;
							  ?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive" alt="<?php echo $ayo['headline']; ?>">
							  <?php
							}
							?>
							<p class="pad-top-15"><?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?></p>
							<?php
						  }
						  ?>
					  </div>
					</div>
					<div class="col-md-6">
					  <div class="list list1">
						  <?php
						  $arr = $news->getByCategoryIdWithLimit($shareBazarId, 1, 2);
						  if ($conn->numRows($arr) > 0) {
							echo "<ul>";
							while ($ayo = $conn->fetchArray($arr)) {							  
							  $length = 40;
							  ?>
							<li class="clearfix">
							  <h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
								<?php
								if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
								  $length = 20;
								  ?>
								  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
								  <?php
								}
								?>
							  <p><?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?></p>
							</li>
							  <?php
							}
							echo "</ul>";
						  }
						  ?>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>

		  <div class="row">
			<div class="col-md-9">
			  <div class="row">				  
				<div class="col-md-6">
				  <?php $sharkBideshId = "82,83"; ?>
				  <h3 class="title2">सार्क-बिदेश</h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdsWithLimit($sharkBideshId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filanem'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdsWithLimit($sharkBideshId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;"  alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
				<div class="col-md-6">
				  <?php $movieTheaterId = 58; ?>
				  <h3 class="title2"><a href="category/<?php echo $movieTheaterId; ?>"><?php echo $categories->getTitle($movieTheaterId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($movieTheaterId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php 
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15"><?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?></p>
						<?php 
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($movieTheaterId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;" alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
			  </div>
			  
			  <div class="row">				  
				<div class="col-md-6">
				  <?php $swasthyaId = 100; ?>
				  <h3 class="title2"><a href="category/<?php echo $swasthyaId; ?>"><?php echo $categories ->getTitle($swasthyaId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($swasthyaId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filanem'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15"><?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?></p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($swasthyaId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;"  alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
				<div class="col-md-6">
				  <?php $bankBimaId = 93; ?>
				  <h3 class="title2"><a href="category/<?php echo $bankBimaId; ?>"><?php echo $categories->getTitle($bankBimaId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($bankBimaId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($bankBimaId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;" alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
			  </div>
			  
			  <div class="row">				  
				<div class="col-md-6">
				  <?php $lekhSambadId = 77; ?>
				  <h3 class="title2"><a href="category/<?php echo $lekhSambadId; ?>"><?php echo $categories ->getTitle($lekhSambadId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($lekhSambadId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filanem'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>  
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($lekhSambadId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;"  alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						 <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
				<div class="col-md-6">
				  <?php $adhyatmaCharchaId = 74; ?>
				  <h3 class="title2"><a href="category/<?php echo $adhyatmaCharchaId; ?>"><?php echo $categories->getTitle($adhyatmaCharchaId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($adhyatmaCharchaId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						<?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($adhyatmaCharchaId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;" alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
			  </div>
			  
			  <div class="row">				  
				<div class="col-md-6">
				  <?php $lifeStyleId = 47; ?>
				  <h3 class="title2"><a href="category/<?php echo $lifeStyleId; ?>"><?php echo $categories ->getTitle($lifeStyleId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($lifeStyleId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filanem'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						<?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($lifeStyleId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;"  alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
				<div class="col-md-6">
				  <?php $gharJaggaId = 94; ?>
				  <h3 class="title2"><a href="category/<?php echo $gharJaggaId; ?>"><?php echo $categories->getTitle($gharJaggaId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($gharJaggaId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($gharJaggaId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;" alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
			  </div>
			  
			  <div class="row">				  
				<div class="col-md-6">
				  <?php $schoolCollegeId = 70; ?>
				  <h3 class="title2"><a href="category/<?php echo $schoolCollegeId; ?>"><?php echo $categories ->getTitle($schoolCollegeId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($schoolCollegeId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filanem'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						<?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($schoolCollegeId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;"  alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
				<div class="col-md-6">
				  <?php $prerakPrasangaId = 85; ?>
				  <h3 class="title2"><a href="category/<?php echo $prerakPrasangaId; ?>"><?php echo $categories->getTitle($prerakPrasangaId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($prerakPrasangaId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						<?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($prerakPrasangaId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;" alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
			  </div>
			  
			  <div class="row">				  
				<div class="col-md-6">
				  <?php $brandSangathanId = 96; ?>
				  <h3 class="title2"><a href="category/<?php echo $brandSangathanId; ?>"><?php echo $categories ->getTitle($brandSangathanId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($brandSangathanId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {						
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filanem'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						<?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($brandSangathanId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;"  alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
				<div class="col-md-6">
				  <?php $sawadhanId = 102; ?>
				  <h3 class="title2"><a href="category/<?php echo $sawadhanId; ?>"><?php echo $categories->getTitle($sawadhanId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($sawadhanId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						<?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($sawadhanId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$shortdesc = !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $ayo['description'];
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						  <?php /*
						  if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
							$length = 20;
							?>
							<img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" style="max-width:100px; max-height:60px;" alt="<?php echo $ayo['headline']; ?>" class="img-responsive">
							<?php
						  }
						  ?>
						  <?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); */ ?>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
			  </div>
			  
			  <div class="row">				  
				<div class="col-md-6">
				  <?php $yatayatId = 103; ?>
				  <h3 class="title2"><a href="category/<?php echo $yatayatId; ?>"><?php echo $categories ->getTitle($yatayatId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($yatayatId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {						
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filanem'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						<?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($yatayatId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
				<div class="col-md-6">
				  <?php $dharmaId = 101; ?>
				  <h3 class="title2"><a href="category/<?php echo $dharmaId; ?>"><?php echo $categories->getTitle($dharmaId); ?></a></h3>
				  <div class="main-block no-border">
					<div class="bg">
					  <?php
					  $arr = $news->getByCategoryIdWithLimit($dharmaId, 0, 1);
					  while ($ayo = $conn->fetchArray($arr)) {
						$length = 60;
						?>
						<h4><a href="news/<?Php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
						<?php
						if ($ayo['filename'] && file_exists(CMS_NEWS_DIR . $ayo['filename'])) {
						  $length = 30;
						  ?>
						<div class="hidden-overflow">
						  <img src="<?php echo CMS_NEWS_DIR . $ayo['filename']; ?>" class="img-responsive img-pad hvr-grow" alt="<?php echo $ayo['headline']; ?>">
						</div>
						  <?php
						}
						?>
						<p class="caption pad-top-15">
						<?php echo !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $excerpt->excerptWithOutTags($ayo['description'], $length); ?>
						</p>
						<?php
					  }
					  ?>
					</div>
				  </div>
				  <div class="list list1">
					<?php
					$i = 0;
					$arr = $news->getByCategoryIdWithLimit($dharmaId, 1, 2);
					if ($conn->numRows($arr) > 0) {
					  echo "<ul>";
					  while ($ayo = $conn->fetchArray($arr)) {
						$shortdesc = !empty($ayo['shortdescription']) ? $ayo['shortdescription'] : $ayo['description'];
						$length = 40;
						$i++;
						?>
					  <li class="clearfix">
						<h4><a href="news/<?php echo $ayo['id']; ?>"><?php echo $ayo['headline']; ?></a></h4>
					  </li>
						<?php
					  }
					  echo "</ul>";
					}
					?>
				  </div>
				</div>
			  </div>
			  
			</div>
			<div class="col-md-3">
			  <div class="margin-top-5 clearfix"></div>	
			  <?php 
			  $result = $adds -> getByPosition("top2right4");
			  if($conn -> numRows($result) > 0) {
				?>
				<div class="add-wrapper pad-top-5">
				  <?php echo $adds->getAddByPositionWithLimit("top2right4", 0, 0, "add"); ?> 
				</div>
				<div class="margin-top-5 clearfix"></div>	
				<?php
			  }
			  ?>
			  
			  <?php include("includes/extralinks.php"); ?>
			</div>

		  </div>

		</div>
		<?php } ?>
	</div></div><!-- upper block end -->

  <div class="container-fluid smptwp clearfix">
	<div class="container"><div class="row">
		<div class="col-md-12 clearfix">
		  <div class="smorem">
				<div class="row">
			  	<div class="col-md-4">
						<div style="background: #fff; display: inline-block; padding: 10px 20px; margin-top: 20px; margin-bottom: 10px;"><img src="images/logo.png" alt="Aaha Khabar" class="img-responsive"></div>

						<?php
						$result = $groups->getById(CONTACT_US);
						while($row = $conn -> fetchArray($result)) {
							echo $row['shortcontents'];
						}
						?>

						<div class="social">
						  <ul>
							<li><a href="<?php echo $groups->getLinkById(75); ?>" target="_blank"> <i class="fa fa-facebook-square"></i>  </a></li>
							<li><a href="<?php echo $groups->getLinkById(79); ?>" target="_blank"> <i class="fa fa-twitter-square"></i>  </a></li>
						  </ul>
						</div>
						
						<div class="clearfix"></div><!-- social end -->

						<h3 class="timed"><?Php echo date("l, M d, Y"); ?></h3>
	
			  	</div><!-- cpyright end -->

			  	<div class="col-md-8 category-list">
			  		<div class="row">
			  			<?php
			  			$i = 0;
			  			$result = $groups -> getByTypeParentId("Header Links", 0);
		  				while($row = $conn -> fetchArray($result)) {
		  					if($row['linkType'] == "Normal Group") {
			  					?>
			  					<div class="col-xs-6 col-sm-4 col-md-3">
			  						<h2><?php echo $row['name']; ?></h2>
			  						<ul>
			  						<?php
			  						$res = $groups -> getByParentId($row['id']);
			  						while($r = $conn -> fetchArray($res)) {
			  							$link = $r['urlname'] . PAGE_EXTENSION;
			  							if($r['linkType'] == "Link")
			  								$link = $r['contents'];
			  							else if($r['linkType'] == "File")
			  								$link = CMS_FILES_DIR . $r['contents'];
			  							?>
			  							<li><a href="<?php echo $link; ?>"><?php echo $r['name']; ?></a></li>
			  							<?php
			  						}
			  						?>
			  						</ul>
			  					</div>
			  					<?php
			  					$i++;
			  					if($i%4 == 0) { 
			  						?>
				  					<div class="visible-md visible-lg clearfix"></div>
				  					<?php
			  					}
			  					if($i%3 == 0) { 
			  						?>
				  					<div class="visible-sm clearfix"></div>
				  					<?php
			  					}
			  					if($i%2 == 0) {
			  						?>
				  					<div class="visible-xs clearfix"></div>
				  					<?php	
			  					}

			  				}
			  			}
			  			?>						
			  		</div>
				  </div><!-- mega remittance end -->
				</div>
			</div>
		</div><!-- social n more end -->

	  </div></div>
  </div><!-- somepart footer end -->

  <div class="container-fluid copyright clearfix">
	<div class="container">
		<div class="row">
		<div class="col-sm-6">
			<div class="ftmenu">
			<?php
		  $menu->dropDown($groups->getByTypeParentId("Footer Links", 0), "", false);
		  ?>
		</div>
		</div>
		<div class="col-sm-6">
		  <h4 class="cpyrt"> Copyright © <?php echo date("Y"); ?> Aaha Khabar. Regd No: 948/075/076</h4>
		</div>
	  </div></div>
  </div><!-- footer end -->


  <div id="searchModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content">
		
		<div class="modal-body">
		  <form name="frmSearch" method="post" action="search.html" class="form-horizontal">
			<div class="input-group">
			  <input type="text" name="key" class="form-control" placeholder="Search for...">
			  <div class="input-group-btn">
				<button class="btn btn-default" type="submit">Go!</button>
			  </div>
			</div>
		  </form>
		</div>
		
	  </div>

	</div>
  </div>
  
  
  <?php
  if($_GET['action'] == "news") {
	$result = $adds -> getByPositionWithLimit("screenbottom", 0, 1);
	if($conn -> numRows($result) > 0) {
	?>
	<div style="position:fixed; bottom:0; width: 100%">
	  <div class="add-wrapper text-center">
		<?php
		echo $adds->getAddByPositionWithLimit("screenbottom", 0, 1);
		?>
	  </div>
	</div>
	<?php
	}
  }
  ?>

  <script type="text/javascript" src="js/script.js"></script>    
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/poll.js"></script>
  <script>
    $(".dcon h2").click(function () {
      $("#con").slideToggle("slow");
    });
  </script>
  <script type='text/javascript'>
    $(document).ready(function ()
    {
      $('.marqAdd2').bxSlider({
        ticker: true,
        autoHover: true,
        useCSS: false,
        tickerHover: true,
        slideHeight: 21,
        speed: 16000
      });

      $('.cmpnm2').bxSlider({
        ticker: true,
        autoHover: true,
        useCSS: false,
        tickerHover: true,
        slideHeight: 10,
        speed: 16000
      });

    });
  </script>

  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="css/jquery-ui.theme.min.css">
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/tabbed.js"></script>
  <script src="js/scrolltopcontrol.js"></script>
  <script src="js/main.js"></script>
  
  <script type="text/javascript">
    $.fn.extend({
      print: function () {
        var frameName = 'printIframe';
        var doc = window.frames[frameName];
        if (!doc) {
          $('<iframe>').hide().attr('name', frameName).appendTo(document.body);
          doc = window.frames[frameName];
        }
        doc.document.body.innerHTML = this.html();
        doc.window.print();
        return this;
      }
    });


    $("#news-print").click(function () {
      $("#printable").print();
    })
	
//	(function(document) {
//	  var shareButtons = document.querySelectorAll(".st-custom-button[data-network]");
//	  for(var i = 0; i < shareButtons.length; i++) {
//		 var shareButton = shareButtons[i];
//
//		 shareButton.addEventListener("click", function(e) {
//			var elm = e.target;
//			var network = elm.dataset.network;
//
//			console.log("share click: " + network);
//		 });
//	  }
//   })(document);
  </script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110345310-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-110345310-1');
	</script>
</body>
</html>
<?php
if ($_SERVER['QUERY_STRING'] == "") {
// BOTTOM of your script
  $fp = fopen($cachefile, 'w'); // open the cache file for writing
  fwrite($fp, ob_get_contents()); // save the contents of output buffer to the file
  fclose($fp); // close the file
  ob_end_flush(); // Send the output to the browser
}
?>