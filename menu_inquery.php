
<?php include('header.php');


$general_setting = getData('setting');
if(isset($general_setting['data']['phone']) && !empty($general_setting['data']['phone'])){
    $phone = $general_setting['data']['phone'];
}
if(isset($general_setting['data']['address']) && !empty($general_setting['data']['address'])){
    $address = $general_setting['data']['address'];
}
if(isset($general_setting['data']['email']) && !empty($general_setting['data']['email'])){
    $email = $general_setting['data']['email'];
}

if(isset($_POST['submit'])){ 
    $msg = '';
    if($msg==''){
        $data = $_POST;
        $contactData = postData('menuinquery', $data);
        $msg = $contactData['message'];
    } 
}


?> 

<section class="parallax-container overlay-1" data-parallax-img="images/breadcrumbs.jpg"><div class="material-parallax parallax"><img src="<?=ADMIN_PATH?>assets/img/banner/slider4.jpg" alt="" style="display: block; transform: translate3d(-50%, 8px, 0px);"></div>
        <div class="parallax-content breadcrumbs-custom context-dark"> 
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-9">
                <h2 class="breadcrumbs-custom-title">Inquery Now</h2>
                <ul class="breadcrumbs-custom-path">
                  <li><a href="<?=BASE_PATH?>index">Home</a></li>
                  <li class="active">INQUERY HERE</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section section-lg text-center bg-default">
        <div class="container">
          <div class="row row-50">
            <div class="col-md-6 col-lg-4">
              <div class="box-icon-classic">
                <div class="box-icon-inner decorate-triangle"><span class="icon-xl linearicons-phone-incoming"></span></div>
                <div class="box-icon-caption" <?php if (empty($phone)){?>style="display:none"<?php } ?>>
                  <h4><a href="tel:<?=$phone?>"><?=$phone?></a></h4>
                  <p>You can call us anytime</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="box-icon-classic">
                <div class="box-icon-inner decorate-circle"><span class="icon-xl linearicons-map2"></span></div>
                <div class="box-icon-caption" <?php if (empty($address)){?>style="display:none"<?php } ?>>
                  <h4><?=$address?></a></h4>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="box-icon-classic">
                <div class="box-icon-inner decorate-rectangle"><span class="icon-xl linearicons-paper-plane"></span></div>
                <div class="box-icon-caption" <?php if (empty($email)){?>style="display:none"<?php } ?> >
                  <h4><a href="mailto:#"><?=$email?></a></h4>
                  <p>Feel free to email us your questions</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section section-lg bg-gray-1 text-center">
        <div class="container">
          <div style="background-color: white; border:0;">
              <?php
                  if(!empty($msg)){
                  echo "<div class='alert alert-success text-center'>".$msg."</div>";
                  } 
              ?>
        </div> 
                         
          <div class="row justify-content-md-center">
            <div class="col-md-9 col-lg-7">
              <h3>Inquery Here</h3>
              <!-- RD Mailform-->
               <form class="rd-form " method="post" action="<?=BASE_PATH.'menu_inquery'?>" id="con_form">
                <div class="form-wrap">
                  <input type="text" placeholder="Enter Name"class="form-input form-control-has-validation" id="name" type="text" name="name">
                </div>
                <div class="form-wrap">
                  <input class="form-input form-control-has-validation" placeholder="Enter Email" id="email" type="email" name="email">
                </div>
                <div class="form-wrap">
                  <input class="form-input form-control-has-validation" placeholder="Enter mobile" id="mobile" type="text" name="mobile">
                </div>
                <div class="form-wrap">
                  <input class="form-input form-control-has-validation" placeholder="Enter subject" id="subject" type="text" name="subject">
                </div>
                <div class="form-wrap">
                  <textarea class="form-input form-control-has-validation form-control-last-child" id="message" name="message" placeholder="Enter Message"></textarea>
                </div>
                <input type="hidden" name="inquiry_type" value="2">
                <div class="row justify-content-center">
                  <div class="col-12 col-sm-7 col-lg-5">
                    <button class="button button-block button-lg button-primary submitData" type="submit" name="submit">Send</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

<?php include('footer.php');?>
 <script type="text/javascript"> 
        //Refresh Captcha
        jQuery(document).ready(function(){

            jQuery(document).on("click", ".submitData", function(e){  
            if (jQuery("#con_form").valid()) { 
                // alert("asdf");
                jQuery("#con_form").submit();
            }
        });

        jQuery("#con_form").validate({
            rules: {
                name: "required",
                email: {required: true, email: true},
                mobile: {
                    required: true, 
                    number: true,
                    minlength:10,
                    maxlength:10,
                },
                subject: "required",
                message: "required", 
            },
            messages: {
                name: "Please Enter Full Name",
                email: { 
                  "required": "Please Enter Email Address",
                  "email": "Please Enter Valid Email Address",
                },
                mobile: { 
                  "required": "Please Enter Mobile No.",
                  "number": "Please Enter Valid Mobile No",
                  "minlength": "Mobile No Should Be 10 Digits",
                  "maxlength": "Mobile No Should Be 10 Digits",
                },
                subject: "Please Enter Subject",
                message: "Please Enter Message",  
            }
        }); 

        });
  

</script>