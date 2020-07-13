<?php

  $nav_selected = "SONGS"; 
  $left_buttons = "YES"; 
  $left_selected = "SONGS"; 

  include("./nav.php");
  global $db;

  ?>


<div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">Movie --> List of Songs</h3>
        <table id="info" cellpadding="0" cellspacing="0" border="0"
            class="datatable table table-striped table-bordered datatable-style table-hover"
            width="100%" style="width: 100px;">
              <thead>
                <tr id="table-first-row">
                        <th>Movie Name</th>
                        <th>Song Title</th>
                        <th>Lyrics</th>
                        <th>Play</th>
                </tr>
              </thead>

              <tbody>

              <?php

$sql = "SELECT 
            mv.english_name,
            s.title,
            sm.s_link,
            SUBSTRING(s.lyrics, 1, 50) as lyrics
        FROM movie_song ms
            INNER JOIN `song_media` sm USING(song_id)
            INNER JOIN `movies` mv USING(movie_id)
            INNER JOIN `songs` s USING(song_id)";
$result = $db->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td>'.$row["english_name"].'</td>
                                <td>'.$row["title"].'</td>
                                <td>'.$row["lyrics"].'</td>
                                <td><a class="btn btn-info btn-sm" href="'.$row["s_link"].'">Play</a></td>
                              
                            </tr>';
                    }//end while
                }//end if
                else {
                    echo "0 results";
                }//end else

                 $result->close();
                ?>

              </tbody>
        </table>


        <script type="text/javascript" language="javascript">
    $(document).ready( function () {
        
        $('#info').DataTable( {
            dom: 'lfrtBip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );

        $('#info thead tr').clone(true).appendTo( '#info thead' );
        $('#info thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    
        var table = $('#info').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

</script>

        

 <style>
   tfoot {
     display: table-header-group;
   }
 </style>

  <?php include("./footer.php"); ?>
© 2020 GitHub, Inc.