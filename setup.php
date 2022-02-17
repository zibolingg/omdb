<?php
  $nav_selected = "SETUP";
  $left_buttons = "NO";
  $left_selected = "";

  include("./nav.php");

 ?>

 <div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">Setup</h3>
      <form enctype='multipart/form-data' method='post'>
        <label>Select Table name</label>
        <Select name="table_name" required class="form-control">
          <option value="" disabled>Select Table name</option>
          <option value="people">People Table</option>
          <option value="movies">Movies Table</option>
          <option value="songs">Songs Table</option>
        </select>
        <br>

      <label>Upload CSV file Here</label>
      <p><i><b>Note :</b> CSV file must have 3 columns -<br>
      1 - Native name<br>
      2 - English Name<br>
      3 - Year Made<br>
      --------------------<br>
      People<br>
      1 - Stage Name<br>
      2 - First Name<br>
      3 - Middle Name<br>
      4 - Last name<br>
      5 - Gender<br>
      ---------------------<br>
      Song<br>
      1 - Title<br>
      2 - Lyrics<br>
      3 - Theme</i></p>

      <input size='50' type='file' name='filename'>
      </br>
      <input type='submit' name='submit' value='Upload Products'>

      </form>

    </div>
</div>

<?php include("./footer.php"); ?>

<?php
if(isset($_POST['submit'])){
  $file = $_FILES['filename'];

if( 'text/csv' == $file['type'] ||  'application/vnd.ms-excel' == $file['type'] ) {

          $table_name = $_POST['table_name'];
						$handle=$_FILES["filename"]["tmp_name"];
						$data = array_map(function($line) {
					    return str_getcsv($line, ',');
					}, file($handle, FILE_IGNORE_NEW_LINES));
					$key = array_key_last($data);
          end($data);
					$last_index = key($data);
          for($i = 0; $i<=$last_index ; $i++){
            $data1 = "";
            $data2 = "";
            $data3 = "";
            $data4 = "";
            $data5 = "";
            if(!empty($data[$i][0])){$data1 = $data[$i][0];}
            if(!empty($data[$i][1])){$data2 = $data[$i][1];}
            if(!empty($data[$i][2])){$data3 = $data[$i][2];}
            if(!empty($data[$i][3])){$data4 = $data[$i][3];}
            if(!empty($data[$i][4])){$data5 = $data[$i][4];}
            if($table_name=="movies"){
                $query = mysqli_query($db,"INSERT INTO `movies`(`native_name`, `english_name`, `year_made`)
                VALUES ('$data1','$data2','$data3')");
          }
          elseif ($table_name=="people") {
            $image_name = "image file name";
            $query = mysqli_query($db,"INSERT INTO `people`(`stage_name`, `first_name`, `middle_name`, `last_name`, `gender`, `image_name`)
            VALUES ('$data1','$data2','$data3','$data4','$data5','$image_name')");
          }
          else{
            $query = mysqli_query($db,"INSERT INTO `songs`(`title`, `lyrics`, `theme`)
             VALUES ('$data1','$data2','$data3')");
          }

          }
          echo '<script language="javascript">';
          echo 'alert("Successfully Imported")';
          echo '</script>';
        }
        else{
          echo '<script language="javascript">';
          echo 'alert("Kindly Upload a CSV file")';
          echo '</script>';
        }

      }
          ?>
