<?php
   
include("./nav.php");
    
//
//
//        $movie_id =  mysqli_real_escape_string($db, $_POST['movie_id']);
//        $language = $_POST['language'];
//        $country = $_POST['country'];
//        $genre = $_POST['genre'];
//        $plot = $_POST['plot'];
//        $tag_line = $_POST['tag_line'];
//
//      $sql1 = "INSERT INTO movie_data(movie_id,language,country,genre,plot,tag_line) values('$movie_id','$language','$country','$genre','$plot','$tag_line')"
//      ;
//    mysqli_query($db, $sql1);
//        $trivias = [];
//        $trivias =$_POST['trivia'];
//        $trivia_ar = explode(PHP_EOL, $trivias);
//        $l = 0;
//        for ($l=0 ;$l< sizeof($trivia_ar); $l++){
//                    $sql2 = "INSERT INTO movie_trivia(movie_id,movie_trivia_name) values('$movie_id','$trivia_ar[$l]')"
//            ;
//                     mysqli_query($db, $sql2);
//                     }
//
//
//        $links = [];
//        $links =$_POST['movie_link'];
//        $media_ar = explode(PHP_EOL, $db);
//        $i = 0;
//        for ($i ;$i< sizeof($media_ar); $i++){
//                    $sql3 = "INSERT INTO movie_media(movie_id,m_link) VALUES('$movie_id','$media_ar[$i]')"
//            ;
//                     mysqli_query($db, $sql3);
//             }
//
//
//
//
//
//        $keywords = [];
//        $keywords = $_POST['movie_keyword'];
//        $keywords_ar = explode(PHP_EOL, $keywords);
//    $j = 0;
//        for ($j=0 ;$j< sizeof($keywords_ar); $j++){
//             $sql4= "INSERT INTO movie_keywords(movie_id,keyword) values('$movie_id','$keywords_ar[$j]')"
//            ;
//              mysqli_query($db, $sql4);
//              }
//
//
//        $quotes = [];
//        $quotes = $_POST['movie_quote'];
//        $quotes_ar = explode(PHP_EOL, $quotes);
//        $h = 0;
//        for ($h=0 ;$h< sizeof($quotes_ar); $h++){
//               $sql5= "INSERT INTO movie_quotes(movie_id,movie_quote_name) VALUES ('$movie_id','$quotes_ar[$h]')";
//               mysqli_query($db, $sql5);
//        }
//        $box_office = $_POST['box_office'];
//        $running_time = $_POST['running_time'];
//        $budget = $_POST['budget'];
//
//                   $sql6= "INSERT INTO movie_numbers(movie_id,box_office,budget,running_time) values('$movie_id','$box_office','$budget','$running_time')"
//        ;
//
//
//        mysqli_query($db, $sql6);



    
    
	header('location: movies.php?updated=Success');
    db_disconnect($db);
				
?>
    
