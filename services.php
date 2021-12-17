<?php include('header.php');
    $filter = array(
        'table'=>'ci_services',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'10',
        'where'=> 'is_active=1'
    );  
    $serviceData = postData('listing', $filter); 
$cmsData = getData('cms',7);
?>
<section class="parallax-container overlay-1" data-parallax-img="images/breadcrumbs.jpg"><div class="material-parallax parallax"><img src="<?=ADMIN_PATH.$cmsData['data']['cms_banner']?>" alt="" style="display: block; transform: translate3d(-50%, 8px, 0px);"></div>
        <div class="parallax-content breadcrumbs-custom context-dark"> 
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-9">
                <h2 class="breadcrumbs-custom-title">Service & Reservations</h2>
                <ul class="breadcrumbs-custom-path">
                  <li><a href="<?=BASE_PATH?>index">Home</a></li>
                  <li class="active">Service & Reservations</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
    
           <section class="section-lg bg-default text-center">
            <div class="container">
               <h3>Service and Reservation</h3>
             </div>
              <div class="container">
              <p class="text-justify"><?=$cmsData['data']['cms_contant']?></p>
             </div>
        <div class="container">
          <div class="row row-50">
           <?php if(!empty($serviceData['data'])){
        $i=0;
        foreach ($serviceData['data'] as $svalue) { 
        if($i==3){ echo '</div> <div class="row row-50">'; $i=0; }?>
            <div class="col-md-6 col-lg-4">
              <div class="box-icon-classic">
                <div class="icon-bg" style="text-align: center;"><img src="<?=ADMIN_PATH.$svalue['image']?>" width="150" height="150"></div>
                <div class="box-icon-caption">
                  <h4><a href="#"><?=$svalue['name']?></a></h4>
                  <p class="text-justify"><?=$svalue['description']?></p>
                </div>
              </div>
            </div>
            <?php $i++; }}?>
          </div>
        </div>
      </section>
      
<?php include('footer.php');?>