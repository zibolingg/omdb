<?php

  // set the current page to one of the main buttons
  $nav_selected = "REPORTS";

  // make the left menu buttons visible; options: YES, NO
  $left_buttons = "NO";

  // set the left menu button selected; options will change based on the main selection
  $left_selected = "";
  global $db;
  include("./nav.php");
?>

<html>

<head>
<style>
table.center {
    margin-left:auto;
    margin-right:auto;
  }
</style>
</head>

<body>
<h2 style = "color: #01B0F1;">Year Made Count </h3>




  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Year Made</th>
        <th scope="col">Movies Count</th>
        </tr>
    </thead>
    <tbody>

        <?php
        // $query = "select count(year_made), year_made from movies GROUP BY year_made";
        $query = mysqli_query($db,"select count(year_made), year_made from movies GROUP BY year_made");
        $count = 0;
        while($row = mysqli_fetch_assoc($query)){
          $count++;
          ?>

          <tr>
         <th scope="row"><?php echo $count; ?></th>
         <td><?php echo $row['year_made']; ?></td>
         <td><?php echo $row['count(year_made)']; ?></td>
        </tr>


          <?php }
            ?>
</body>
</html>
