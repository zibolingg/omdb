<?php
   
include_once 'db_credentials.php';
    $link = mysqli_connect('localhost','root','','OMDB');
    
    if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
    if (isset($_GET['movie_id'])) {
          $movie_id =  mysqli_real_escape_string($link, $_GET['movie_id']);
          $native_update = $_POST['native_name_update'];
          $english_update = $_POST['english_name_update'];
          $year_update = $_POST['year_update'];
          
          $sql = "UPDATE movies
           Set native_name = '$native_update',
               english_name = '$english_update',
               year_made = '$year_update'
           Where id = '$movie_id'"
        ;
        
          //$sql1= "UPDATE movies Set native_name ='".$native_update."' WHERE movie_id =".$movie_id.";";
          
          //$sql2= "UPDATE movies Set native_name ='".$english_update."' WHERE movie_id =".$movie_id.";";
          
          //$sql3= "UPDATE movies Set native_name ='".$year_update."' WHERE movie_id =".$movie_id.";";
          
          //mysqli_query($db, $sql1);
          //mysqli_query($db, $sql2);
          //mysqli_query($link, $sql3);
        mysqli_query($link, $sql);
        header('location: movies.php?updated=Success');
      }
      
				
    mysqli_close($link);
				
?>
    
