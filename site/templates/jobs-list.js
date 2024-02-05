console.log((new Date()).toUTCString());
console.log((new Date()).toUTCString());


$(document).ready(function() {
    var homepath="https://zerovaega.in/pc_portal/resume/";
    var total_cards; 
    var start;
    let search_form_details;    
    search_form_details="";
    let quick_search_details;
    quick_search_details="";
    let login_fresher_filter;
    login_fresher_filter="";
    var total_record;
    var pageCount;
    let value_start_and_pagination;
    let val_pagination;
    var page_number;
    var arr_result_data;

    
/**Code by Amruta Jagtap : 2022-03-04 */
/**Job data fetching api  */
    function fetch_jobs_data(start,search_form_details,quick_search_details){
        $("#job_container_row").html("");
        $("#job_container_row").html("Loading...");	
        $("#job_container_row").html("");	
        var search_data;	
        var length;
        var quick_search_data;
        var login_fresher_filter_data;
        length=24;
       // console.log(start);
        if(start!=""){
            start=start;
        }
        else{
            start=0;
        }
        if(search_form_details!=""){
            search_data =search_form_details;
        }
        if(quick_search_details!=""){
            quick_search_data = quick_search_details;
        }
        
        $.ajax({
            url : homepath+'api/jobs-data/',

            method : "POST",
// dataType : 'text',

            data : {
                // "requested_action_to_take" : "fetch_job_table_data",
                "length" : length,
                "start" : start,
                "search_data" : search_data,
                "quick_search_data" : quick_search_data
        
            },
        
            success : function(result){
    console.log(result)
    
            //   // console.log(result.success.success_message);
               
                    
                if(result.number_of_errors > 0){
                    console.log("No data");
                    $("#job_container_row").append('<div class="alert alert-danger " role="alert"><strong>'+result.error_message+'</strong></div>');
                }
                else{
                    arr_result=JSON.parse(result);
                    total_cards=arr_result['recordsTotal'];
                    total_record=arr_result['recordsTotal'];
                    console.log(total_cards);
                    if(total_cards==0){
                        console.log("No data");
                    }
                   // console.log(arr_result['data']);
                   // console.log("data prsent");
                //    console.log(arr_result['data']);
                //    arr_result_data=arr_result['data'];
                //    console.log("length"+arr_result['data'].length);
                // //    if(arr_result['data'].length>0){
                // //        console.log("data is not display");
                // //    }
                    arr_result['data'].forEach(add_card);
                //     if(arr_result['data'].length==0){
                //         // console.log("error");
                //     }

                    //// console.log(total_record);
                    pagination(total_cards);
                    pageCount=total_cards;
                    
               }
             
            //  pagination();
            //  pagination(total_cards);
            // add_card()
                // if(result.error.number_of_errors > 0){
                //     $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>'+result.error.error_message+'</strong></div>');
                // }
                // else{
                //     //refresh_datatable(result)
                //     datatable_columns=result.columns;
                //     //datatable_data=result.data;
                //    // console.log(datatable_columns);
                //     refresh_datatable();
                // }
            },
            error : function(){
                $("#job_container_row").append('<div><strong>No result Found</strong></div>');
            }
        });
    }
    
    fetch_jobs_data('0',search_form_details,quick_search_details);
    // total_cards=165;
   // console.log("total rescord count");
    
    

    function add_card(arr_result){
       // console.log(arr_result);
       // console.log("************");
        var card=` <div class="( job-card-container )[ my-3 ][ ${arr_result.counter} ][ col-md-6  col-lg-4 col-xl-3 ]" style="<?=$is_visible?>">
                        <!-- Suraj Gharpankar Starts :  To add link to all section in Card-->
                        <a href="${arr_result.url}" target="_blank" style="text-decoration:none">
                        <!-- Suraj Gharpankar Ends :  To add link to all section in Card-->

                        <div class="[ card ]">`;
                        if(arr_result['new'] !=""){
                            card+=`<span class="[ px-3 ][ badge badge-danger ]" style="position: absolute; right:41%; top:-0.6rem;  font-size: 0.9rem; font-weight: 600; padding-bottom: 0.3rem">${arr_result.new}</span>`;
                        }
                                // `<span class="[ px-3 ][ badge badge-danger ]" style="position: absolute; right:41%; top:-0.6rem;  font-size: 0.9rem; font-weight: 600; padding-bottom: 0.3rem">${arr_result.new}</span>
                    
                                card+=`<!-- Code by : Suraj Gharpankar -> Job Page Card code  17-01-22-->


                            <div class="card-body textcolor job_card_body">
                                <!--
                                    Sameesh yadav for 6-march-2021
                                    to add image in card of jobs     
                                -->
                                </a>
                                <div class="container pt-1 m-0">
                                                
                                    <div class="row "> <!-- style="display: flex;justify-content: space-between;" -->
                                        <div class="col-4 col-md-4 my320px"  style="padding-left: 0px;">     
                                            <p class="card-text"><span class="badge badge-info"><i class="[  mr-1 ] fas fa-fw fa-qrcode"></i> ${arr_result.job_code}</span></p> 
                                        </div>      
                                    
                                        <!-- Code Starts:  Suraj Gharpankar : Tooltip and Message changes : 21-01-22 -->   
                                        <div class="col-8 col-md-8"> <!-- text-center -->
                                            <div class="share-button iphonese allphones text-right">
                                                <span><i class="fas fa-share-alt mr-3"></i></span>
                                                    <a target="_blank" href="mailto:?subject=Pride Circle Job Portal&message=message?&body=Have%20a%20look%20at%20this%20job%20opening%20on%20the%20Pride%20Circle%20Job%20Portal - ${arr_result.url}"  title="Share on Mail" data-toggle="tooltip" data-placement="top"><i class="fas fa-envelope-open-text"></i></a>
                                                    <a target="_blank" href="https://api.whatsapp.com/send?text=Have%20a%20look%20at%20this%20job%20opening%20on%20the%20Pride%20Circle%20Job%20Portal- ${arr_result.url}" title="Share on WhatsApp" data-toggle="tooltip" data-placement="top"><i class="fab fa-whatsapp" style="color: #075E54;"></i></i></a>
                                                    <a target="_blank" href="https://twitter.com/intent/tweet?url=${arr_result.url}&text=Have%20a%20look%20at%20this%20job%20opening%20on%20the%20Pride%20Circle%20Job%20Portal- " title="Share on Twitter" data-toggle="tooltip" data-placement="top"><i class="fab fa-twitter" style="color: #1DA1F2;"></i></a>
                                                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=${arr_result.url}" value="" title="Share on Facebook" data-toggle="tooltip" data-placement="top"><i class="fab fa-facebook-f" style="color: #4267B2;"></i></a>
                                                    <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=${arr_result.url}&title=Have%20a%20look%20at%20this%20job%20opening%20on%20the%20Pride%20Circle%20Job%20Portal-" value="" title="Share on Linkedin" data-toggle="tooltip" data-placement="top"><i class="fab fa-linkedin-in" style="color: #0e76a8;"></i></a>
                                                    <!-- Code Starts:  Suraj Gharpankar : COPY BUTTON : 21-01-22 -->   
                                                    <a id="share_button_${arr_result.id}" value="" title="Copy Link" data-toggle="tooltip" data-placement="top" ><i class="far fa-copy copy_link" title="${arr_result.url}" style="color: black;"></i> </a>
                                                    <!-- Code Ends :  Suraj Gharpankar : COPY BUTTON : 21-01-22 -->  
                                            </div>
                                        </div>
                                        <!-- Code Ends:  Suraj Gharpankar : Tooltip and Message changes : 21-01-22 -->   

                                    </div>
                                    <a href="${arr_result.url}" target="_blank" style="text-decoration:none">
                                    <div class="row align-items-center" style="   height:98px;overflow: hidden ">

                                        <?php
                                            /**
                                             * firt check if image in job page if null then add default vaue
                                             * $image to store image url
                                             */
                                        
                                        ?>
                                        <img src="${arr_result.image}" class="mx-auto" alt="Image" style="max-height: 78px; width:auto">
                                    </div>
                                </div>
                                <!--
                                    code ends here
                                -->
                                <h5 class="[ card-title] text_color" style="white-space: wrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em; height:2.6em;">${arr_result.title}</h5>

                                <!-- Code Start : Suraj Gharpankar : Changed "mb-3" to "mb-2" : Remove spaceing between Posted at and years of experience : 24-01-22 -->
                                <h6 class="[ mb-2 ][ card-subtitle text-muted ]" style="white-space: nowrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em"> At ${arr_result.company_name}
                                <!-- Code Start : Suraj Gharpankar : Changed "mb-3" to "mb-2" : Remove spaceing between Posted at and years of experience : 24-01-22 -->
                                <br>
                                Posted on ${arr_result.posted_date} </h6>

                                <!-- <div class="col-md-4">
                                    <div id="share-button-${arr_result.id}"
                                        style=":center" class="[ card-link ][ text-info btn btn-outline-light ]"
                                        data-share-position="topCenter"
                                        data-share-share-button-class="custom-button"
                                        data-share-networks="Mailto,Twitter,Facebook,Linkedin,WhatsApp">
                                        <span class="custom-button">
                                            <i class="fas fa-share-alt"></i>
                                        </span>
                                        </div>
                                </div> -->              

                                <!--/* Existing system user experience save to experience field but in new system minimum experience save in min_experience field and maximum experience save in max_experience field .
                                so existing system experience saving min and max experience field */-->


                                <p class="card-text text_color" style="margin-bottom: 8px;"><i class="[  mr-1 ][ text-info ] fas fa-fw fa-user-clock"></i>${arr_result.experience}<br>

                                </p>
                                    <p class="text_color"style="margin-bottom: 8px"><i class="[ mr-1 ][ text-info ] fas fa-fw fa-map-marker-alt "></i>${arr_result.job_location}<br>
                                </p>
                            
                                <!-- Start - Suraj Gharpankar : 22-01-22 : Know More button alignment -->
                                <div class="row" style="display: flex;justify-content: space-between;">

                                    <div class="col-7 col-md-7 text_color" style="max-width:100%">    
                                            <i class="[ mr-1 ][ text-info ] fas fa-fw fa-eye"></i>
                                            ${arr_result.views} Views Today</p>
                                    </div>
                                

                                    <div class="col-5 col-md-5 justify-content-center" style="padding-left: 0px;">
                                        <div class="[ d-flex]" style="text-align:right" >
                                        <!-- Suraj  Suraj Gharpankar : Know More button change : 25-01-22 -->
                                                <a href="${arr_result.url}" target="_blank" style="width:7rem" class="[ card-link ][  btn btn-outline-primary ] job_know_more_btn">Know More</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Ends - Suraj Gharpankar : 22-01-22 : Know More button alignment -->


                                <!-- Code Ended by : Suraj Gharpankar -> Job Page Card code -->



                            </div>
                            <!-- Suraj Gharpankar Starts :  To add link to all section in Card -> </a> tag closed -->
                            </a>                     
                            <!-- Suraj Gharpankar Starts :  To add link to all section in Card-->
                        </div>
                    </div>`;
        	
        $("#job_container_row").append(card);
        
        

    
        
    }
    function pagination(total_cards){  
        let filteredJobPagesAfterSearch=$(".job-card-container");
   // console.log(filteredJobPagesAfterSearch);
        var pageSize =24;
        //  var pageSize =8;
         var pageSize=total_cards;
        // var pageSize=total_cards;
        var pageCount =   $(".job-card-container").length/ pageSize;
        var pageCount = total_cards;
        page_number=Math.ceil(total_cards/24);
        console.log("Page number "+page_number);
        // console.log(total_cards);
        pageCount=Math.ceil(pageCount);
       // console.log($(".job-card-container").length);
       // console.log(pageCount);
        let showPage = function(page) {
            filteredJobPagesAfterSearch.hide();
            if(page<=pageCount){
                filteredJobPagesAfterSearch.each(function(n) {
                    
                    // if (n >= pageSize * (page - 1) && n < pageSize * page)
                    //     {
                    //         $(this).show();
                    //        // console.log(n+" testing value");
                    //     }
                });
            }
        }

        // $("#job-list-div").innerHtml('--------');

    function pagination_refresh(filteredJobPages){
       // console.log('in refresh')
       // console.log((new Date()).toUTCString());
        //console.log(filteredJobPages);
        //console.log(filteredJobPages.length);
    // 	var pageCount =  filteredJobPages.length / pageSize;
    // 	pageCount=Math.ceil(pageCount);
        //console.log(pageCount);
        $("#paginTop").html("");
        $("#paginBottom").html("");
       // console.log("page count"+pageCount);
        if(parseInt(pageCount)>1){

           

           
                
            $("#paginTop").append('<li class="page-item"><a class="page-link prev" href="#job-list-div" id="pagin_top_prev"><i class="fas fa-backward mr-2"></i>Prev</a></li>');
            $("#paginBottom").append('<li class="page-item"><a class="page-link prev" href="#job-list-div" id="pagin_bottom_prev"><i class="fas fa-backward mr-2"></i>Prev</a></li>');
            // for(var i = 0 ; i<pageCount;i++){
            
            //     $("#paginTop").append('<li class="page-item"><a class="page-link" href="#job-list-div">'+(i+1)+'</a></li>');
            //     $("#paginBottom").append('<li class="page-item"><a class="page-link" href="#job-list-div">'+(i+1)+'</a></li>');
                
            // }
           // console.log("val "+value_start_and_pagination);
       
                if(val_pagination>1){
                    $("#paginTop").append('<li class="page-item"><a class="page-link" href="#job-list-div">'+val_pagination+'</a></li>');
                    $("#paginBottom").append('<li class="page-item"><a class="page-link" href="#job-list-div">'+val_pagination+'</a></li>');
        
                }
                else{
                    $("#paginTop").append('<li class="page-item" id="pagination_number"><a class="page-link" href="#job-list-div">1</a></li>');
                    $("#paginBottom").append('<li class="page-item" id="pagination_number"><a class="page-link" href="#job-list-div">1</a></li>');

                }
            
            
                $("#paginTop").append('<li class="page-item"><a class="page-link next" href="#job-list-div" id="pagin_top_next">next<i class="fas fa-forward ml-2"></i></a></li>');
                $("#paginBottom").append('<li class="page-item"><a class="page-link next" href="#job-list-div" id="pagin_bottom_next">next<i class="fas fa-forward ml-2"></i></a></li>');
                var pagination_number=$('#pagination_number').val();
                console.log(pagination_number);
                if(pagination_number==0){
                    value_start_and_pagination=0;
                }
            console.log("val"+value_start_and_pagination);
            if((value_start_and_pagination)>=(page_number-1)){
                console.log("1st next disable");
                    $("#pagin_top_next").addClass("btn disabled");
                    $("#pagin_bottom_next").addClass("btn disabled");
                    change_disable=true;
                    
            }
            else if((value_start_and_pagination+1)<=1){
                $("#pagin_top_prev").addClass("btn disabled");
                $("#pagin_bottom_prev").addClass("btn disabled");
                change_disable=true;
            }
            else{
                $("#paginTop li:nth-child(2)").find("a").addClass("current");
                $("#paginBottom li:nth-child(2)").find("a").addClass("current");
            }
            
        
        }
    
        
        //   showPage(1);
   // console.log((new Date()).toUTCString());
    }

    pagination_refresh($("#job-card-container"));


       // console.log("in ready");
       // console.log((new Date()).toUTCString());
        
       // console.log((new Date()).toUTCString());
    
   // console.log((new Date()).toUTCString());

   
      
    }
    /**/
    // if(value_start_and_pagination>page_number){
    //     // $("#paginTop li a").disable();
    //    // console.log("pagin top disable");
    //     $("#paginTop li a").prop('disabled', true);
    // }
    // else{

        $(document).on('click',"#paginTop li a",function(){
            //console.log("paginTop called multiple times");
            
            value_start_and_pagination=parseInt($("#paginTop li:nth-child(2)").find("a").text());
        //    console.log(value_start_and_pagination);
           console.log("click on pagin top");
            var change_disable=false;
           console.log((value_start_and_pagination)+">"+(page_number-1));
            if((value_start_and_pagination)>=(page_number-1)){
                   console.log("pagin next disable");
                    // $("#pagin_top_next").prop('disabled', true);
                    // $('#pagin_top_next').attr('disabled','disabled');
                    $("#pagin_top_next").addClass("btn disabled");
                   // console.log(value_start_and_pagination);
                    change_disable=true;
            }
            else if(value_start_and_pagination<=1){
               // console.log("pagin prev disable");
                // $("#pagin_top_prev").prop('disabled', true);
                // $('#pagin_top_prev').attr('disabled','disabled');
                $("#pagin_top_prev").addClass("btn disabled");
                //// console.log(value_start_and_pagination);
                change_disable=true;
            }
            
               // console.log("pagintop"+value_start_and_pagination);
                if($(this).hasClass("prev")){
                //// console.log(value_start_and_pagination);
                    if(value_start_and_pagination!=1){
                       // console.log(value_start_and_pagination);
                        $("ul#paginTop li").find("a.current").removeClass("current");
                        $("#paginTop li:nth-child(2)").find("a").html(value_start_and_pagination-1);
                        val_pagination=value_start_and_pagination-1;
                        $("#paginTop li:nth-child(2)").find("a").addClass("current");
                        
                        // showPage(parseInt(value_start_and_pagination-1));
                    
                        start=(value_start_and_pagination-2)*24;
                       // console.log(start);
                        let search_form_details = $("#search-container").serializeArray();
                        let quick_search_details = $("#jobs_searchword").val();
                        // fetch_jobs_data(start,search_form_details,quick_search_details);
                        
                        fetch_jobs_data(start,search_form_details,quick_search_details);
                        // showPage(parseInt(value_start_and_pagination-1));
                        
                    }
                }
                else if($(this).hasClass("next")){
                    //console.log(value_start_and_pagination);
                    if(value_start_and_pagination<pageCount&&pageCount!=1){
                    //// console.log(pageCount);
                        $("ul#paginTop li").find("a.current").removeClass("current");
                        $("#paginTop li:nth-child(2)").find("a").html(value_start_and_pagination+1);
                        val_pagination=value_start_and_pagination+1;
                        $("#paginTop li:nth-child(2)").find("a").addClass("current");
                    
                        // showPage(parseInt(value_start_and_pagination+1));
                        // fetch_jobs_data();
                        start=(value_start_and_pagination)*24;
                       // console.log(start);
                        let search_form_details = $("#search-container").serializeArray();
                        let quick_search_details = $("#jobs_searchword").val();
                        
                        fetch_jobs_data(start,search_form_details,quick_search_details);
                        // showPage(parseInt(value_start_and_pagination+1));
                    }
                }
           
    
            
                $("#paginBottom").html($("#paginTop").html());
        });
    // }
    // else{
    //     $("#paginTop li a").disable();
    // }
    
    $(document).on('click',"#paginBottom li a",function(){
        value_start_and_pagination=parseInt($("#paginTop li:nth-child(2)").find("a").text());
        var change_disable=false;
        if((value_start_and_pagination)>=(page_number-1)){
            console.log("pagin next disable");
             // $("#pagin_top_next").prop('disabled', true);
             // $('#pagin_top_next').attr('disabled','disabled');
             $("#pagin_bottom_next").addClass("btn disabled");
            // console.log(value_start_and_pagination);
             change_disable=true;
        }
        else if(value_start_and_pagination<=1){
            // console.log("pagin prev disable");
            // $("#pagin_top_prev").prop('disabled', true);
            // $('#pagin_top_prev').attr('disabled','disabled');
            $("#pagin_bottom_prev").addClass("btn disabled");
            //// console.log(value_start_and_pagination);
            change_disable=true;
        }
        // else{
        if($(this).hasClass("prev")){
            //let value_start_and_pagination=parseInt($("#paginBottom li:nth-child(2)").find("a").text());
            if(value_start_and_pagination!=1){
                $("ul#paginBottom li").find("a.current").removeClass("current");
                $("#paginBottom li:nth-child(2)").find("a").html(value_start_and_pagination-1);
                val_pagination=value_start_and_pagination-1;
                $("#paginBottom li:nth-child(2)").find("a").addClass("current");
                
                // showPage(parseInt(value_start_and_pagination-1));
                start=(value_start_and_pagination-2)*24;
                // console.log(start);
                let search_form_details = $("#search-container").serializeArray();
                let quick_search_details = $("#jobs_searchword").val();
                
                
                fetch_jobs_data(start,search_form_details,quick_search_details);
            }
        }
        else if($(this).hasClass("next")){
            //let value_start_and_pagination=parseInt($("#paginBottom li").find("a.current").text());
            //console.log("page count"+pageCount+"value_start_and_pagination"+value_start_and_pagination);
            if(value_start_and_pagination<pageCount&&pageCount!=1){
                //console.log(value_start_and_pagination);
                $("ul#paginBottom li").find("a.current").removeClass("current");
                $("#paginBottom li:nth-child(2)").find("a").html(value_start_and_pagination+1);
                val_pagination=value_start_and_pagination+1;
                $("#paginBottom li:nth-child(2)").find("a").addClass("current");
                // showPage(parseInt(value_start_and_pagination+1));
                start=(value_start_and_pagination)*24;
                // console.log(start);
                let search_form_details = $("#search-container").serializeArray();
                let quick_search_details = $("#jobs_searchword").val();
                
                fetch_jobs_data(start,search_form_details,quick_search_details);
            }
        }
        // }
            $("#paginTop").html($("#paginBottom").html());
    });

   
   

   //Sameesh Script ends here    
    
   /**Quick search */
   $("#btn_quick_search").on('click', function (e) { 
        // event.preventDefault();
        event.stopPropagation();
        /* Serialize the input data to send */
        let quick_search_details = $("#jobs_searchword").val();
                
       // console.log(quick_search_details)
       // console.log("***************");
        let search_form_details = $("#search-container").serializeArray();
        
        fetch_jobs_data('0',search_form_details,quick_search_details);
        val_pagination=1;
       // console.log(quick_search_details)
    })
    /* End Quick search */

    /**Login Fresher button filter */
    $("#btn_login_fresher").on('click', function (e) { 
        // event.preventDefault();
        // event.stopPropagation();
        $('#login_popup_modal').modal('hide');
        /* Serialize the input data to send */
        let login_fresher_filter = "login_fresher_filter";
        // var x = document.getElementById("more_filters_btn");
        // $('#experience_years').innerHTML="2";
        $('#experience_years option[value="0"]').attr("selected",true);
        var expe=$('#experience_years').val();

        // var url_string = window.location.href;
        // console.log(url_string);
        // var url_parameters="";
        // if(url_string.indexOf("?")!=-1){
        //   url_parameters = url_string.substr(url_string.indexOf("?") + 1);
        // }
        
        // console.log(url_parameters);
    //   if (x.innerHTML === "More Filters") {
                
        console.log(expe);
       // console.log("***************");
        let search_form_details = $("#search-container").serializeArray();
        let quick_search_details = $("#jobs_searchword").val();
        fetch_jobs_data('0',search_form_details,quick_search_details);
        
       // console.log(quick_search_details)
    })
    /**End Login Fresher button filter */

//     $(document).on("keyup", "#jobs_searchword", function(){
//         /* Get search value from the search input */
//         let searchword = $(this).val();
//// console.log(searchword)
//         /* Hide all cards */
//         $('.job-card-container').hide();

//         /* Show cards containing the keyword */
//         $('.job-card-container:contains("'+searchword+'")').show();
        
        
//         filteredJobPagesAfterSearch=$('.job-card-container:contains("'+searchword+'")');
//         pageCount =  filteredJobPagesAfterSearch.length / pageSize;
//         pageCount=Math.ceil(pageCount);
//         pagination_refresh(filteredJobPagesAfterSearch);
        
//     });
    /* Searching the job cards END */

    /* Code to make searching case insensitive */
    $.expr[":"].contains = $.expr.createPseudo(function(arg) {
        return function( elem ) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    /* Code to make searching case insensitive END */
    });

    //$("#tagator_company_name ul li").html($("#tagator_company_name ul li").html().replace('""',''));
    $("#tagator_company_name ul li").each(function(){
        //$(this).html();
    // text= preg_replace("''", "'", $(this).html());
    // text1=$(this).html().replace('"',"'");
        
        //(this).html(text1);
        // $(this).html().replace('"',"'");
        // //$("#tagator_company_name ul li").html().replace('"',"'");
        //   var htmlString = $( this ).html().replace('"',"'");
        //  var htmlString1= $( this ).html( htmlString );
        
        //  $(this).html(function(){
        //      $(this).html().replace('"',"'");
        //  })
        
        // text2= $(this).html().replace('"',"'");
        // $(this).eq(0).html().replace('"',"'");
        //console.log(text2);
        text2= $(this).html().replace('"',"'");
        //console.log($(this).html(text2));
        
        // var abc="abcd";
        
        // text3=$(this).html(abc);
        $(this).html("abc");
        $(this).hide();
        //console.log(text3);
        
    })

	/**when search form load */
    $("#btn_search_submit").on('click', function (e) { 
        //$("#search-modal").show();
        /* Prevent submitting automatically*/
        // event.preventDefault();
        event.stopPropagation();
        // $("#Advance_search").hide();
        console.log("------");
        // $("body, html").animate({ 
        //     scrollBottom: $( $("#job_card_section")).offset()
        //   }, 600);
          console.log("------");
        //   console.log($(this).attr('href'));
       // console.log("form submit");
        /* Serialize the form data to send */
        // let search_form_details = JSON.stringify($("#search-container").serializeArray());
        let search_form_details = $("#search-container").serializeArray();
        /* Save the data to send to the AJAX page into a variable */
        //let form_data_to_send = new FormData($('#search_container_form')[0]);
        /* Add the information confirming that this info came from the AJAX call. This will help in case JS does not work in the browser and the form is sent by HTML default. */
        //form_data_to_send.append('ajax', 'true');
 
        // $("#search_modal_submit").prop('disabled', true);
        //         $(this).html('Searching...');
                
       // console.log(search_form_details)
       // console.log("***************");
        let quick_search_details = $("#jobs_searchword").val();
        
        fetch_jobs_data('0',search_form_details,quick_search_details);
        val_pagination=1;
        // // if(parseInt(pageCount)>1){
        //     $("#paginTop").append('<li class="page-item"><a class="page-link prev" href="#job-list-div" id="pagin_top_prev"><i class="fas fa-backward mr-2"></i>Prev</a></li>');
        //     $("#paginBottom").append('<li class="page-item"><a class="page-link prev" href="#job-list-div" id="pagin_bottom_prev"><i class="fas fa-backward mr-2"></i>Prev</a></li>');
            
        //     $("#paginTop").append('<li class="page-item" id="pagination_number"><a class="page-link" href="#job-list-div">1</a></li>');
        //     $("#paginBottom").append('<li class="page-item" id="pagination_number"><a class="page-link" href="#job-list-div">1</a></li>');

        
        //     $("#paginTop").append('<li class="page-item"><a class="page-link next" href="#job-list-div" id="pagin_top_next">next<i class="fas fa-forward ml-2"></i></a></li>');
        //     $("#paginBottom").append('<li class="page-item"><a class="page-link next" href="#job-list-div" id="pagin_bottom_next">next<i class="fas fa-forward ml-2"></i></a></li>');
          
        // }
        // // $("#search-modal").modal('hide');
        // // $("#search_modal_submit").prop('disabled', false);
        // //  $("#search_modal_submit").html('Search');
       // console.log(search_form_details)
    })

});


    // function myFunction() {
    //   var x = document.getElementById("more_filters_btn");
    //   if (x.innerHTML === "More Filters") {
    //     x.innerHTML = "Hide Filters";
    //   } else {
    //     x.innerHTML = "More Filters";
    //   }
    // }
    
    // function myFunction_demo() {
    //   var x = document.getElementById("more_filters_btn_web");
    //   if (x.innerHTML === "More Filters") {
    //     x.innerHTML = "Hide Filters";
    //   } else {
    //     x.innerHTML = "More Filters";
    //   }
    // }

//Code Start : Suraj Gharpankar -> Advance Search Filter  17-01-22

function myFunction() {
    var x = document.getElementById("more_filters_btn");
    if (x.innerHTML === "Advance Search") {
      x.innerHTML = "Hide Advance Search";
    } else {
      x.innerHTML = "Advance Search";
    }
  }
  
  function myFunction_demo() {
    var x = document.getElementById("more_filters_btn_web");
    if (x.innerHTML === "Advance Search") {
      x.innerHTML = "Hide Advance Search";
    } else {
      x.innerHTML = "Advance Search";
    }
  }
//Code End : Suraj Gharpankar -> Advance Search Filter  17-01-22

