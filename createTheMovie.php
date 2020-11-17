
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
                        
            $sql1 = "INSERT INTO movies(native_name,english_name,year_made)values('$native','$movie','$year')";
    


                    
    
	  $language = $_POST['language'];
      $country = $_POST['country'];
      $genre = $_POST['genre'];
      $plot = $_POST['plot'];
      $tag_line = $_POST['tag_line'];
   
    $sql2 = "INSERT INTO movie_data (language, country, genre, plot, tag_line) VALUES ( '$language' , '$country', '$genre', '$plot', '$tag_line' )";

                
                
    $trivia = $_POST['trivia'];
      
    $sql3 = "INSERT INTO movie_trivia (trivia) VALUES ( '$trivia' )";

                
    $movie_link = $_POST['movie_link'];
      $movie_link_type = $_POST['movie_link_type'];

    $sql4 = "INSERT INTO movies_data (m_link, m_link_type) VALUES ( '$movie_link' , '$movie_link_type' )";
    
                mysqli_query($db, $sql1);
                mysqli_query($db, $sql2);
                mysqli_query($db, $sql3);
                mysqli_query($db, $sql4);
                

	header('location: movies.php?create=Success');
    mysqli_close($db);
				
?>
