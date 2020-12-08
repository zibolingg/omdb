
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
      
    mysqli_query($db, $sql1);
    
    
                
    

	header('location: movies.php?create=Success');
    mysqli_close($db);
				
?>
