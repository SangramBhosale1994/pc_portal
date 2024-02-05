<?php
    read_resume();
    function read_resume(){
      /** install pdfparser-master and composer then inlude for pdf reading */
 include_once(\ProcessWire\wire('files')->compile(\ProcessWire\wire('config')->paths->templates.'pdfparser-master/vendor/autoload.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
         echo "Following resumes are read:-<br>";
         /** get current date timestamp */
        $current_date=strtotime(date("Y-m-d"));
        /** minus 24 hours in current date timestamp because check candidate resume upload or add timestamp is greater than current date */
        $current_timestamp=$current_date - 24*60*60;
      foreach(\ProcessWire\wire('pages')->get("name=candidates")->children("created|modified>".$current_timestamp) as $candidate_page){
        
        $candidate_resume=$candidate_page->resume;
				try{
					if($candidate_page->resume->ext =='pdf' ){
          
						// Parse pdf file and build necessary objects.
						$parser = new \Smalot\PdfParser\Parser();
						if(filesize($candidate_page->resume->filename)!=0){
							/** get uploaded file in processwire or db is assing to $pdf */
							try{
								$pdf    = $parser->parseFile($candidate_page->resume->httpUrl);
							
								/** for reading text of pdf use getText() is assign to $text */
								$resume_text = $pdf->getText();
								/** All extracting text is set to new page means candidate page resume_content field */
								
									$candidate_page->resume_contents=$resume_text;
									$candidate_page->of(false);
									$candidate_page->save();
									 echo "$candidate_page->oauth_gmail - Done.<br>";
							}
							catch(Throwable $e){
								// echo "Error1";
							}
						}
						else{
							// echo "$candidate_page->oauth_gmail - Content not present in file.<br>";
						}
						
					}
					else{
						//  echo "$candidate_page->oauth_gmail - Uploaded resume is not a pdf file.<br>";
					}

				}
				catch(Throwable $e){
					// echo "Error1";
				}
      }
    }
?>