<?php include('header.php');
$aboutdata = getData('cms',3);
$siteimage = getData('sideimage',1);
    $filter = array(
        'table'=>'ci_services',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'10',
        'where'=> 'is_active=1'
    );  
    $serviceData = postData('listing', $filter); 
?>
<section class="parallax-container overlay-1" data-parallax-img="images/breadcrumbs.jpg"><div class="material-parallax parallax"><img src="<?=ADMIN_PATH.$aboutdata['data']['cms_banner']?>" alt="" style="display: block; transform: translate3d(-50%, 8px, 0px);"></div>
        <div class="parallax-content breadcrumbs-custom context-dark"> 
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-9">
                <h2 class="breadcrumbs-custom-title">About Us</h2>
                <ul class="breadcrumbs-custom-path">
                  <li><a href="<?=BASE_PATH?>index">Home</a></li>
                  <li class="active">About Us</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section section-lg bg-gray-1">
        <div class="container">
          <div class="row row-50">
            <div class="col-lg-6 pr-xl-5"><img src="<?=getimage($siteimage['data']['image'],'noimage.png')?>" height="300" width="500">
            </div>
              <div class="col-lg-6">
              <h2>Our Profile</h2>
              <p class="text-justify"><?=$aboutdata['data']['cms_contant']?></p>
            </div>
          </div>
        </div>
      </section>
           <section class="section-lg bg-default text-center">
            <div class="container">
               <h3>Why People Choose Us</h3>
             </div>
        <div class="container">
          <div class="row row-50">
           <?php if(!empty($serviceData['data'])){
        $i=0;
        foreach ($serviceData['data'] as $svalue) { 
        if($i==3){ echo '</div> <div class="row row-50">'; $i=0; }?>
            <div class="col-md-6 col-lg-4">
              <div class="box-icon-classic">
                <div class="icon-bg" style="text-align: center;"><img src="<?=ADMIN_PATH.$svalue['icon']?>" width="50" height="50"></div>
                <div class="box-icon-caption">
                  <h4><?=$svalue['name']?></a></h4>
                  <p class="text-justify"><?=$svalue['description']?></p>
                </div>
              </div>
            </div>
            <?php $i++; }}?>
          </div>
        </div>
      </section>
      
<?php include('footer.php');?>