<?php
  include("./nav.php");
  if(isset($_GET['people_id'])){
    $id = $_GET['people_id'];
    $query = mysqli_query($db,"DELETE FROM `people` WHERE people_id = '$id'");
    if($query){
      db_disconnect($db);
      echo ("<script LANGUAGE='JavaScript'>
          window.alert('Data Deleted Succesfully');
          window.location.href='people.php';
          </script>");
    }
  }
  db_disconnect($db);
    
?>
