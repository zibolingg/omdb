<?php
   
include_once 'db_credentials.php';
    $db = mysqli_connect('localhost', 'root', '','OMDB');
    // Verificamos conexiones
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
    $songs = [];
    $songs =$_POST['new_songs'];
    $songs_ar = explode(PHP_EOL, $songs);
    $i=0;
    echo sizeof($songs_ar);
    for ($i ;$i< sizeof($songs_ar); $i++){
        echo $i;
                    echo $songs_ar[$i];
        $sql= "INSERT INTO songs(title) values('$songs_ar[$i]')";
                    
         mysqli_query($db, $sql);
         }
        
    
   
    
                    
        header('location: movies.php?create=Success');
        mysqli_close($db);
                    
    ?>
    
