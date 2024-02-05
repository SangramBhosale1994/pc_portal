<?php
include 'includes/training-header.php';
include 'includes/send_mail_ticketing.php';
?>
<!-- php code by pooja for contact form submission -->
<?php
if (isset($_POST['btn-send'])) {
  $userName = $_POST['UName'];
  $Email = $_POST['Email'];
  $msg = $_POST['msg'];

  $name = $sanitizer->text($input->UName);
  $email = $sanitizer->email($input->post->Email);
  $user_message = $sanitizer->text($input->post->msg);

  /*** Basic Page Creation Info */
  $new_profile_page = new Page();
  $new_profile_page->template = $templates->get("contactus_info");
  $new_profile_page->parent = $pages->get("name=user-information");
  $new_profile_page->title = $name;
  /*** Basic Page Creation Info End */

  $new_profile_page->title = $name;
  $new_profile_page->email_address = $email;
  $new_profile_page->text_description = $user_message;

  $new_profile_page->of(false);
  $new_profile_page->save();
  //storing user data end here

  $timestamp = strtotime('+5 second');
  header("Location:" . $page->httpUrl . "?success=" . $timestamp . "#modules");
}

?>


<!-- contact form submission end -->
<?php
if (isset($_POST['btn_send_request'])) {
  if ($input->post->id_check != "") {
    header("location:" . $page->httpUrl);
    exit();
  } else {
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $phone = $_POST['user_phone_number'];
    $subject = 'INQUIRY: Learning & Development Offerings';
    // $message="User Name : ".$name;
    // $message.="User Email : ".$email;
    // $message.="User Phone Number : ".$phone;
    $message = "<p>User Details- <br> User Name: $name <br> User Email: $email <br> User Phone : $phone </p>";
    // $to="amruta.jagatap@zerovaega.com";
    $to = "contact@thepridecircle.com";
    // $headers = "From: Zerovaega Technologies  <zerovaegatechnologies@gmail.com>". PHP_EOL;
    try {
      send_smtp_mail($to, $message, $subject);
    } catch (Exception $e) {
    }
  }
}
?>
<style>
  .text_test_one {
    display: flex;
  }

  .text_test_two {
    padding-left: 20px;
  }

  .items {
    width: 90%;
    margin: 0px auto;
    /*margin-top: 100px*/
  }

  .slick-slide {
    margin: 10px
  }

  .slick-prev:before,
  .slick-next:before {
    font-family: 'slick';
    font-size: 20px;
    line-height: 1;
    opacity: .75;
    color: #481364;
    -webkit-font-smoothing: antialiased;
  }

  .text_card {
    position: relative;
    display: flex;
    width: 350px;
    height: 171px;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #d2d2dc;
    border-radius: 11px;
    -webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
    -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
    box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
  }

  .text_card .text_card_body {
    padding: 1rem 1rem
  }

  .text_card_body {
    flex: 1 1 auto;
    padding: 1.25rem
  }

  @media screen and (max-width: 768px) {
    .text_card {
      position: relative;
      display: flex;
      width: 350px;
      height: 202px;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 1px solid #d2d2dc;
      border-radius: 11px;
      -webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
      -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
      box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
    }

    .twitter_embed {
      text-align: center;
      margin-top: 2rem;
    }

    .facebook_embed {
      text-align: center;
    }
  }

  @media screen and (max-width: 1024px) and (min-width: 768px) {
    .text_card {
      position: relative;
      display: flex;
      width: 350px;
      height: 275px;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 1px solid #d2d2dc;
      border-radius: 11px;
      -webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
      -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
      box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
    }


  }

  @media screen and (max-width: 767px) and (min-width: 597px) {
    .text_card {
      position: relative;
      display: flex;
      width: 350px;
      height: 382px;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 1px solid #d2d2dc;
      border-radius: 11px;
      -webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
      -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
      box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
    }
  }

  /* css by pooja for yellow mini play demo button  */
  .yellow-mini {
    background-color: #ffbd1a !important;
    color: #000033 !important;
  }

  /* css by pooja for popup form */
  .sm-form-control {
    border: 1px solid #ced4da !important;
    border-radius: 0.25rem !important;

  }

  .sm-form-control:focus {
    border: 1px solid #212529 !important;
  }

  #section {
    width: 500px;
    height: 400px;
    word-wrap: break-word;
  }

  .moretext {
    display: none;
  }
  /* css by pooja for success message */
  .toast-top-right {
    top: 83px !important;
    right: 12px;
}
.toast-success:hover {
    background-color: #51A351 !important;
    opacity: 0.8 !important;
    box-shadow: 0 0 12px #00000075 !important;
}
</style>
<!-- web view slider by Amruta Jagtap -->
<?php
if ($page->Banner_repeater != "") {
?>
  <section id="web_banner_slider" class="hide-image-in-mobie slider-element boxed-slider web_slider_section">
    <div class=" clearfix">
      <div class="fslider" data-animation="fade">
        <div class="flexslider">
          <ul class="slider-wrap">
            <?php
            foreach ($page->Banner_repeater as $Banner_repeater) {
            ?>
              <li class="slide " data-thumb="<?= $Banner_repeater->banner_image->httpUrl; ?>">
                <a href="<?= $Banner_repeater->banner_image->description; ?>" class="d-block position-relative">
                  <img src="<?= $Banner_repeater->banner_image->httpUrl; ?>" alt="Slide 2">

                </a>
              </li>
            <?php
            }
            ?>
          </ul>
        </div>
        <!-- Id For Redirecting to philosophy section -->
        <div id="philosophy" class="" style=""></div>
      </div>

    </div>
  </section>

  <!--web view slider end  -->

  <!-- mobile view slider by Amruta Jagtap -->
  <section id="mob_banner_slider" class="hide-image-in-web slider-element boxed-slider mob_slider_section">
    <div class=" clearfix">
      <div class="fslider" data-animation="fade">
        <div class="flexslider">
          <div class="slider-wrap">
            <?php
            foreach ($page->mobile_banner_repeater as $mobile_banner_repeater) {
            ?>
              <div class="slide" data-thumb="<?= $mobile_banner_repeater->banner_image->httpUrl; ?>">
                <a href="<?= $mobile_banner_repeater->banner_image->description; ?>" class="d-block position-relative">
                  <img src="<?= $mobile_banner_repeater->banner_image->httpUrl; ?>" alt="Slide 2">
                </a>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <!-- Id For Redirecting to philosophy section -->
      <div id="philosophy" class=""></div>
    </div>
  </section>
<?php
}
?>
<!-- mobile view slider end  -->

<!-- Our Philosophy section by Amruta jagtap -->
<?php
if ($page->rich_textarea_1 != "") {
?>
  <section class="philosophy_section">
    <div class="container-fluid" style="background:#F1F2F2;">
      <div class="text-center title-center title-border title_height" style=" padding-top: 2rem;">
        <div class="title_new" style=""><?= $page->rich_textarea_1; ?></div>
      </div>
      <div class="container image_text_section philosophy_container">
        <?php
        if ($page->our_philosophy_image != "") {
          $div_columns = "col-md-6";
          $padding = "padding-bottom:0px";
        } else {
          $div_columns = "col-md-12";
          $padding = "padding-bottom:50px";
        }
        ?>
        <div class="row col-mb-50 image_text_col" style="padding-top: 35px; <?= $padding ?>">



          <div class="mt-md-2 <?= $div_columns ?> discription_section tertiary-font philosophy_mobile">
            <?php
            $string = strip_tags($page->text_description);


            if (strlen($string) > 700) {

              // truncate string
              $stringCut = substr($string, 0, 700);
              $endPoint = strrpos($stringCut, '.') + 1;

              //if the string doesn't contain any space then it will cut without word basis.
              $text_description = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
              // $string .= '...';
              $str_length = strlen($text_description);
              $last_string = strlen($string);
              $remaining_philosophy_text_description = $endPoint ? substr($string, $endPoint, $last_string) : substr($string, $endPoint);
            } else {
              $text_description = $page->text_description;
              $remaining_philosophy_text_description = "";
            }

            // echo $str_length;
            ?>
            <?= $page->heading1; ?>

            <div class="read_more_text">
              <?= $page->text_description; ?>
            </div>




            <?php
            if (strlen($string) > 700) {
            ?>
              <div class="d-block">
                <button id="btn_read_more" class="button button-3d button-rounded  button-light  mt-5" style="background-color:#ffbd1a;"></i>READ MORE </button>
              </div>
            <?php
            }
            ?>
            <!-- </div> -->
          </div>

          <?php
          if ($page->our_philosophy_image != "") {
          ?>
            <div class="col-md-6">
              <!-- <a href="https://vimeo.com/101373765" class="d-block position-relative rounded overflow-hidden" data-lightbox="iframe"> -->
              <img src="<?= $page->our_philosophy_image->httpUrl; ?>" alt="Image" class="w-100">

            </div>
          <?php
          }
          ?>
        </div>
      </div>
      <!-- Id For Redirecting to What we do section -->
      <div id="what_we_do" class=""></div>
    </div>

  </section>

<?php
}
?>
<!-- End Our Philosophy section by Amruta jagtap -->

<!-- What we do section by Amruta jagtap -->
<?php
if ($page->rich_textarea_2 != "") {
?>
  <section id="" style="background:#fff;">
    <div class="container" style="background:#fff;">
      <div class="text-center title-center title-border title_height" style=" padding-top: 2rem;">
        <div class="title_new" style=""><?= $page->rich_textarea_2; ?></div>
      </div>
      <div class=" title-center title-border mt-4 title_description">
        <?= $page->rich_textarea_3; ?>
      </div>
      <div class="container image_text_section ">
        <div class="container what_we_do_container">
          <div class="row col-mb-50 mb-0 what_we_do_row" style="">
            <!-- <div class="col-md-1"></div> -->
            <?php
            foreach ($page->text_image_repeater as $single_repeater) {
            ?>
              <div class="col-md-3 col-sm-12 what_we_do_col">
                <div class="oc-item">
                  <div class="feature-box fbox-center fbox-border fbox-dark">
                    <div class="fbox-icon what_we_do_img_circle">
                      <img src="<?= $single_repeater->image->httpUrl; ?>" alt="Image" class="w-100 what_we_do_img" style="background-color: transparent !important;">
                    </div>
                    <div class="fbox-content what_we_content">
                      <h3><b><?= $single_repeater->text_1; ?></b></h3>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
            <!-- <div class="col-md-1"></div> -->
          </div>
        </div>
      </div>
      <!-- Id For Redirecting to What we do section -->
      <div id="our_offering" class=""></div>
    </div>
  </section>
<?php
}
?>
<!-- End What we do section by Amruta jagtap -->

<!-- Our Offering section by Amruta jagtap -->
<?php
if ($page->rich_textarea_4 != "") {
?>
  <section id="" style="background:#F1F2F2;">
    <div class="container offering_container" style="background:#F1F2F2;">
      <div class="text-center title-center title-border title_height" style=" padding-top: 2rem;">
        <div class="title_new offering_title" style=""><?= $page->rich_textarea_4; ?></div>
      </div>
      <div class=" title-center title-border mt-4 title_description ">
        <?= $page->rich_textarea_5; ?>
      </div>
      <div class=" mt-5 our_offering_section">
        <div class="row justify-content-center col-mb-50 mb-0">
          <?php
          foreach ($page->cards_section as $single_repeater) {
          ?>
            <div class="col-sm-6 col-lg-3">
              <div class="feature-box fbox-center fbox-bg fbox-light fbox-effect offering_card" style="background-color: #ffffff;border:none;">
                <div class="fbox-icon offering_card_icon">
                  <i class="icon-star"></i>
                </div>
                <div class="fbox-content p-0">
                  <h3 class="secondary-font offering_card_title"><b><?= $single_repeater->bank_name; ?></b></h3>
                  <span class="contact-card-text subtitle tertiary-font offering_card_text"><?= $single_repeater->text_description; ?></span></a>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
      <!-- Id For Redirecting to Signature section -->
      <div id="signature" class=""></div>
    </div>
  </section>
<?php
}
?>
<!-- End Our Offering section by Amruta jagtap -->

<!-- Signature section by Amruta jagtap -->
<?php
if ($page->rich_textarea_6 != "") {
?>
  <section id="web_view_signature" style="background:#41007a;">
    <div class="container signature_container" style="background:#41007a;">
      <div class="text-center title-center title-border title_height" style=" padding-top: 2rem;">
        <div class="title_new " style=""><?= $page->rich_textarea_6; ?></div>
      </div>
      <div class=" mt-5  signature_grid_padding">
        <!-- <div class="row justify-content-center col-mb-50 mb-0"> -->
        <div class="row grid-container signature_grid_section" data-layout="masonry" style="overflow: visible">
          <?php


          $counter = 1;
          foreach ($page->text_image_repeater_4 as $signature_repeater) {
            if ($counter % 2 == 0) {
              $color = "#FFCE61";
            } else {
              $color = "#E8A613";
            }
          ?>
            <div class="col-lg-3 col-sm-12 signature_flip_cards p-0 mb-0">
              <!-- <div class="flip-card text-center"> -->
              <div class="text-center">
                <div class="flip-card-front signature_card " style="background-color:<?= $color ?>;">
                  <div class="flip-card-inner signature_card_inner">
                    <div class="card border-0 text-center signature_card_section" style="background-color:transparent;">
                      <div class="card-body signature_card_body">
                        <h3 class="card-title signature_card_title"><?= $signature_repeater->text_1; ?></h3>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="flip-card-back no-after signature_card " style="background-color:<?= $color ?>;">
                  <div class="flip-card-inner signature_card_inner signature_card_text">
                    <?= $signature_repeater->rich_textarea_1; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php
            $counter++;
          }
          ?>

        </div>
      </div>
      <!-- Id For Redirecting to whats new section -->
      <div id="whats_new" class=""></div>
    </div>
  </section>

  <section id="mobile_view_signature" style="background:#41007a;">
    <div class="container signature_container" style="background:#41007a;">
      <div class="text-center title-center title-border title_height" style=" padding-top: 2rem;">
        <div class="title_new mob_signature_title" style=""><?= $page->rich_textarea_6; ?></div>
      </div>
      <div class=" mt-5 pb-5">
        <!-- <div class="row justify-content-center col-mb-50 mb-0"> -->
        <div class="row grid-container " data-layout="masonry" style="overflow: visible">
          <?php


          $counter = 1;
          foreach ($page->text_image_repeater_4 as $signature_repeater) {
            if ($counter % 2 == 0) {
              $color = "#FFCE61";
            } else {
              $color = "#E8A613";
            }
          ?>
            <div class="col-lg-3 col-sm-12 mob_signature_card_flip_col">
              <!-- <div class="flip-card text-center"> -->
              <div class=" text-center">
                <div class="flip-card-front mob_signature_card_flip signature_card" style="background-color:<?= $color ?>;">
                  <div class="flip-card-inner signature_card_inner ">
                    <div class="card border-0 text-center " style="background-color:transparent;">
                      <div class="card-body signature_card_body">
                        <h3 class="card-title signature_card_title"><?= $signature_repeater->text_1; ?></h3>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="flip-card-back no-after  mob_signature_card_flip signature_card" style="background-color:<?= $color ?>;">
                  <div class="flip-card-inner signature_card_inner signature_card_text">
                    <?= $signature_repeater->rich_textarea_1; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php
            $counter++;
          }
          ?>

        </div>
      </div>
      <!-- Id For Redirecting to whats new section -->
      <div id="whats_new" class=""></div>
    </div>
  </section>
<?php
}
?>
<!-- End Signature section by Amruta jagtap -->

<!-- What's new section by Amruta jagtap -->
<?php
if ($page->rich_textarea_7 != "") {
?>
  <section id="" style="background:#F1F2F2;">
    <div class="container" style="background:#F1F2F2;">
      <div class="text-center title-center title-border " style=" padding-top: 1.5rem;padding-bottom:1rem;">
        <div class="title_new" style=""><?= $page->rich_textarea_7; ?></div>
      </div>
      <!-- Id For Redirecting to how we do it section -->
      <div id="how_we_do_it" class=""></div>
    </div>
  </section>
<?php
}
?>
<!-- End What's new section by Amruta jagtap -->

<!-- How we Do it section by Amruta jagtap -->
<?php
if ($page->rich_textarea_8 != "") {
?>
  <section id="" style="background:#fff;">
    <div class="container" style="background:#fff;">
      <div class="text-center title-center title-border title_height" style=" padding-top: 2rem;">
        <div class="title_new" style=""><?= $page->rich_textarea_8; ?></div>
      </div>
      <div class=" title-center title-border mt-4 title_description">
        <?= $page->rich_textarea_9; ?>
      </div>
      <div class="container  how_we_do_it_container ">
        <div class="row justify-content-center col-mb-50 mb-0">
          <?php
          foreach ($page->text_image_repeater_1 as $single_repeater) {
          ?>
            <div class="col-md-3 col-sm-12 how_we_do_col">
              <div class="oc-item">
                <div class="feature-box fbox-center fbox-border fbox-dark">
                  <div class="fbox-icon  how_we_do_it_circle">
                    <img src="<?= $single_repeater->image->httpUrl; ?>" alt="Image" class="w-100 how_we_do_img" style="background-color: transparent !important;">
                  </div>
                  <div class="fbox-content">
                    <h3><b><?= $single_repeater->text_1; ?></b></h3>
                    <?= $single_repeater->rich_textarea_1; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
      <!-- Id For Redirecting to modules it section -->
      <div id="modules" class=""></div>
    </div>
  </section>
<?php
}
?>
<!-- End How we Do it section by Amruta jagtap -->

<!-- Modules section by Amruta jagtap -->


<?php
if ($page->rich_textarea_12 != "") {
?>
  <section id="modules_grid" style="background:#F1F2F2;">
    <div id="foundational_modules"></div>
    <div class="container clearfix foundation_module_container" style="background:#F1F2F2;">
      <div class="text-center title-center title-border title_height" style=" padding-top: 2rem;">
        <div class="title_new" style=""><?= $page->rich_textarea_12; ?></div>
      </div>
      <div class=" title-center title-border mt-4 title_description">
        <?= $page->rich_textarea_13; ?>
      </div>
      <div class="container mt-5 foundation_module_slider foundation_module_container ">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators foundational_module_indicator">
            <?php
            $indicator_counter = 1;
            foreach ($page->foundation_repeater as $f_module_row_repeater) {
              // for($indicator_counter=1;$indicator_counter>=1;){
              if ($indicator_counter == 1) {
                $active = "active";
              } else {
                $active = "";
              }

              // echo $counter;
            ?>
              <li data-target="#carouselExampleIndicators" data-slide-to="<?= $indicator_counter ?>" class="<?= $active ?>"></li>
            <?php
              $indicator_counter++;
            }
            ?>
          </ol>
          <div class="carousel-inner">
            <?php
            $slider_counter = 1;
            foreach ($page->foundation_repeater as $f_module_row_repeater) {
              // foreach($f_module_row_repeater as $f_module_repeater){
              if ($slider_counter == 1) {
                $active = "active";
              } else {
                $active = "";
              }
              // echo $counter;
            ?>
              <div class="carousel-item <?= $active ?>">
                <ul class="testimonials-grid grid-1 grid-md-2 foundational_testimonials_grid">
                  <?php
                  $counter = 1;
                  foreach ($f_module_row_repeater->text_image_repeater_2 as $f_module_repeater) {

                  ?>
                    <li class="grid-item foundational_grid_item">
                      <div class="testimonial">
                        <div class="testi-image">
                          <img src="<?= $f_module_repeater->image->httpUrl; ?>" alt="Customer Testimonails">
                        </div>
                        <div class="testi-content">
                          <h4 class="module_grid_title"><b><?= $f_module_repeater->text_1; ?></b></h4>
                          <div class="module_grid_text">
                            <?php
                            $string = strip_tags($f_module_repeater->rich_textarea_1);
                            if (strlen($string) > 75) {

                              // truncate string
                              $stringCut = substr($string, 0, 75);
                              $endPoint = strrpos($stringCut, ' ');

                              //if the string doesn't contain any space then it will cut without word basis.
                              $foundational_text_description = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                              $last_string = strlen($string);
                              $remaining_foundational_text_description = $endPoint ? substr($string, $endPoint, $last_string) : substr($string, $endPoint);
                              // $string .= '...';
                            } else {
                              $foundational_text_description = $f_module_repeater->rich_textarea_1;
                              $remaining_foundational_text_description = "";
                            }
                            //$foundational_text_description 
                            ?>
                            <?= $foundational_text_description ?>
                            <?php
                            if ($remaining_foundational_text_description != "") {
                            ?>
                              <div id="module_read_more_text_<?= $counter ?>" class="module_read_more_text">
                                <?= $remaining_foundational_text_description ?>
                              </div>
                            <?php
                            }
                            ?>
                            <div>
                              <?php
                              if (strlen($string) > 75) {
                              ?>
                                <a id="<?= $slider_counter ?>_btn_module_read_more_<?= $counter ?>" class="module_grid_read_more " style="cursor:pointer;">read more<a>
                                  <?php
                                }
                                  ?>
                                  <a href="#" data-toggle="modal" data-target="#exampleModal<?= $counter ?>" data-lightbox="inline" style="color: #000033;background-color: #ffbd1a;" class="yellow-mini button button-mini button-rounded"><i class="icon-line-stack-2" style="position: relative; top: 1px; margin-right: 5px;"></i>Play Demo</a>


                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModal<?= $counter ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content1 modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="row modal-body justify-content-center">
                                          <div class="col-md-10">
                                            <div class="modal-body  p-lg-1" style="padding: 0.1rem;">
                                              <form action="" id="main-container<?= $counter ?>" method="POST" class="mb-1">
                                                <div class="modal-body" style="padding: 0.1rem;">
                                                  <div class="row">
                                                    <div class="col-md-6 col-sm-12 form-group">
                                                      <input type="text" name="UName" id="user_name" class="required sm-form-control" value="" placeholder="Your Name" required>
                                                    </div>

                                                    <div class="col-md-6 col-sm-12 form-group">
                                                      <input type="email" name="Email" id="email" class="required sm-form-control" value="" placeholder="Your Email" required>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <textarea class="required sm-form-control" id="user_message" name="msg" rows="5" placeholder="Your Message" cols="30" required></textarea>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-12  btn-center pt-0 mb-3" style="border-top:0px none;">
                                                    <button style="" name="btn-send" type="submit" id="register-button" tabindex="5" value="Register" class="yellow-mini button-outline button button-rounded load-next-onepages">Submit</button>

                                                  </div>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                          <!-- <div class="hide-modal-text mt-2 hover-effect col-md-12 justify-content-center">
                                          <button type="button" style="margin-left: -1px;" class="button-outline button button-rounded load-next-onepages" data-dismiss="modal">Close this Modal</button>
                                        </div> -->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- modal end -->
                                  <!-- <a  href="<?= $f_module_repeater->heading2 ?>" target="_blank" id="btn_module_read_more_external_link_<?= $slider_counter ?>_<?= $counter ?>" class="module_grid_read_more_external_link " style="cursor:pointer;"><?= $f_module_repeater->general_title ?><a> -->
                            </div>
                          </div>

                        </div>
                      </div>
                    </li>
                  <?php
                    $counter++;
                  }
                  ?>
                </ul>
              </div>
            <?php
              $slider_counter++;
              // }
            }

            ?>
            <?php
            if (count($page->foundation_repeater) > 1) {
            ?>
              <a class="carousel-control-prev foundation_carousel_prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon foundation_carousel_prev_icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next foundation_carousel_next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon foundation_carousel_next_icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            <?php
            }
            ?>


          </div>

        </div>
      </div>
    </div>
    <hr class="hr_border">
    <div class="container intermediate_module_container" style="background:#F1F2F2;">
      <div class="text-center title-center title-border title_height" style=" ">
        <div class="title_new" style=""><?= $page->rich_textarea_14; ?></div>
      </div>
      <div class=" title-center title-border mt-4 title_description">
        <?= $page->rich_textarea_15; ?>
      </div>
      <div class="container mt-5 intermediate_module_slider intermediate_module_container">
        <div id="carouselExampleIndicators_intermediate" class="carousel slide intermediate_carousel" data-ride="carousel">
          <!-- <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>  -->
          <ol class="carousel-indicators intermediate_module_indicator">
            <?php
            $indicator_counter = 1;
            foreach ($page->intermediate_repeater as $intermediate_module_row_repeater) {
              // for($indicator_counter=1;$indicator_counter>=1;){
              if ($indicator_counter == 1) {
                $active = "active";
              } else {
                $active = "";
              }

              // echo $counter;
            ?>
              <li data-target="#carouselExampleIndicators_intermediate" data-slide-to="<?= $indicator_counter ?>" class="<?= $active ?>"></li>
            <?php
              $indicator_counter++;
            }
            ?>
          </ol>


          <div class="carousel-inner">
            <?php
            $msg = "";

            if (isset($_GET['success'])) {
              $url_timestamp = $_GET['success'];

              $current_timestamp = strtotime("now");

              if ($current_timestamp < $url_timestamp) {
                $msg = "Please check your email";
              }

              echo '<div id="toast-container" class="toast-top-right"><div class="toast toast-success" aria-live="polite" style=""><div class="toast-message">' . $msg . '</div></div></div>';
            }
            ?>
            <?php
            $slider_counter = 1;
            foreach ($page->intermediate_repeater as $intermediate_module_row_repeater) {
              // foreach($f_module_row_repeater as $f_module_repeater){
              if ($slider_counter == 1) {
                $active = "active";
              } else {
                $active = "";
              }
              // echo $counter;
            ?>
              <div class="carousel-item <?= $active ?>">
                <ul class="testimonials-grid grid-1 grid-md-2 intermediate_testimonials_grid">
                  <?php
                  $counter = 1;
                  foreach ($intermediate_module_row_repeater->text_image_repeater_3 as $intermediate_module_repeater) {

                  ?>
                    <li class="grid-item intermediate_grid_item">
                      <div class="testimonial">
                        <div class="testi-image intermediate_img_div">
                          <a class="intermediate_img"><img src="<?= $intermediate_module_repeater->image->httpUrl; ?>" alt="Customer Testimonails"></a>
                        </div>
                        <div class="testi-content">
                          <h4 class="module_grid_title"><b><?= $intermediate_module_repeater->text_1; ?></b></h4>
                          <div class="module_grid_text">
                            <?php
                            $string = strip_tags($intermediate_module_repeater->rich_textarea_1);
                            if (strlen($string) > 75) {

                              // truncate string
                              $stringCut = substr($string, 0, 75);
                              $endPoint = strrpos($stringCut, ' ');

                              //if the string doesn't contain any space then it will cut without word basis.
                              $intermediate_text_description = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                              $last_string = strlen($string);
                              $remaining_text_description = $endPoint ? substr($string, $endPoint, $last_string) : substr($string, $endPoint);
                              // $string .= '...';
                            } else {
                              $intermediate_text_description = $intermediate_module_repeater->rich_textarea_1;
                              $remaining_text_description = "";
                            }
                            ?>
                            <?= $intermediate_text_description ?>
                            <?php
                            if ($remaining_text_description != "") {
                            ?>
                              <div id="intermediate_module_read_more_text_<?= $counter ?>" class="module_read_more_text">
                                <?= $remaining_text_description ?>
                              </div>
                            <?php
                            }
                            ?>
                            <div>
                              <?php
                              if (strlen($string) > 75) {
                              ?>
                                <a id="<?= $slider_counter ?>_btn_intermediate_module_read_more_<?= $counter ?>" class="intermediate_module_grid_read_more " style="cursor:pointer;">read more<a>
                                  <?php
                                }
                                  ?>
                                  <a href="#" data-toggle="modal" data-target="#IntermediateModal<?= $slider_counter ?>" data-lightbox="inline" style="color: #000033;background-color: #ffbd1a;" class="yellow-mini button button-mini button-rounded"><i class="icon-line-stack-2" style="position: relative; top: 1px; margin-right: 5px;"></i>Play Demo</a>

                                  <!-- Modal -->
                                  <div class="modal fade" id="IntermediateModal<?= $slider_counter ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content1 modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="row modal-body justify-content-center">
                                          <div class="col-md-10">
                                            <div class="modal-body  p-lg-1" style="padding: 0.1rem;">
                                              <form action="" id="main-container<?= $slider_counter ?>" method="POST" class="mb-1">
                                                <div class="modal-body" style="padding: 0.1rem;">
                                                  <div class="row">
                                                    <div class="col-md-6 col-sm-12 form-group">
                                                      <input type="text" name="UName" id="user_name" class="required sm-form-control" value="" placeholder="Your Name" required>
                                                    </div>

                                                    <div class="col-md-6 col-sm-12 form-group">
                                                      <input type="email" name="Email" id="email" class="required sm-form-control" value="" placeholder="Your Email" required>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <textarea class="required sm-form-control" id="user_message" name="msg" rows="5" placeholder="Your Message" cols="30" required></textarea>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <div class="col-md-12  btn-center pt-0 mb-3" style="border-top:0px none;">
                                                    <button style="" name="btn-send" type="submit" id="register-button" tabindex="5" value="Register" class="yellow-mini button-outline button button-rounded load-next-onepages">Submit</button>

                                                  </div>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                          <!-- <div class="hide-modal-text mt-2 hover-effect col-md-12 justify-content-center">
                                          <button type="button" style="margin-left: -1px;" class="button-outline button button-rounded load-next-onepages" data-dismiss="modal">Close this Modal</button>
                                        </div> -->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- modal end -->
                                  <!-- <a  href="<?= $intermediate_module_repeater->heading2 ?>" target="_blank" id="btn_intermediate_module_read_moreexternal_link_<?= $slider_counter ?>_<?= $counter ?>" class="intermediate_module_grid_read_more_external_link " style="cursor:pointer;"><?= $intermediate_module_repeater->general_title ?><a> -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                  <?php
                    $counter++;
                  }
                  ?>
                </ul>
              </div>
            <?php
              $slider_counter++;
              // }
            }
            ?>
            <?php
            if (count($page->intermediate_repeater) > 1) {
            ?>
              <a class="carousel-control-prev intermediate_carousel_prev" href="#carouselExampleIndicators_intermediate" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon intermediate_carousel_prev_icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next intermediate_carousel_next" href="#carouselExampleIndicators_intermediate" role="button" data-slide="next">
                <span class="carousel-control-next-icon intermediate_carousel_next_icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            <?php
            }
            ?>
          </div>

        </div>
      </div>
    </div>
    <div class="module_bottom_hr_div"></div>



    <!-- Id For Redirecting to testimonials it section -->
    <div id="testimonials" class=""></div>


  </section>





<?php
}
?>
<!-- End Modules section by Amruta jagtap -->

<!-- Testimonials section by Amruta jagtap -->
<?php
if ($page->rich_textarea_11 != "") {
?>
  <section id="" style="background:#fff;">
    <div class="container" style="background:#fff;">
      <div class="text-center title-center title-border title_height" style=" padding-top: 2rem;">
        <div class="title_new" style=""><?= $page->rich_textarea_11; ?></div>
      </div>
      <div class="container mt-5 pb-5 our_testimonials_container">
        <div id="to-participate " class="[   ][ container ] text-testimonials our_testimonials_section">
          <!-- <div class="items"> -->
          <div id="oc-testi" class="owl-carousel testimonials-carousel carousel-widget owl_testimonials" data-loop="true" data-margin="20" data-items-xl="3" data-items-md="1" data-items-sm="1">
            <?php
            $counter = 1;
            foreach ($page->testimonials_repeater  as $single_testimonials) {
              // echo  $counter++;
            ?>

              <div class="oc-item">
                <div class="testimonial feature-box fbox-center fbox-bg fbox-light fbox-effect testimonials_card">
                  <div class="testi-image fbox-icon testimonials_card_icon">
                    <img src="<?= $single_testimonials->image->httpUrl; ?>" alt="" class="img-fluid">
                  </div>
                  <div class="testi-content fbox-content text-left testimonials_text">
                    <?= $single_testimonials->rich_textarea_1; ?>
                  </div>
                </div>
              </div>


            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <!-- Id For Redirecting to clients it section -->
      <div id="clients" class=""></div>
    </div>
  </section>
<?php
}
?>
<!-- End Testimonials section by Amruta jagtap -->

<!-- Our Clients section by Amruta jagtap -->
<?php
if ($page->rich_textarea_10 != "") {
?>
  <section id="" style="background:#F1F2F2;">
    <div class="container" style="background:#F1F2F2;">
      <div class="text-center title-center title-border title_height" style=" padding-top: 2rem;">
        <div class="title_new" style=""><?= $page->rich_textarea_10; ?></div>
      </div>
      <div class="container mt-5 pb-5 our_client_testimonials">
        <div id="oc-clients-full" class="owl-carousel image-carousel carousel-widget" data-margin="30" data-loop="true" data-autoplay="1000" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="6">
          <?php
          foreach ($page->logo_images as $single_logo) {
          ?>
            <img src="<?= $single_logo->httpUrl; ?>" alt="Clients" style="cursor:pointer;">
          <?php
          }
          ?>
        </div>
      </div>
      <!-- Id For Redirecting to lets_talk it section -->
      <div id="lets_talk" class=""></div>
    </div>
  </section>
<?php
}
?>
<!-- End Our Clients section by Amruta jagtap -->

<!-- Lets Talk section by Amruta jagtap -->
<?php
if ($page->rich_textarea_16 != "") {
?>
  <section id="" style="background:#41007a;">
    <div class="container" style="background:#41007a;">
      <div class="text-center title-center title-border title_height" style=" padding-top: 2rem;">
        <div class="title_new" style=""><?= $page->rich_textarea_16; ?></div>
      </div>
      <div class="container mt-5 ">
        <!-- <div class="row justify-content-center col-mb-50 mb-0"> -->
        <form action="" class="form-info requires-validation" method="post" id="contact_form" novalidate>
          <div class="row grid-container lets_talk_container" data-layout="masonry" style="overflow: visible">
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="YOUR NAME">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="email" class="form-control" id="user_email" name="user_email" aria-describedby="emailHelp" placeholder="YOUR EMAIL">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" class="form-control" id="user_phone_number" name="user_phone_number" placeholder="YOUR PHONE" pattern="[0-9]{10}" maxlength="10">
              </div>
            </div>
            <div class="id_check_section d-none">
              <label for="id_check">ID</label>

              <input id="id_check" class="form-control" type="text" name="id_check">
            </div>
            <div class="col-md-3">
              <div class="">
                <button type="submit" class="button button-3d button-rounded  button-light" name="btn_send_request" style="background-color:#ffbd1a; margin:0px 5px;">SEND REQUEST</button>
              </div>
            </div>

          </div>
        </form>
      </div>
      <div class="lets_talk_discription title-center title-border mt-4 pb-5">
        <?= $page->rich_textarea_17; ?>
      </div>
    </div>
  </section>

<?php
}
?>
<!-- End Lets Talk section by Amruta jagtap -->
<!-- contact us form js by pooja -->

<script>
  setTimeout(function() {
    document.getElementById("toast-container").style.display = "none";
  }, 10000);
</script>

<?php include 'includes/training-footer.php'; ?>