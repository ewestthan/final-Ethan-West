<!-- TODO
add sorting function by clicking table headers, sort by grade, attributes, etc
fix "x" span element on modal to exit modal
finish setting up modal
add function to detirmine final Rating
add search bar at top for location and climb name 
make table headers sticky
-->

<?php
include 'top.php';

function printModal($id, $databaseWriter){
    $sql = 'SELECT * FROM top100 WHERE fldPlace = "' . $id . '"';
        
    if (DEBUG) {
        print $databaseWriter->displayQuery($sql);
    }

    $climb = $databaseWriter->select($sql);

    print '<div id="myModal' . $climb[0]['fldPlace'] . '" class="modal">';
    print '<div class="modal-content">';
    print '<span class="close">&times;</span>';
    print '<p>' . $climb[0]['fldName'] . '</p>';
    print '</div></div>';
    print '</tr>' . PHP_EOL;
}
?>

<section class="tab">
    <h1>Eric's Top 100 double digits</h1>
    <table id="mainTable">
        <tr>
            <th id='grade' onclick='sortByRank()'>Rank</th>  
            <th id='grade' onclick='sortByHardest()'>Grade</th>
            <th>Name</th>
            <th>Location</th>
            <th>Uncontrived</th>
            <th>Obvious Start</th>
            <th>Good Rock</th>
            <th>Flat Landing</th>
            <th>Tall</th>
            <th>Beautiful setting</th>
            <th>Final Rating</th>
        </tr>
		<?php

        $sql = 'SELECT * FROM top100';
        
        if (DEBUG) {
            print $databaseWriter->displayQuery($sql);
        }

        $climbs = $databaseWriter->select($sql);

        foreach ($climbs as $climb) {
            print '<tr onclick="showModal(' . $climb['fldPlace'] . ')">'; //include mouse click display image/description and links to vids
            print '<td>' . $climb['fldPlace'] . '</td>';
            print '<td>V' . $climb['fldGrade'] . '</td>';
            print '<td>' . $climb['fldName'] . '</td>';
            print '<td>' . $climb['fldLocation'] . '</td>';
            if($climb['fldUncontrived'] == 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            if($climb['fldObviousStart'] == 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            if($climb['fldGoodRock'] == 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            if($climb['fldFlatLanding'] == 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            if($climb['fldTall'] == 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            if($climb['fldGoodSetting'] == 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            print '<td>' . $climb['fldFinalRating'] . '</td>';
            printModal($climb['fldPlace'], $databaseWriter);
        }
        print '</table>';
		?>
</section>

<!-- <script>
    function sortByHardest() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("mainTable");
  switching = true;
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("td")[1];
      y = rows[i + 1].getElementsByTagName("td")[1];
      // Check if the two rows should switch place:
      x = x.innerText.substring(1);
      y = y.innerText.substring(1);
      x = parseInt(x);
      y = parseInt(y);
      if (x < y) {
          shouldSwitch = true;
          break;
        }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script> -->