<!-- TODO
add sorting function by clicking table headers, sort by grade, attributes, etc
add popup when you click on the row 
add function to detirmine final Rating
add search bar at top for location and climb name 
make table headers sticky
-->
<?php
include 'top.php';
?>

<section class="tab">
    <h1>Eric's Top 100 double digits</h1>
    <table>
        <tr>
            <th>Number</th>  
            <th>Grade</th>
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
            print '<tr class="popup" onclick="showPopup()">'; //include mouse click display image/description and links to vids
            print '<td>' . $climb['fldPlace'] . '</td>';
            print '<td>' . $climb['fldGrade'] . '</td>';
            print '<td>' . $climb['fldName'] . '</td>';
            print '<td>' . $climb['fldLocation'] . '</td>';
            if($climb['fldUncontrived'] = 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            if($climb['fldObviousStart'] = 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            if($climb['fldGoodRock'] = 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            if($climb['fldFlatLanding'] = 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            if($climb['fldTall'] = 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            if($climb['fldGoodSetting'] = 1){print '<td><i class="fa fa-check"></i></td>';}
            else{print '<td><i class="fa fa-remove"></i></td>';}
            print '<td>' . $climb['fldFinalRating'] . '</td>';
            print '<section class="popuptext" id="popup">Popup text...</section>';
            print '</tr>' . PHP_EOL;
        }
        print '</table>';
        // print "<section class='popuptext' id='popup'>" . $climb["fldImage"]  . $climb["fldDescription"] .  "Popup Works</section>";
		?>
</section>

<div class="popup" onclick="showPopup()">Click me!
  <section class="popuptext" id="popup">Popup text...</section>
</div>
