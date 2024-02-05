<!-- Code by : Suraj Gharpankar -> Job page footer code -->
<?php
$rootpath=$config->urls->templates;
?>
<link rel="stylesheet" href="<?=$rootpath;?>styles/job_footer.css"/>
<?php 
      $footer_links=$pages->get("name=footer");
  ?>
<?php
if($footer_links->footer_web_banner!=""){
?>
<img src="<?=$footer_links->footer_web_banner->httpUrl;?>" class="[ img-fluid ]( mobile-hide )" alt="">
<img src="<?=$footer_links->footer_mob_banner->httpUrl;?>" class="[ img-fluid ]( mobile-show )" alt="">
<?php
}
?>


<div id="job_footer_div">
<div id="bgclass" class=" [ py-3 ][ shadow ]" style="border-top: 0px solid #999;>

  <!--	<img height="150px" src="<?=$rootpath?>images/pride_circle_logo.jpg" alt="">
  <!--</div>-->
  <div class="container">

    <div class="[ mt-3 ][ text-center small]">
      <strong><h3><?=$footer_links->footer_heading?></h3></strong>
      <h5 style="color:#0C9">✦ ✦ ✦</h5>
    </div>
    <div class="[ mt-3 ][ text-center small]" style="color:white;">
      <h4 class="pb-2"><?=$footer_links->footer_subheading?></h4>
    </div>

    <div class="row d-flex text-center justify-content-center">

      <!-- Code :  Suraj Gharpankar : 19-01-22 -->
      <!-- <div class="col-md-2"></div> -->
      <div class="col-md-6 mymailalignleft mymailaligncenter">
        <a href="mailto: <?=$footer_links->pc_contact_second_email?>?Subject=Query%20Regarding%20the%20dashboard" title="Mail Us" style="color:white; font-size: 20px"><i style="color:#0C9" class="far fa-envelope"></i> <?=$footer_links->pc_contact_second_email?></a>
      </div>
      <!-- Code Ends :  Suraj Gharpankar : 19-01-22 -->
      <!-- <div class="col-md-2"></div> -->

     
    </div>


      <div class="social_media_links">
        <ul class="social-links">
            <li><a href="<?=$footer_links->linkedin_url?>" style="-webkit-transition:0s;
                  transition:0s;" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
            <li><a href="<?=$footer_links->facebook_link?>" style="-webkit-transition:0s;
                  transition:0s;" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="<?=$footer_links->instagram_link?>" style="-webkit-transition:0s;
                  transition:0s;" target="_blank"><i class="fab fa-instagram"></i></a></li>
            <li><a href="<?=$footer_links->twitter_link?>" style="-webkit-transition:0s;
                  transition:0s;" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="<?=$footer_links->youtube_link?>" style="-webkit-transition:0s;
                  transition:0s;" target="_blank"><i class="fab fa-youtube"></i></a></li>
        </ul>
      </div>
    </div>
</div>
</div>


              <!--<div class="[ mt-3 ][ text-center small ]">-->
              <!--	To create your resume, download the template <a target="_blank" href="<?=$rootpath?>files/resume_template.docx" title="" download>here</a>.-->
              <!--</div>-->

              <!--<div class="[ mt-3 ][ text-center small ]">-->
              <!--	For techincal queries regarding the registration, please email us at <a href="mailto:contact@thepridecircle.com?Subject=Query%20Regarding%20the%20Resume%20Upload%20Portal" title="Mail Us">contact@thepridecircle.com</a>-->
              <!--</div>-->

              <!--<div class="[ mt-3 ][ text-center small ]">-->
              <!--	Developed By  <a href="mailto:todkar.amrut27897@gmail.com" target="_blank">ProAutomater</a>-->
              <!--</div>-->
</div>
</div>
<!-- Code Ends -> Code by : Suraj Gharpankar -> Job page footer code -->
<!-- COde by Amruta -->
<!-- Linkedin code -->
<script type="text/javascript"> _linkedin_partner_id = "3744588"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(l) { if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])}; window.lintrk.q=[]} var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(window.lintrk); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3744588&fmt=gif" /> </noscript>
	<!-- End Linkedin code -->