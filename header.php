<?php require_once('config.php');

 
$header_setting = getData('setting');

if(isset($header_setting['data']['logo']) && !empty($header_setting['data']['logo'])){
    $logo = $header_setting['data']['logo'];
}
if(isset($header_setting['data']['meta_title']) && !empty($header_setting['data']['meta_title'])){
    $meta_title = $header_setting['data']['meta_title'];
}
$facebook_link = $header_setting['data']['facebook_link'];
$twitter_link = $header_setting['data']['twitter_link'];
$instagram_link = $header_setting['data']['instagram_link'];
$youtube_link = $header_setting['data']['youtube_link'];
?>

<!DOCTYPE html>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title><?=$meta_title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <link rel="icon" href="<?=ADMIN_PATH.$header_setting['data']['favicon']; ?>" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,500,600,700,800,900,900i%7CPT+Serif:400,700">
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>css/css.css">
    <link rel="stylesheet" href="<?=BASE_PATH?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=BASE_PATH?>fonts/fonts.css">
    <link rel="stylesheet" href="<?=BASE_PATH?>css/style.css">
    <link rel="stylesheet" href="<?=BASE_PATH?>css/wimmViewer.min.css">
    <link rel="stylesheet" href="<?=BASE_PATH?>css/wimmViewer.scss">
    <link rel="stylesheet" href="<?=BASE_PATH?>css/styles.css">
  </head>
  <body class="">
    <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/warning_bar_0000_us.jpg" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." width="820" height="42"></a></div>
    <div class="preloader loaded">
      <div class="preloader-body">
        <div class="cssload-container">
          <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Loading...</p>
      </div>
    </div>
    <div class="page animated" style="animation-duration: 500ms;">
      <!-- Page Header-->
      <header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap" style="height: 121px;"> 
          <nav class="rd-navbar rd-navbar-aside rd-navbar-original rd-navbar-static rd-navbar--is-stuck" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle toggle-original" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!-- RD Navbar Brand-->
                  <div class="rd-navbar-brand"><a href="<?=BASE_PATH?>index"><img class="brand-logo-light" src="<?=ADMIN_PATH.$logo?>" alt=""></a></div>
                  <div class="block-right">
                    <ul class="list-inline nav-list">
                       <li class="list-inline-item"><a href="<?=BASE_PATH?>index">Home</a></li>
                      <li class="list-inline-item"><a href="<?=BASE_PATH?>about">About</a></li>
                      <li class="list-inline-item"><a href="<?=BASE_PATH?>catmenu">Menu</a></li>
                      <li class="list-inline-item"><a href="<?=BASE_PATH?>services">Services and Reservations</a></li>
                      <li class="list-inline-item"><a href="<?=BASE_PATH?>contact_us">Contacts</a></li>
                    </ul>
                    <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1 toggle-original" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
                    <div class="rd-navbar-aside-outer rd-navbar-collapse toggle-original-elements">
                      <div class="rd-navbar-aside">
                        <ul class="list-inline header-soc-list">
                          <li <?php if (empty($facebook_link)){?>style="display:none"<?php }?>><a href="<?=$facebook_link?>" target="_blank"><a class="icon fa-facebook" href="<?=$facebook_link?>" target="_blank"></a></li>
                          <li <?php if (empty($instagram_link)){?>style="display:none"<?php }?>><a class="icon fa-instagram" href="<?=$instagram_link?>" target="_blank"></a></li>
                          <li <?php if (empty($twitter_link)){?>style="display:none"<?php }?>><a class="icon fa-twitter" href="<?=$twitter_link?>" target="_blank"></a></li>
                          <li <?php if (empty($youtube_link)){?>style="display:none"<?php }?>><a class="icon fa-youtube-play" href="https://www.youtube.com/watch?v=DP8DbPM0zwg&t=1s" target="_blank"></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="rd-navbar-main-element"> 
                  <div class="rd-navbar-nav-wrap toggle-original-elements">
                    <!-- RD Navbar Nav-->
                    <ul class="rd-navbar-nav">
                      <li class="rd-nav-item active"><a class="rd-nav-link" href="<?=BASE_PATH?>index">Home</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="<?=BASE_PATH?>about">About</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="<?=BASE_PATH?>catmenu">Menu</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="<?=BASE_PATH?>services">services and Reservations</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="<?=BASE_PATH?>contact_us">Contacts</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>

