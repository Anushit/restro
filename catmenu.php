<?php include('header.php');?>
 <?php 

  $filter = array(
        'table'=>'ci_categories',
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'10',
        'where'=> 'is_active=1 and is_feature=1'
    );  
  $categoryData = postData('listing', $filter); 
  /*$filter = array(
        'sort'=>'sort_order',
        'order'=>'asc',
        'start'=>'0',
        'limit'=>'5',
        'where'=> 'is_active=1 and is_feature=1'
    );  
  $results = postData('allproducts', $filter); */   
?>
<?php 
$cat_id = isset($_GET['cat_id']) ? $_GET['cat_id'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$per_page = isset($_GET['per_page']) ? $_GET['per_page'] :10;

$filter_data = array(
     'cat_id' => $cat_id,
     'per_page'=> $per_page,
     'page' =>$page,
     'search'=>$search
);
$results =  postData('all_products',$filter_data);



?>


<section class="parallax-container overlay-1" data-parallax-img="images/breadcrumbs.jpg"><div class="material-parallax parallax"><img src="<?=ADMIN_PATH?>assets/img/banner/slider5.jpg" alt="" style="display: block; transform: translate3d(-50%, 16px, 0px);"></div>
        <div class="parallax-content breadcrumbs-custom context-dark"> 
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-9">
                <h2 class="breadcrumbs-custom-title">Menu</h2>
                <ul class="breadcrumbs-custom-path">
                  <li><a href="<?=BASE_PATH?>index">Home</a></li>
                  <li class="active">Menu</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section section-lg bg-default">
        <div class="container">
          <div class="row row-70 justify-content-xl-between">
            <div class="col-lg-8">
              <div class="row">
                     <?php if(!empty($results['data'])){ 
                          foreach ($results['data']  as  $key => $product) {
                             if($key==0){
                            $isactive = 'active show';
                         }else{
                          $isactive = '';   
                           }
                            $i=0;
                    if($i==2){ echo '</div> <div class="row">'; $i=0; }?>
                <div class="col-md-6">
                  <div class="post-classic">
                     <h4 class="post-classic-title"><a href="<?=BASE_PATH?>menu_details?id=<?=$product['id']?>"><?=$product['name']?></a></h4>
                    <div class="post-classic-figure"><a href="<?=BASE_PATH?>menu_details?id=<?=$product['id']?>"><img src="<?=getimage($product['image'],'noimage.png') ?>" alt="" width="370" height="255"></a></div>
                    <div class="post-classic-caption">
                       <p class="events-time">Price : $<?=$product['price']?></p>
                        <p class="text-justify"><?=mb_strimwidth($product['sort_description'],0,200,'..')?></p>
                    </div>
                  </div>
                </div>
                 <?php $i++; }}
                 else{
                      echo "No Product Found";
                        }
                ?>  
                <!-- Bootstrap Pagination-->
        <!--          -->
              </div>
            </div>
            <div class="col-lg-4 col-xl-3">
              <div class="block-aside">
                <div class="block-aside-item">
                  <h5 class="block-aside-title">All Categories</h5>
                  <ul class="category-list">
                    <?php if(!empty($categoryData['data'])){ 
                          foreach ($categoryData['data'] as $key => $cat) { 
                          if($cat['id']==$cat_id){
                            $isactive = 'active';
                         }else{
                          $isactive = '';   
                           }?>
                    <li class="<?php echo $isactive?>"><a  href="<?=BASE_PATH?>catmenu?cat_id=<?=$cat['id']?>"><?=$cat['name']?></a></li>
                    <?php }}?>
                  </ul>

                </div>
                <div class="block-aside-item">
                  <h5 class="block-aside-title">Search products</h5>
                  <form class="rd-search form-sm" action="<?=BASE_PATH?>catmenu" method="get">
                    <div class="form-wrap">
                      <label class="form-label rd-input-label" for="rd-search-form-input">Search</label>
                      <input class="form-input" id="rd-search-form-input" type="text" name="search" autocomplete="off">
                       <input type="hidden" name="cat_id" value="<?=$cat_id?>">
                    </div>
                  </form>
                </div>
                <div class="block-aside-item">
                  <h5 class="block-aside-title">Contact Here</h5>
                      <div class="link-box"><a href="<?=BASE_PATH?>contact_us" class="btn btn-primary">Contact Here</a></div>
                </div>
                </div>
              </div>
            </div>
          </div>
          <nav aria-label="Page navigation">
                <ul class="pagination pagination-classic">
                      <?php   
                      if(isset($results['product_count']) && $results['product_count'] > 0){
                       $total_products = $results['product_count'];
                       $total_page =  ceil($total_products / $per_page);
                    
                       for($i = 1; $i <= $total_page; $i++){ 
                        if($i==$page){
                            $isactive = 'active show';
                         }else{
                          $isactive = '';   
                           }?>
                    <li class="page-item page-item-control <?php echo $isactive?>"><a class="page-link" href="<?=BASE_PATH?>catmenu?cat_id=<?=$cat_id?>&page=<?=$i?>"><?=$i?></a></li>
                    <?php } } ?>
                </ul>
        </nav>
        </div>
      </section>
  <?php include('footer.php');?>