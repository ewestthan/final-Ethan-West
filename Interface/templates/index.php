<!-- TODO
add sorting function by clicking table headers, sort by grade, attributes, etc
fix "x" span element on modal to exit modal
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
            <th>Number</th>  
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
