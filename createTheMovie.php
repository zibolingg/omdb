
<?php
   
include_once 'db_credentials.php';

	$db = mysqli_connect('localhost', 'root', '','OMDB');
// Verificamos conexiones
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
   $movie = $_POST['english_name'];
   $native = $_POST['native_name'];
   $year = $_POST['year'];
   
            $sql1 = "INSERT INTO movies(native_name,english_name,year_made) values('$native','$movie','$year')"
    ;
      
                    
    
	  $language = $_POST['language'];
      $country = $_POST['country'];
      $genre = $_POST['genre'];
      $plot = $_POST['plot'];
      $tag_line = $_POST['tag_line'];
   
    $sql2 = "INSERT INTO movie_data(language,country,genre,plot,tag_line) values('$language','$country','$genre','$plot','$tag_line')"
    ;
    
                
                
    

    

    $trivias = [];
    $trivias =$_POST['trivia'];
    $trivia_ar = explode(PHP_EOL, $trivias);
    $l = 0;
    for ($l=0 ;$l< sizeof($trivia_ar); $l++){
                $sql3 = "INSERT INTO movie_trivia(trivia) values('$trivia_ar[$l]')"
        ;
                 mysqli_query($db, $sql3);
                 }
            
                       
            
                
    
       $links = [];
       $links =$_POST['movie_link'];
       $media_ar = explode(PHP_EOL, $links);
       $i = 0;
       for ($i ;$i< sizeof($media_ar); $i++){
                   $sql4 = "INSERT INTO movie_media(m_link) VALUES('$media_ar[$i]')";
                    mysqli_query($db, $sql4);
            }
                          
                            
                
               
           
        $keywords = [];
        $keywords = $_POST['movie_keyword'];
        $keywords_ar = explode(PHP_EOL, $keywords);
    $j = 0;
        for ($j=0 ;$j< sizeof($keywords_ar); $j++){
             $sql5= "INSERT INTO movie_keywords(keyword) values('$keywords_ar[$j]')";
              mysqli_query($db, $sql5);
              }
    
    
    $quotes = [];
    $quotes = $_POST['movie_quote'];
    $quotes_ar = explode(PHP_EOL, $quotes);
    $h = 0;
    for ($h=0 ;$h< sizeof($quotes_ar); $h++){
           $sql6= "INSERT INTO movie_quotes(movie_quote_name) VALUES ('$quotes_ar[$h]')";
           mysqli_query($db, $sql6);
    }

    $box_office = $_POST['box_office'];
    $running_time = $_POST['running_time'];
    $budget = $_POST['budget'];
                           
               $sql7= "INSERT INTO movie_numbers(box_office,budget,running_time) values('$box_office','$budget','$running_time')"
    ;
    mysqli_query($db, $sql1);
    
    mysqli_query($db, $sql2);
    
    mysqli_query($db, $sql7);
                
    

	header('location: movies.php?create=Success');
    mysqli_close($db);
				
?>
