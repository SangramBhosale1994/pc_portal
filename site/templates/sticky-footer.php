  <!-- Amruta jagtap. code of menu popup -->
  <style>
      .floating_footer_btn{
          /*height:90%;*/
          /*width:90%;*/
          /*border-radius:50px;*/
          /*font-size:16px;*/
          /*padding:7px;*/
         position:fixed;
    	width:60px;
    	height:60px;
    	bottom:5%;
    	right:2%;
    	background-color:#0C9;
    	color:#FFF;
    	border-radius:50px;
    	cursor:pointer;
    	text-align:center;
    	box-shadow: 2px 2px 3px #999;
      z-index: 999;
      }
      .floating_footer_btn:hover{
         width:6rem;
    	height:60px;
    	transition: 0.3s;
      }
      .floating_btn_div{
          position:absolute;
          right:0;
      }
     /*#btn_floating:hover:after {content:"Reply!"}*/
     /* #btn_floating:hover:before {content:"Quick!"}*/
     /* #btn_floating:hover:before .floating_btn_icon {display:none}*/
     /*#btn_floating:.floating_
     btn_icon:hover {*/
     /*    display:none*/
     
    .floating_btn_b{
         display :none;
     }
    .floating_footer_btn:hover i{
         display:none;
     }
    .floating_footer_btn:hover b{
         display:block;
     }
     .floating_btn_icon{
         line-height:3rem;
     }
}

  </style>
  <script>
//       $("#btn_floating").each(function(){
//  console.log("111");
//           $(this).hover(
//             function() {
//               $(this).text("Menu");
// console.log("222");
//               $(".floating_btn_icon").css("display","none");
//  console.log("333");
//             },
//             function() {
//               $(this).text("");
//             }
        
//          );
//      });
     
     
     
    //   function changeText(text)
    //     {
    //         var display = document.getElementById('btn_floating');
    //         display.innerHTML = "";
    //         display.innerHTML = text;
    //     }
    //       function changeback(text)
    //     {
    //         var display = document.getElementById('btn_floating');
    //         display.innerHTML = "";
    //         display.innerHTML = text;
    //     }
  </script>

 <!--<button type="button" class="btn pmd-btn-fab pmd-ripple-effect btn-secondary"><i class="material-icons pmd-sm">add_shopping_cart</i></button>-->
        <div class="floating_btn_div">
			<!--<button type="button" id="btn_floating" class="floating_footer_btn" data-toggle="modal" data-target="#footer_video_popup"   ><i class="fa fa-bars floating_btn_icon"></i> -->
			
			<!--onmouseover="changeText('Quick links')"-->
			<!--</button>-->
			<!--<button><span>3 replies</span></button>-->
			
			<a class="btn floating_footer_btn" id="btn_floating" data-toggle="modal" data-target="#footer_video_popup" ><i class="fa fa-bars floating_btn_icon"></i><b class="floating_btn_b">Quick links</b></a>
		</div>
			<!--	<button type="button" id="more_filters_btn_web" class="btn-floating btn-lg btn-flat mt-4 btn btn-sm btn-outline-info" data-toggle="modal" data-target="#footer_video_popup" ><i class="fa fa-bars"></i> Menu-->
			<!--</button>-->

            <!-- Modal -->
            <div class="modal fade" id="footer_video_popup" tabindex="-1" aria-labelledby="footer_video_popupLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Quick Links</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="" class="[  ][  ]" style="border-top: 0px solid #999">
                        <?php 
                            $footer_links=$pages->get("name=footer");
                        ?>
                        <div class="[ mt-3 ][ text-center small ]">
                    		For a step-by-step video guide to upload your resume, click <a target="_blank" href="<?=$footer_links->resume_upload_youtube_link;?>" title="">here</a>.
                    	</div>
                    
                    	<div class="[ mt-3 ][ text-center small ]">
                    		To create your resume, download the template <a target="_blank" href="<?=$pages->get("name=footer")->resume_template_file->first()->httpUrl;?>"  download>here</a>.
                    	</div>
                    
                    	<div class="[ mt-3 ][ text-center small ]">
                    		For techincal queries regarding the form, please email us at <a href="mailto:<?=$footer_links->pc_contact_email;?>?Subject=Query%20Regarding%20the%20Resume%20Upload%20Portal" title="Mail Us"><?=$footer_links->pc_contact_email;?></a>
                    	</div>
                         
                        <?php if($session->user_designation==""){?>
                        
                        	<div class="container" style="width=100%">
                        		<div class="[ row ]">
                        		    <!--<div class="col-md-1"></div>-->
                        			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-3 " style="height:266px;">
                        				<!--<iframe width="100%" height="100%" src="https://www.youtube.com/embed/SMKPKGW083c" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                        				<iframe width="100%" height="100%" src="https://www.youtube.com/embed/?listType=playlist&list=PLwBLWdJLnK_GIbL3EZ-ITBpG8nh0V00rQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        				
                            			</div>
                            			<!--<div class="col-md-1"></div>-->
                            			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-3 " style="height:266px; "	>
                            				<!--<iframe width="100%" height="100%" src="https://www.youtube.com/embed/SMKPKGW083c" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                            				<iframe width="100%" height="100%" src="https://www.youtube.com/embed/?listType=playlist&list=PLwBLWdJLnK_H8hYLQTbsf36FM8GUdeIo6" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            			</div>
                            			<!--<div class="col-md-1"></div>-->
                        		
                        		</div>
                        	</div>		
                        <?php }?>
                        
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                  </div>
                </div>
              </div>
            </div>
            <!-- End code of menu popup -->