<?php require_once('config.php');
$footer_setting = getData('setting');
$general_setting = getData('setting',6);

if(isset($footer_setting['data']['logo']) && !empty($footer_setting['data']['logo'])){
    $logo = $footer_setting['data']['logo'];
}
if(isset($general_setting['data']['whatsapp_button']) && !empty($general_setting['data']['whatsapp_button'])){
    $whatsapp_button = $general_setting['data']['whatsapp_button'];
}

$facebook_link = $footer_setting['data']['facebook_link'];
$twitter_link = $footer_setting['data']['twitter_link'];
$instagram_link = $footer_setting['data']['instagram_link'];
$youtube_link = $footer_setting['data']['youtube_link'];
?>
      <footer class="section footer-minimal context-dark">
        <div class="container wow-outer">
          <div class="wow fadeIn" style="visibility: hidden; animation-name: none;">
            <div class="row row-60">
              <div class="col-12"><a href="<?=BASE_PATH?>index"><img src="<?=ADMIN_PATH.$logo?>" alt="" width="250"></a></div>
              <div class="col-12">
                <ul class="footer-minimal-nav">
                  <li><a href="<?=BASE_PATH?>index">Home</a></li>
                  <li><a href="<?=BASE_PATH?>about">About</a></li>
                  <li><a href="<?=BASE_PATH?>catmenu">Menu</a></li>
                  <li><a href="">Services and Reservations</a></li>
                  <li><a href="<?=BASE_PATH?>contact_us">Contact Us</a></li>
                   <li><a href="<?=BASE_PATH?>giftcard">GiftCards</a></li>
                  
                </ul>
              </div>
              <div class="col-12">
                <ul class="social-list">
                  <li <?php if (empty($facebook_link)){?>style="display:none"<?php }?>><a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-facebook" href="<?=$facebook_link?>" target="_blank"></a></li>
                  <li <?php if (empty($instagram_link)){?>style="display:none"<?php }?>><a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-instagram" href="<?=$instagram_link?>" target="_blank"></a></li>
                  <li  <?php if (empty($twitter_link)){?>style="display:none"<?php }?>><a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-twitter" href="<?=$twitter_link?>" target="_blank"></a></li>
                  <li  <?php if (empty($youtube_link)){?>style="display:none"<?php }?>><a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-youtube-play" href="https://www.youtube.com/watch?v=DP8DbPM0zwg&t=1s" target="_blank"></a></li>
                  
                </ul>
              </div>
            </div>
            <div class="rights"><?=$footer_setting['data']['copyright']?> | Developed By : <a href="https://adiyogitechnosoft.com" target="_blank">Adiyogi Technosoft</a></div>
          </div>
        </div>
      </footer>
       <div class="<?php echo ($whatsapp_button != "")?"":"hide"; ?>">
         <?=$whatsapp_button?>
        </div>
    </div>
    <script src="<?=BASE_PATH?>js/core.js"></script>
    <script src="<?=BASE_PATH?>js/script.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js' >
    </script> 
    <!-- <script src="<?=BASE_PATH?>js/wimmViewer.js"></script> -->
    <script src="<?=BASE_PATH?>js/wimmViewer.min.js"></script>   
	
</body>
</html>