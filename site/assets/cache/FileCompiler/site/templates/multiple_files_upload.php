<?php
// echo "1111";
			/** install pdfparser-master and composer then inlude for pdf reading */
			// Include Composer autoloader if not already done.
// include(\ProcessWire\wire('files')->compile('pdfparser-master/vendor/autoload.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
			
// 			// Parse pdf file and build necessary objects.
// 			$parser = new \Smalot\PdfParser\Parser();
// 			// $pdf    = $parser->parseFile('Complaint_And_Monitoring_Docfinal.pdf');
// 			/** get uploaded file in processwire or db is assing to $pdf */
// 			$pdf    = $parser->parseFile("../../multiple_files.zip");
// 			/** for reading text of pdf use getText() is assign to $text */
// 			echo $pdf;
// 			$text = $pdf->getText();

            //   $upload_path = $config->paths->assets ;
            // // Create new zip class 
            // $zip = new ZipArchive; 
              
            // // Add zip filename which need 
            // // to unzip 
            // $zip->open('multiple_files.zip'); 
              
            // // Extracts to current directory 
            // $zip->extractTo('./'); 
            
            //     // if ($zip) {
            //     //   while ($zip_entry = zip_read($zip)) {
            //     //     // Get name of directory entry
            //     //     echo "Name: " . zip_entry_name($zip_entry) . "<br>";
            //     //   }
            //     //   zip_close($zip);
            //     // }
                          
            // $zip->close(); 
            
            $loop_counter=0;
            $fileList = glob('27-06-22/*');
            foreach($fileList as $filename){
                if(is_file($filename)){
                   echo realpath($filename), '<br>'; 
                    echo basename($filename), '<br>';
                    $filepath=realpath($filename);
                    $ext = pathinfo($filepath, PATHINFO_EXTENSION);
                    $filename_name=basename($filename,".".$ext);

                    echo $filename_name;
                    echo "<hr>";
                            // $old_filename=str_replace("(1)(1)","",$filename_name);
                            // $old_filename=str_replace("(1)","",$old_filename);
                            // $old_filename=str_replace("(2)","",$old_filename);
                            // $old_filename=str_replace("_+919488","",$old_filename);
                            // $old_filename=str_replace("_(1)","",$old_filename);
                            // //$old_filename=str_replace("_","",$old_filename);
                            // $old_filename=str_replace("_ jayanth.se18@bmsce.ac.in","",$old_filename);
                      
                    $candidate_page=$pages->get("name=candidates")->child("email=".$filename_name);
                    //echo "1";

                    //echo $candidate_page;
                    if($candidate_page->id==0){
                        echo $filename_name;
                        
                       echo " --------------<br>";
                    }
                    elseif($candidate_page->resume){
                        /**this code used for only check how many accounts or which accounts are already exists */
                       echo "already file exists ".$filename_name;
                       //echo $filename_name;
                         $loop_counter++;
                         
                        echo " <br>";
                        //echo "<br>";
                         continue;
                    }
                    //echo $loop_counter;
                    //echo "<hr>";
                    if($candidate_page->id!=0){
                        if($candidate_page->email=="0207kamal@gmail.com"){
                            continue;
                        }
                        if($candidate_page->email=="shrikantnikam31@gmail.com"){
                            continue;
                        }
                        //echo "2";
                        echo $candidate_page;
                   echo "<br>";
                   //echo $filepath;
                            $candidate_page->of(false);
                            /**Delete code is used for you override the new resume on existing resume */
                            //echo "old ".$candidate_page->resume;
                            //   $candidate_page->resume->deleteAll();
                           
                            //unlink($candidate_page->resume);
                            //echo "after delete  ".$candidate_page->resume;
                            echo "<br>";
            				$pathname = $filepath;
            				$candidate_page->resume->add($pathname);
                            
                           // echo "filepath".$candidate_page->resume->add($pathname);
            				$candidate_page->message("Added file: $filename_name");
                            echo " email match  ";
                            echo $filename_name;
                             echo "<br>";
                            $loop_counter++;
            				//unlink($pathname);
                            /**save candidate page with resume. note- uncomment this code when you save resume */
            				//  $candidate_page->save();
                    }
                    else{
                        echo "<br>";
                        //echo $filename_name;
                        echo "<br>";
                    }
                   
                    /**save candidate page with resume. note- uncomment this code when you save resume */
                    // $candidate_page->of(false);
                    // $candidate_page->save();
                    /**when you upload files then save file using (_) underscore e.g bhadanaranveer@gmail.com to bhadanaranveer_gmail_com*/
                }   
            }
            echo $loop_counter;

            // $candidate_page=$pages->get("name=candidates")->child("oauth_gmail=anshulmalviya196@gmail.com")->id;
            // echo $candidate_page;
?>