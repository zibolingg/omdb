<?php
  $nav_selected = "SCANNER";
  $left_buttons = "YES";
  $left_selected = "WARNINGS";

  include("./nav.php");
  
 ?>

 <div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">Scanner --> Warnings </h3>

    </div>
</div>

<?php
    db_disconnect($db);
    include("./footer.php");
?>
