<?php 
    $json_page = $pages->get("name=equally");
    $jsonobj=$json_page->equally_json;
    if (isset($_POST['word'])) {
        $word = $_POST['word']; 
        $word=str_replace("'","\'",$word);
        $word=str_replace('"','\\"',$word);
           if(!isset($_COOKIE['saved'])){
                
                $obj = json_decode($jsonobj);
                if (isset($obj->$word)) {
                    $obj->$word++;
                } else {
                    $obj->$word = 1;
                }   
                $jsonobj = json_encode($obj);
                $json_page->equally_json = $jsonobj;
                $json_page->of(false);
                $json_page->save();
                setcookie('saved',$word);
           }
           else{
               echo "<script>alert('You already voted!');</script>";
           }
           if (isset($_POST['pincode'])){
                $equally_page=$pages->get("name=equally");
                $mainArray=json_decode($equally_page->word_cloud_data_array);
                if($mainArray==""||$mainArray==null){
                    $mainArray=[];
                }
                var_dump($mainArray);
                array_push($mainArray, (object)[
                        'time' => time(),
                        'word' => $word,
                        'pincode' => $_POST['pincode'],
                ]);
                var_dump($mainArray);
                $new_array=json_encode($mainArray);
                $equally_page->of(false);
                $equally_page->word_cloud_data_array=$new_array;
                $equally_page->save();
           }
    }
?>