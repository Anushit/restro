  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
     
        <div class="row">
           <?php if(@$this->general_user_premissions['users']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $all_users; ?></h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?= base_url('users')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php }?>
         <?php if(@$this->general_user_premissions['users']['is_allow']==1){ ?>
       
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $active_users; ?></h3>

                <p>Active Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?= base_url('users')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['users']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3><?= $deactive_users; ?></h3>

                <p>Inactive Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('users')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <?php } ?>
          <!-- ./col -->
           <?php if(@$this->general_user_premissions['subadmin']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $subadmin_users ?></h3>

                <p>Subadmin Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?= base_url('subadmin')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php } ?>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <div class="row">
          <?php if(@$this->general_user_premissions['blogs']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $allcounts['ci_blogs']; ?></h3>
                <p>Total Blogs</p>
              </div>
              <div class="icon">
                <i class="fa fa fa-rss"></i>
              </div>
              <a href="<?= base_url('blog')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['banner']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?= $allcounts['ci_banners']; ?></h3>

                <p>Total Banner</p>
              </div>
              <div class="icon">
                <i class="fa fa-picture-o"></i>
              </div>
              <a href="<?= base_url('banner')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['career']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $allcounts['ci_career']; ?></h3>

                <p>Career Records</p>
              </div>
              <div class="icon">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <a href="<?= base_url('career')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
            <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['category']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $allcounts['ci_categories']; ?></h3>

                <p>Total Category</p>
              </div>
              <div class="icon">
                <i class="fa fa-tags"></i>
              </div>
              <a href="<?= base_url('category')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <?php if(@$this->general_user_premissions['cms']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $allcounts['ci_cms']; ?></h3>
                <p>Total CMS Pages</p>
              </div>
              <div class="icon">
                <i class="fa fa fa-file-text-o"></i>
              </div>
              <a href="<?= base_url('cms')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['events']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $allcounts['ci_events']; ?></h3>

                <p>Total Events</p>
              </div>
              <div class="icon">
                <i class="fa fa-calendar"></i>
              </div>
              <a href="<?= base_url('events')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['faq']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $allcounts['ci_faq']; ?></h3>

                <p>Total FAQ</p>
              </div>
              <div class="icon">
                <i class="fa fa-question-circle"></i>
              </div>
              <a href="<?= base_url('faq')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['photo_gallery']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $photo_gallery; ?></h3>
                <p>Total Image Albums </p>
              </div>
              <div class="icon">
                <i class="fa fa-file-image-o"></i>
              </div>
              <a href="<?= base_url('photo_gallery')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
           <?php if(@$this->general_user_premissions['video_gallery']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $video_gallery; ?></h3>
                <p>Total Video Albums</p>
              </div>
              <div class="icon">
                <i class="fa fa-file-video-o"></i>
              </div>
              <a href="<?= base_url('video_gallery')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <?php if(@$this->general_user_premissions['inquiry']['is_allow']==1){ ?>
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $allcounts['ci_inquiry']; ?></h3>
                <p>Total Inquiry</p>
              </div>
              <div class="icon">
                <i class="fa fa-question-circle"></i>
              </div>
              <a href="<?= base_url('inquiry')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['career']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $allcounts['ci_job_application']; ?></h3>

                <p>Job Applictions</p>
              </div>
              <div class="icon">
                <i class="fa fa-briefcase"></i>
              </div>
              <a href="<?= base_url('career')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php  }?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['sms']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $sms; ?></h3>

                <p>Total SMS</p>
              </div>
              <div class="icon">
                <i class="fa fa-commenting-o"></i>
              </div>
              <a href="<?= base_url('sms')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php  }?>
          <?php if(@$this->general_user_premissions['mail']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $mail; ?></h3>
                <p>Total Mail</p>
              </div>
              <div class="icon">
                <i class="fa fa-envelope"></i>
              </div>
              <a href="<?= base_url('mail')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <?php if(@$this->general_user_premissions['whatsapp']['is_allow']==1){ ?>
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $whatsapp; ?></h3>
                <p>Total Whatsapp </p>
              </div>
              <div class="icon">
                <i class="fa fa-whatsapp"></i>
              </div>
              <a href="<?= base_url('whatsapp')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['newsletter']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $allcounts['ci_newsletter']; ?></h3>

                <p>Total Newsletter</p>
              </div>
              <div class="icon">
                <i class="fa fa-newspaper-o"></i>
              </div>
              <a href="<?= base_url('newsletter')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <!-- ./col -->
           <?php if(@$this->general_user_premissions['news']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $allcounts['ci_newsupdates']; ?></h3>

                <p>Total News</p>
              </div>
              <div class="icon">
                <i class="fa fa-newspaper-o"></i>
              </div>
              <a href="<?= base_url('news')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <?php } ?>

          <?php if(@$this->general_user_premissions['portfolio']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $allcounts['ci_portfolio']; ?></h3>
                <p>Total Portfolio</p>
              </div>
              <div class="icon">
                <i class="fa fa-briefcase"></i>
              </div>
              <a href="<?= base_url('portfolio')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <?php } ?>
           <?php if(@$this->general_user_premissions['partner']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $allcounts['ci_partners']; ?></h3>
                <p>Total Partners </p>
              </div>
              <div class="icon">
                <i class="fa fa-address-book-o"></i>
              </div>
              <a href="<?= base_url('partner')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <?php if(@$this->general_user_premissions['portfolio']['is_allow']==1){ ?>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $allcounts['ci_products']; ?></h3>

                <p>Total Products</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-basket"></i>
              </div>
              <a href="<?= base_url('products')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <?php } ?>
          <!-- ./col -->
           <?php if(@$this->general_user_premissions['role']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $allcounts['ci_role']; ?></h3>

                <p>Total Role</p>
              </div>
              <div class="icon">
                <i class="fa fa-question-circle"></i>
              </div>
              <a href="<?= base_url('role')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <?php } ?>
          <?php if(@$this->general_user_premissions['scroll_image']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $allcounts['ci_scroll_images']; ?></h3>
                <p>Total Scroll Images</p>
              </div>
              <div class="icon">
                <i class="fa fa-file-image-o"></i>
              </div>
              <a href="<?= base_url('scroll_image')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
         <?php } ?>
          <?php if(@$this->general_user_premissions['service']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $allcounts['ci_services']; ?></h3>
                <p>Total Services </p>
              </div>
              <div class="icon">
                <i class="fa fa-server"></i>
              </div>
              <a href="<?= base_url('service')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <?php } ?>
          <!-- ./col -->
           <?php if(@$this->general_user_premissions['site_image']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $allcounts['ci_site_images']; ?></h3>

                <p>Total Site Images</p>
              </div>
              <div class="icon">
                <i class="fa fa-image"></i>
              </div>
              <a href="<?= base_url('site_image')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <?php } ?>
          <!-- ./col -->
          <?php if(@$this->general_user_premissions['team']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $allcounts['ci_teams']; ?></h3>

                <p>Total Teams</p>
              </div>
              <div class="icon">
                <i class="fa fa-vcard-o"></i>
              </div>
              <a href="<?= base_url('team')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <?php if(@$this->general_user_premissions['testimonial']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $allcounts['ci_testimonials']; ?></h3>
                <p>Total Testimonials</p>
              </div>
              <div class="icon">
                <i class="fa fa-quote-left "></i>
              </div>
              <a href="<?= base_url('testimonial')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
           <?php if(@$this->general_user_premissions['tour_list']['is_allow']==1){ ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $allcounts['ci_tour_list']; ?></h3>
                <p>Total Tour List</p>
              </div>
              <div class="icon">
                <i class="fa fa-list"></i>
              </div>
              <a href="<?= base_url('tour_list')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php } ?>
          <!-- ./col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
