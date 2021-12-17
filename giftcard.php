<?php include('header.php');

$data = array(
  'table' => 'ci_scroll_images',
  'where' =>'is_active=1'
);
$scroll_images = postData('listing',$data);
?>
<section class="parallax-container overlay-1" data-parallax-img="images/breadcrumbs.jpg"><div class="material-parallax parallax"><img src="<?=ADMIN_PATH?>assets/img/banner/slider4.jpg" alt="" style="display: block; transform: translate3d(-50%, 8px, 0px);"></div>
        <div class="parallax-content breadcrumbs-custom context-dark"> 
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-9">
                <h2 class="breadcrumbs-custom-title">Gift Cards</h2>
                <ul class="breadcrumbs-custom-path">
                  <li><a href="<?=BASE_PATH?>index">Home</a></li>
                  <li class="active">Gift Cards</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
        <section class="section">
        <div class="row isotope-wrap">
          <!-- Isotope Content-->

          <div class="container">
            <h3 style="text-align: center;padding-top:20px;padding-bottom:50px">Gift Cards</h3>
          </div>
          <div class="col-lg-12">
            <div class="isotope" data-isotope-layout="fitRows" data-isotope-group="gallery" data-lightgallery="group" data-lg-thumbnail="false" style="position: relative; height: 616.484px;">
              <div class="row no-gutters row-condensed">
                <?php  
                            if(!empty($scroll_images['data'])){
                                foreach ($scroll_images['data'] as $gvalue) { ?>
                <div class="col-12 col-sm-6 col-md-4 isotope-item wow-outer" data-filter="*" style="position: absolute; left: 0px; top: 0px;">
                  <div class="wow slideInDown" style="visibility: visible;">
                    <div class="gift-item-classic"><img src="<?=getimage($gvalue['image'],'noimage.png') ?>" alt="" width="640" height="300">
                      <div class="gallery-item-classic-caption"><a href="<?=ADMIN_PATH.$gvalue['image']?>" data-lightgallery="item">zoom</a></div>
                    </div>
                  </div>
                </div>
              <?php }}?>
               
             
             
              </div>
            </div>
          </div>
        </div>
      </section>
         
<?php include('footer.php');?>