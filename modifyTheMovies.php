<?php
   
include 'database.php';
$db = db_connect();
    
    if (isset($_POST['movie_id'])) {
        
          $movie_id =  mysqli_real_escape_string($db, $_POST['movie_id']);
          $english_update = $_POST['english_name_update'];
          $year_update = $_POST['year_update'];
          $native_update = $_POST['native_name_update'];
       
        if (isset($_POST['english_name_update'])) {
          $sql1 = "UPDATE movies SET english_name = '$english_update', year_made = '$year_update' WHERE movie_id = '$movie_id'"
            ;
            }
        
        if (isset($_POST['native_name_update'])){
            $nativeJSON = strtolower(str_replace(" ", "", $native_update));
            $sql8 = "UPDATE movies SET native_name = '$native_update', english_name = '$english_update', year_made = '$year_update' WHERE movie_id = '$movie_id'";
            
            //Make API call to find logical chars for base_chars
            $jsonLog = "http://indic-wp.thisisjava.com/api/getLogicalChars.php?string=".$nativeJSON."&language=English";
            $jsonfile = file_get_contents($jsonLog);
            $decodedData = json_decode(strstr($jsonfile, '{'));
            $base_chars = implode(", ", $decodedData->data);
            
            //Make API call to find length of string for length
            $jsonLength = "http://indic-wp.thisisjava.com/api/getLength.php?string=".$nativeJSON."$&language=English";
            $jsonfile= file_get_contents($jsonLength);
            $decodedData = json_decode(strstr($jsonfile, '{'));
            $length = intval($decodedData->data);
            
            $sql9 = "UPDATE movie_numbers SET length = $length, base_chars = '$base_chars' WHERE movie_id = '$movie_id'";
        }
        
        $language = $_POST['language'];
           $country = $_POST['country'];
           $genre = $_POST['genre'];
           $plot = $_POST['plot'];
           $tag_line = $_POST['tag_line'];
        if (isset($_POST['language'])) {
         $sql2 = "UPDATE movie_data SET language = '$language',country = '$country', genre = '$genre',plot = '$plot',tag_line = ''$tag_line WHERE movie_id = '$movie_id' "
         ;
         }
                     
                     
         

         
        
         $trivias = [];
         $trivias =$_POST['trivia'];
         $trivia_ar = explode(PHP_EOL, $trivias);
        if (isset($_POST['trivia'])){
         for ($i=0 ;$i< sizeof($trivia_ar); $i++){
                     $sql3 = "UPDATE movie_trivia SET movie_trivia_name = '$trivia_ar[i]' WHERE movie_id = '$movie_id' ";
                      mysqli_query($db, $sql3);
                      }
         }
                            
                 
                     
         
            $links = [];
            $links =$_POST['movie_link'];
            $media_ar = explode(PHP_EOL, $links);
        if(isset($_POST['movie_link'])){
            for ($i=0 ;$i< sizeof($media_ar); $i++){
                        $sql4 = "UPDATE movie_media SET m_link = '$media_ar[i]' WHERE movie_id = '$movie_id' ";
                         mysqli_query($db, $sql4);
                 }
               }
                                 
                     
                    
                
             $keywords = [];
             $keywords = $_POST['movie_keyword'];
             $keywords_ar = explode(PHP_EOL, $keywords);
        if(isset($_POST['movie_keyword'])){
             for ($i=0 ;$i< sizeof($keywords_ar); $i++){
                  $sql5= "UPDATE movie_keywords SET keyword = '$keywords_ar[$i]' WHERE movie_id = '$movie_id' ";
                   mysqli_query($db, $sql5);
                   }
         }
         
         $quotes = [];
         $quotes = $_POST['movie_quote'];
         $quotes_ar = explode(PHP_EOL, $quotes);
        
         if(isset($_POST['movie_quote'])){
         for ($i=0 ;$i< sizeof($quotes_ar); $i++){
                $sql6= "UPDATE movie_quotes SET movie_quote_name = '$quotes_ar[$i] WHERE movie_id = '$movie_id' ";
                mysqli_query($db, $sql6);
                }
            }

         $box_office = $_POST['box_office'];
         $running_time = $_POST['running_time'];
         $budget = $_POST['budget'];
         if(isset($_POST['box_office'])){
                    $sql7= "UPDATE movie_numbers Set box_office = '$box_office',budget = '$budget',running_time = '$running_time' WHERE movie_id = '$movie_id' "
             ;
              }
         mysqli_query($db, $sql1);
         mysqli_query($db, $sql8);
         mysqli_query($db, $sql9);
        
//         mysqli_query($link, $sql2);
//
//         mysqli_query($link, $sql7);
//
        
      }
    

	header('location: movies.php?updated=Success');
    $db_disconnect($db);
				
?>
    
