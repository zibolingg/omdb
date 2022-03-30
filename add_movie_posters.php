<?php $page_title = 'The Cow Layer'; ?>
<?php
    $nav_selected = "MOVIES";
    $left_buttons = "YES";
    $left_selected = "NO";

     include("./nav.php");

    $sql = "select movie_id, native_name from movies;";

    $results_per_page = 20;
    $sql = "select * from movies";
    $result = mysqli_query($db, $sql);
    $number_of_result = mysqli_num_rows($result);

    $number_of_page = ceil($number_of_result / $results_per_page);

    if (!isset ($_GET['page']) ) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    $page_first_result = ($page-1) * $results_per_page;

    $sql2 = "SELECT * FROM movies LIMIT " . $page_first_result . ',' . $results_per_page;
    $result = mysqli_query($db, $sql2);
  ?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/assets/favicon.ico">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

</head>
<html>
<body >
<?php
    echo '<a href = "add_movie_posters.php?page=' . $page - 1 . '">Previous    </a>';
    echo '<a href = "add_movie_posters.php?page=' . $page + 1 . '">Next</a><br>';
    $index = 0;
//<iframe name="hiddenFrame" class="hide"></iframe>
?>

    <form name="poster_form" action="add_movie_posters.php" method='post' id="poster_form" class="poster" enctype = "multipart/form-data">
    <div class="container">
        <?php
        $count = 0;
        while($row = mysqli_fetch_array($result)){
            echo '<div class="drop-zone">';
            echo '<span class="drop-zone__prompt">'.$row['native_name'].'</span>';
            echo '<input type="file" name = "'.$count.'" id="media" form="poster_form" class="drop-zone__input">';
            echo '<input type="hidden" name = "movie'.$count.'" value = "'.$row['movie_id'].'">';
            echo '</div>';
            $count++;
            
        }?>
    </div>
        <button type="submit" class="upload-image" name="submit">Submit</button>
    </form>


<?php
$flag = 0;
for($count = 0; $count < 20; $count++){
    if (is_uploaded_file($_FILES[$count]['tmp_name'])) {
        $uploads_dir = 'posters/';
        $tmp_name = $_FILES[$count]['tmp_name'];
        $pic_name = $_FILES[$count]['name'];
        if(move_uploaded_file($tmp_name, $uploads_dir.$pic_name)){
            $flag = 1;
        } else {
            echo "Failed to Upload Images";
        }
    }
}
if($flag = 1){
    echo "Success!";
}
?>

<?php
    db_disconnect($db);
?>

<style type="text/css">

.container {
    display: flex;
    flex-wrap: wrap;
    padding: 5px;
}

.drop-zone {
  max-width: 200px;
  min-width: 200px;
  height: 200px;
  padding: 2px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-family: "Quicksand", sans-serif;
  font-weight: 500;
  font-size: 20px;
  cursor: pointer;
  color: #cccccc;
  border: 4px solid #000000;
  border-radius: 10px;
  margin: 5px;
}

.drop-zone--over {
  border-color: green;
}

input {
    display:none;
}

.drop-zone__thumb {
  width: 100%;
  height: 100%;
  border-radius: 10px;
  overflow: hidden;
  background-color: #cccccc;
  background-size: cover;
  position: relative;
}

.drop-zone__thumb::after {
  content: attr(data-label);
  position: relative;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 5px 0;
  color: #ffffff;
  background: rgba(0, 0, 0, 0.75);
  font-size: 14px;
  text-align: center;
}

</style>
<script>
document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");
                                                       $('input[type="file"]').hide();
  dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
  });

  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });

  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });
                                                       
    dropZoneElement.addEventListener("drop", (e) => {
                                     e.preventDefault();
                                     console.log(e.dataTransfer.files)
                                     
                                     
                                     });
            

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
                                   
    }

    dropZoneElement.classList.remove("drop-zone--over");
  });
});

/**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 */
function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

  // First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone__prompt")) {
    dropZoneElement.querySelector(".drop-zone__prompt").remove();
  }

  // First time - there is no thumbnail element, so lets create it
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone__thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }

  thumbnailElement.dataset.label = file.name;

  // Show thumbnail for image files
  if (file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = () => {
      thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
    };
  } else {
    thumbnailElement.style.backgroundImage = null;
  }
    
    
}



</script>
</body>
</html>
