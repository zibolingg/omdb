<?php $page_title = 'The Cow Layer'; ?>
<?php
    $nav_selected = "LIST";
    $left_buttons = "NO";
    $left_selected = "";
  require 'db_credentials.php';
     include("./nav.php");


           if(isset($_POST['checked_all'])){
             $_SESSION['checked'] = "checked";

           }
           if(isset($_POST['uncheck'])){
           unset($_SESSION['checked']);
           }

           if(isset($_POST['checked_all_delete'])){
              $_SESSION['checked_delete'] = "checked";
           }
           if(isset($_POST['uncheck_delete'])){
             unset($_SESSION['checked_delete']);
           }


  ?>

<!DOCTYPE html>
<html>
<h1>Modify a movie</h1>

<h2>Songs of this movie</h2>
<form method="post" action="delete_song.php">
  <table id="info" cellpadding="0" cellspacing="0" border="0"
      class="datatable table table-striped table-bordered datatable-style table-hover"
      width="100%" style="width: 100px;">
              <thead>
              <tr id="table-first-row">
                <th>Select</th>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Lyrics</th>
              <th scope="col">Theme</th>
              </tr>
              </thead>
              <tbody>

  <?php
  $id = $_GET['movie_id'];

  $count = '1';
      $query = mysqli_query($db,"SELECT songs.*,movie_song.id
      FROM movie_song
      LEFT JOIN songs
      ON movie_song.song_id = songs.song_id
      WHERE movie_song.movie_id = ".$id);


    if(mysqli_num_rows($query)>0){
      while($row = mysqli_fetch_assoc($query)){


  ?>


            <tr>
            <td><input type="checkbox" name="song_id<?php echo $count; ?>" value="<?php echo $row['id']; ?>"
              <?php if(!empty($_SESSION['checked_delete'])){ ?>
                checked="checked"
              <?php }?>
              ></td>
            <th scope="row"><?php echo $count; ?></th>
            <td><?php echo $row['title'] ?></td>
            <td><?php echo $row['lyrics']; ?></td>
            <td><?php echo $row['theme']; ?></td>

            </tr>

            <?php
            $count++;
                }
                  }
            ?>

            </tbody>
            </table>
            <input type="hidden" name="movie_id" value="<?php echo $_GET['movie_id'] ; ?>" />
                <input type="hidden" name="total_elements" value="<?php echo $count; ?>">
            <button type="submit" style="margin-left:500px;">Delete</button>
            </form>
            <form method="post">
              <button type="submit" name="uncheck_delete">Uncheck all</button>
              <button type="submit" name="checked_all_delete">Check all</button>
            </form>



            <hr/>
            <h2>Other song</h2>
            <form method="post" action="attach_song.php">
              <table id="info1" cellpadding="0" cellspacing="0" border="0"
                  class="datatable table table-striped table-bordered datatable-style table-hover"
                  width="100%" style="width: 100px;">
                          <thead>
                        <tr id="table-first-row">
                            <th>Select</th>
                          <th scope="col">#</th>
                          <th scope="col">Title</th>
                          <th scope="col">Lyrics</th>
                          <th scope="col">Theme</th>
                        </tr>
                          </thead>
                          <tbody>


              <?php
              $id = $_GET['movie_id'];
              $count = '1';

              $query = mysqli_query($db,"Select A.*
              from songs A where A.song_id not in (select song_id from movie_song )");
              $num = mysqli_num_rows($query);
              if($num>0){
                while($row = mysqli_fetch_assoc($query))
                {

                  $title = $row['title'];
                  $lyrics = $row['lyrics'];
                  $theme = $row['theme'];
                  $song_id = $row['song_id']

              ?>


                        <tr>

                        <td><input type="checkbox" name="song_id<?php echo $count; ?>" value="<?php echo $song_id; ?>"
                          <?php if(!empty($_SESSION['checked'])){?>
                          checked
                        <?php } ?>
                          ></td>
                        <th scope="row"><?php echo $count; ?></th>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $lyrics; ?></td>
                        <td><?php echo $theme; ?></td>


                      </tr>
                        <?php
                        $count++;
                      }
                      }
                        ?>
                      </tbody>
                      </table>
                        <input type="hidden" name="movie_id" value="<?php echo $_GET['movie_id']; ?>" />
                        <input type="hidden" name="total_elements" value="<?php echo $count; ?>">



                          <button type="submit" style="margin-left:500px;">Add in this movie</button>
                          </form>
                          <form method="post">
                            <button type="submit" name="uncheck">Uncheck all</button>
                            <button type="submit" name="checked_all">Check all</button>
                          </form>

<style type="text/css">
#movieModify {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

/* Style the input fields */
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}


/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<script type="text/javascript" language="javascript">
  $(document).ready(function() {

    $('#info').DataTable({
      dom: 'lfrtBip',
      buttons: [
        'copy', 'excel', 'csv', 'pdf'
      ]
    });

    $('#info thead tr').clone(true).appendTo('#info thead');
    $('#info thead tr:eq(1) th').each(function(i) {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');

      $('input', this).on('keyup change', function() {
        if (table.column(i).search() !== this.value) {
          table
            .column(i)
            .search(this.value)
            .draw();
        }
      });
    });

    var table = $('#info').DataTable({
      orderCellsTop: true,
      fixedHeader: true,
      retrieve: true
    });

  });
</script>


<script type="text/javascript" language="javascript">
  $(document).ready(function() {

    $('#info1').DataTable({
      dom: 'lfrtBip',
      buttons: [
        'copy', 'excel', 'csv', 'pdf'
      ]
    });

    $('#info1 thead tr').clone(true).appendTo('#info1 thead');
    $('#info1 thead tr:eq(1) th').each(function(i) {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');

      $('input', this).on('keyup change', function() {
        if (table.column(i).search() !== this.value) {
          table
            .column(i)
            .search(this.value)
            .draw();
        }
      });
    });

    var table = $('#info1').DataTable({
      orderCellsTop: true,
      fixedHeader: true,
      retrieve: true
    });

  });
</script>
<?php include("./footer.php"); ?>
