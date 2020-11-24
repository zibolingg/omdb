<?php
   
include_once 'db_credentials.php';
    $db = mysqli_connect('localhost', 'root', '','OMDB');
    // Verificamos conexiones
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
    $songs = [];
    $splitWords= [];
    $_POST['new_song'];
    if (isset($_POST['new_song'])){
        $songs =$_POST['new_song'];
        
        
        foreach ($songs as $i => $song) {
                     //echo "this is i: $i and this is: $word and this is words: $words";
//                    echo($i.'|'.$word.'|'.$engWords[$i].PHP_EOL);
                    $splitWords = $song; //Remove dot at end if exists
                    $splitWords = preg_replace('/\s+/', '', $splitWords);
                    $array = explode(';', $splitWords); //split string into array seperated by ', '
/* Use tab and newline as tokenizing characters as well  */
            if (!empty($songs[$i])) {
                foreach($array as $value){
                   $sql= "INSERT INTO songs(title)values('$value')";
                        }
            }
        }
        mysqli_query($db, $sql);
    }
   
    
                    

        header('location: movies.php?create=Success');
        mysqli_close($db);
                    
    ?>
    
