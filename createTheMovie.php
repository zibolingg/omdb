
<?php
   
include_once 'db_credentials.php';

	$db = mysqli_connect('localhost', 'root', '','OMDB');
// Verificamos conexiones
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
    $splitWords= [];
    $movie = $_POST['english_name'];
   $native = $_POST['native_name'];
    $year = $_POST['year'];
                        
            $sql1 = "INSERT INTO movies(native_name,english_name,year_made)values('$native','$movie','$year')";
    


                    
    
	  $language = $_POST['language'];
      $country = $_POST['country'];
      $genre = $_POST['genre'];
      $plot = $_POST['plot'];
      $tag_line = $_POST['tag_line'];
   
    $sql2 = "INSERT INTO movie_data (language, country, genre, plot, tag_line) VALUES ( '$language' , '$country', '$genre', '$plot', '$tag_line' )";

                
                
    $trivia = $_POST['trivia'];
      
    $sql3 =

                

    $trivias = [];
    $_POST['trivia'];
        if (isset($_POST['trivia'])){
            $trivias =$_POST['trivia'];
            
            
            foreach ($trivias as $i => $trivia) {
                         //echo "this is i: $i and this is: $word and this is words: $words";
    //                    echo($i.'|'.$word.'|'.$engWords[$i].PHP_EOL);
                        $splitWords = $word; //Remove dot at end if exists
                        $splitWords = preg_replace('/\s+/', '', $splitWords);
                        $array = explode(';', $splitWords); //split string into array seperated by ', '
    /* Use tab and newline as tokenizing characters as well  */
                if (!empty($trivia[$i])) {
                    foreach($array as $value){
                       $sql3= "INSERT INTO movie_trivia (trivia) VALUES ( '$value' )";
                            }
                }
            }
        }
       $links = [];
       $_POST['movie_link'];
           if (isset($_POST['movie_link'])){
               $links =$_POST['movie_link'];
               
               
               foreach ($links as $i => $link) {
                           $splitWords = preg_replace('/\s+/', '', $splitWords);
                           $array = explode(';', $splitWords); //split string into
                   if (!empty($link[$i])) {
                       foreach($array as $value){
                          $sql4= "INSERT INTO m_link (m_link) VALUES ( '$value' )";
                               }
                   }
               }
           }
        $keywords = [];
        $_POST['movie_keyword'];
            if (isset($_POST['movie_keyword'])){
                $keywords =$_POST['movie_keyword'];
                
                
                foreach ($keywords as $i => $keyword) {
                            $splitWords = preg_replace('/\s+/', '', $splitWords);
                            $array = explode(';', $splitWords); //split string into
                    if (!empty($link[$i])) {
                        foreach($array as $value){
                           $sql3= "INSERT INTO m_link (movie_keyword) VALUES ( '$value' )";
                                }
                    }
                }
            }
    $quotes = [];
        $_POST['movie_quote'];
            if (isset($_POST['movie_quote'])){
                $quotes =$_POST['movie_quote'];
                
                
                foreach ($quotes as $i => $quote) {
                            $splitWords = preg_replace('/\s+/', '', $splitWords);
                            $array = explode(';', $splitWords); //split string into
                    if (!empty($quote[$i])) {
                        foreach($array as $value){
                           $sql3= "INSERT INTO m_link (movie_quote) VALUES ( '$value' )";
                                }
                    }
                }
            }
    
    
                mysqli_query($db, $sql1);
                mysqli_query($db, $sql2);
                mysqli_query($db, $sql3);
                mysqli_query($db, $sql4);
                

	header('location: movies.php?create=Success');
    mysqli_close($db);
				
?>
