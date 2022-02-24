<?php $page_title = 'The Cow Layer'; ?>
<?php
    $nav_selected = "LIST";
    $left_buttons = "NO";
    $left_selected = "";
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

<h2>People of this Movie</h2>
<form method="post" action="delete_movie_people.php">
  <table id="info" cellpadding="0" cellspacing="0" border="0"
      class="datatable table table-striped table-bordered datatable-style table-hover"
      width="100%" style="width: 100px;">
              <thead>
          <tr id="table-first-row">
              <th>Select</th>
              <th scope="col">#</th>
              <th scope="col">People Full Name</th>
              <th scope="col">Gender</th>
              <th scope="col">People Stage</th>
              <th scope="col">Role</th>
              </tr>
              </thead>
              <tbody>


  <?php
  $id = $_GET['movie_id'];
  $count = '1';

      $query = mysqli_query($db,"select movie_people.people_id,people.stage_name, people.first_name, people.middle_name, people.last_name,people.gender,movie_people.role
      from movie_people
      left join people
      on movie_people.people_id =people.people_id
      where movie_people.movie_id = $id");


    if(mysqli_num_rows($query)>0){
      while($row = mysqli_fetch_assoc($query)){


  ?>


            <tr>
            <td><input type="checkbox" name="movie_people_id<?php echo $count; ?>" value="<?php echo $row['movie_people_id']; ?>"
              <?php if(!empty($_SESSION['checked_delete'])){ ?>
                checked="checked"
              <?php }?>
              ></td>
            <th scope="row"><?php echo $count; ?></th>
            <td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><?php echo $row['stage_name'] ?></td>
            <td><?php echo $row['role']; ?></td>

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
            <h2>Other Peoples</h2>
            <form method="post" action="add_movie_people_post.php">
              <table id="info1" cellpadding="0" cellspacing="0" border="0"
                  class="datatable table table-striped table-bordered datatable-style table-hover"
                  width="100%" style="width: 100px;">
                          <thead>
                  <tr id="table-first-row">
                            <th>Select</th>
                          <th scope="col">#</th>
                          <th scope="col">Stage Name</th>
                          <th scope="col">First Name</th>
                          <th scope="col">Middle Name</th>
                          <th scope="col">Last Name</th>
                          <th scope="col">Gender</th>

                          </tr>
                          </thead>
                          <tbody>


              <?php
              $id111 = $_GET['movie_id'];
              // echo $id;
              // exit();
              $count = '1';

              $query = mysqli_query($db,"Select * from people");
              $num = mysqli_num_rows($query);
              if($num>0){
                while($row = mysqli_fetch_assoc($query))
                {
                  $people_id = $row['people_id'];
                  $stage_name = $row['stage_name'];
                  $first_name = $row['first_name'];
                  $middle_name = $row['middle_name'];
                  $last_name = $row['last_name'];
                  $gender = $row['gender'];

              ?>


                        <tr>

                        <td><input type="checkbox" name="people_id<?php echo $count; ?>" value="<?php echo $people_id; ?>"
                          <?php if(!empty($_SESSION['checked'])){?>
                          checked
                        <?php } ?>
                          ></td>
                        <th scope="row"><?php echo $count; ?></th>
                        <td><?php echo $stage_name; ?></td>
                        <td><?php echo $first_name; ?></td>
                        <td><?php echo $middle_name; ?></td>
                        <td><?php echo $last_name; ?></td>
                        <td><?php echo $gender; ?></td>


                      </tr>
                        <?php
                        $count++;
                      }
                      }
                        ?>
                      </tbody>
                      </table>
                        <input type="hidden" name="movie_id" value="<?php echo $id111; ?>" />
                        <input type="hidden" name="total_elements" value="<?php echo $count; ?>">



                        <div style="margin-left:200px;">
                          <button type="submit" name="lead_actor">Lead Actor</button>
                          <button type="submit" name="lead_actress">Lead Actress</button>
                          <button type="submit" name="supporting_actor">Supporting Actor</button>
                          <button type="submit" name="supporting_actress">Supporting Actress</button>
                          <button type="submit" name="producer">Producer</button>
                          <button type="submit" name="director">Director</button>
                          <button type="submit" name="music_director">Music Director</button>
                        </div>
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

<style>
  tfoot {
    display: table-header-group;
  }
</style>

<?php
db_disconnect($db);
include("./footer.php");
?>
