<?php
   
include_once 'db_credentials.php';
    $link = mysqli_connect('localhost','root','','OMDB');
    $movie_id =  mysqli_real_escape_string($db, $_GET['movie_id']);
    if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
    if (isset($_GET['movie_id'])) {
          
          $native_update = $_GET['native_name_update'];
          $english_update = $_GET['english_name_update'];
          $year_update = $_GET['year_update'];
          
          $sql1= "UPDATE movies Set native_name ='".$native_update."' WHERE movie_id =".$movie_id.";";
          
          $sql2= "UPDATE movies Set native_name ='".$english_update."' WHERE movie_id =".$movie_id.";";
          
          $sql3= "UPDATE movies Set native_name ='".$year_update."' WHERE movie_id =".$movie_id.";";
          
          mysqli_query($db, $sql1);
          mysqli_query($db, $sql2);
          mysqli_query($link, $sql3);
      }
      header('location: movies.php?create=Success');
				
    mysqli_close($link);
				
?>
    
