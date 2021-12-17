<?php include('header.php');
$id = $_GET['id'];
$product = getData('product_details',$id);

?>
<section class="parallax-container overlay-1" data-parallax-img="images/breadcrumbs.jpg"><div class="material-parallax parallax"><img src="<?=ADMIN_PATH?>assets/img/banner/slider4.jpg" alt="" style="display: block; transform: translate3d(-50%, 8px, 0px);"></div>
        <div class="parallax-content breadcrumbs-custom context-dark"> 
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-9">
                <h2 class="breadcrumbs-custom-title">Menu Details</h2>
                <ul class="breadcrumbs-custom-path">
                  <li><a href="<?=BASE_PATH?>index">Home</a></li>
                  <li class="active">Menu Detail</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section section-lg bg-gray-1">
        <div class="container">
          <div class="row row-50">
<!--             <div class="col-lg-6 pr-xl-5"><img src="<?=getimage($product['data']['image'],'noimage.png') ?>" alt="" width="370" height="255">
 -->
              <div id="slider1" class="wimm_carousel">
                <div class="carousel">
                  <ul class="carousel_inner" style="margin-left: -5px; margin-right: -5px; left: -110px;">
                    <?php if(!empty($product['data'])){
  
                     foreach ($product['data'] as $svalue) {?>
                    <li class="item" style="background-image: url(<?=getimage($svalue['image'],'noimage.png') ?>); width: 100px; height: 50px; margin-right: 5px; margin-left: 5px;" data-url="<?=getimage($svalue['image'],'noimage.png') ?>"  width="450" height="300"  >
                    </li>
                    <?php }}?>
                  </ul>
                </div>
              </div>

            <div class="col-lg-6">
              <h3><?=$product['data'][0]['name']?></h3>
              <p class="events-time">Price : $<?=$product['data'][0]['price']?></p>
              <p class="text-justify"><?=mb_strimwidth($product['data'][0]['meta_description'],0,200,"...")?></p>
            </div>
          </div>

        </div>
      </section>  
<?php include('footer.php');?>
<script>
    $(function(){
        $('#slider1').WimmViewer({
            miniatureWidth : 100,
            miniatureHeight: 100
/*            miniaturePosition:'top'
*/     
            // Availables customizations:
          
/*             miniatureSpace: 5,
/**/           /*  viewerMaxHeight:false*/
             /*nextText:'NEXT <span class="fa fa-caret-right"></span>',*/

/*              prevText:'<span class="fa fa-caret-left"></span> PREV',
*/
           /*  onImgChange : function(){} ,*/
             /*onNext : function() {},
             onPrev : function(),*/
            
        });
    })
</script>
