<?php
   
include_once 'db_credentials.php';
    $db = mysqli_connect('localhost', 'root', '','OMDB');
    // Verificamos conexiones
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";

        $song = $_POST['new_song'];
        $song2 = $_POST['new_song2'];
        $song3 = $_POST['new_song3'];
        $song4 = $_POST['new_song4'];
        $song5 = $_POST['new_song5'];
                            
                $sql1 = "INSERT INTO songs(title)values('$song')";
                $sql2 = "INSERT INTO songs(title)values('$song2')";
                $sql3 = "INSERT INTO songs(title)values('$song3')";
                $sql4 = "INSERT INTO songs(title)values('$song4')";
                $sql5 = "INSERT INTO songs(title)values('$song5')";


          
    
                    mysqli_query($db, $sql1);
                    mysqli_query($db, $sql2);
                    mysqli_query($db, $sql3);
                    mysqli_query($db, $sql4);
                    mysqli_query($db, $sql5);

        header('location: movies.php?create=Success');
        mysqli_close($db);
                    
    ?>
    
