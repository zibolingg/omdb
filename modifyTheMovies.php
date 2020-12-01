<?php
   
include_once 'db_credentials.php';
    $link = mysqli_connect('localhost','root','','OMDB');
    
    if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        
}
    
    if (isset($_POST['movie_id'])) {
          $movie_id =  mysqli_real_escape_string($link, $_POST['movie_id']);
          $native_update = $_POST['native_name_update'];
          $english_update = $_POST['english_name_update'];
          $year_update = $_POST['year_update'];
          
          $sql1 = "UPDATE movies Set native_name = '$native_update', english_name = '$english_update', year_made = '$year_update' Where movie_id = '$movie_id'"
        ;
        $language = $_POST['language'];
           $country = $_POST['country'];
           $genre = $_POST['genre'];
           $plot = $_POST['plot'];
           $tag_line = $_POST['tag_line'];
        
         $sql2 = "UPDATE movie_data SET language = '$language',country = '$country', genre = '$genre',plot = '$plot',tag_line = ''$tag_line WHERE movie_id = '$movie_id' "
         ;
         
                     
                     
         

         

         $trivias = [];
         $trivias =$_POST['trivia'];
         $trivia_ar = explode(PHP_EOL, $trivias);
         for ($i=0 ;$i< sizeof($trivia_ar); $i++){
                     $sql3 = "UPDATE movie_trivia SET trivia = '$trivia_ar[i]' WHERE movie_id = '$movie_id' ";
                      mysqli_query($db, $sql3);
                      }
                 
                            
                 
                     
         
            $links = [];
            $links =$_POST['movie_link'];
            $media_ar = explode(PHP_EOL, $links);
            for ($i=0 ;$i< sizeof($media_ar); $i++){
                        $sql4 = "UPDATE movie_media SET m_link = '$media_ar[i]' WHERE movie_id = '$movie_id' ";
                         mysqli_query($db, $sql4);
                 }
                               
                                 
                     
                    
                
             $keywords = [];
             $keywords = $_POST['movie_keyword'];
             $keywords_ar = explode(PHP_EOL, $keywords);
             for ($i=0 ;$i< sizeof($keywords_ar); $i++){
                  $sql5= "UPDATE movie_keywords SET keyword = '$keywords_ar[$i]' WHERE movie_id = '$movie_id' ";
                   mysqli_query($db, $sql5);
                   }
         
         
         $quotes = [];
         $quotes = $_POST['movie_quote'];
         $quotes_ar = explode(PHP_EOL, $quotes);
         for ($i=0 ;$i< sizeof($quotes_ar); $i++){
                $sql6= "UPDATE movie_quotes SET movie_quote_name = '$quotes_ar[$i] WHERE movie_id = '$movie_id' ";
                mysqli_query($db, $sql6);
         }

         $box_office = $_POST['box_office'];
         $running_time = $_POST['running_time'];
         $budget = $_POST['budget'];
                                
                    $sql7= "UPDATE movie_numbers Set box_office = '$box_office',budget = '$budget',running_time = '$running_time' WHERE movie_id = '$movie_id' ";
              
         mysqli_query($link, $sql1);
        
         mysqli_query($link, $sql2);
         
         mysqli_query($link, $sql7);
        
        
      }
    

	header('location: movies.php?updated=Success');
    mysqli_close($link);
				
?>
    
