//TODO
// add sorting function by clicking table headers, sort by grade, attributes, etc
// add popup when you click on the row 
// add check image to each binary attribute 
// add function to detirmine final Rating
// add search bar at top for location and climb name 

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
            print '<tr>'; //include mouse click display image/description and links to vids
            print '<td>' . $climb['fldPlace'] . '</td>';
            print '<td>' . $climb['fldGrade'] . '</td>';
            print '<td>' . $climb['fldName'] . '</td>';
            print '<td>' . $climb['fldLocation'] . '</td>';
            print '<td>' . $climb['fldUncontrived'] . '</td>';
            print '<td>' . $climb['fldObviousStart'] . '</td>';
            print '<td>' . $climb['fldGoodRock'] . '</td>';
            print '<td>' . $climb['fldFlatLanding'] . '</td>';
            print '<td>' . $climb['fldTall'] . '</td>';
            print '<td>' . $climb['fldGoodSetting'] . '</td>';
            print '<td>' . $climb['fldFinalRating'] . '</td>';
            print '</tr>' . PHP_EOL;
        }
        print '</table>';

		print "<script>" . PHP_EOL;
		include "../static/tableSort.js";
		print PHP_EOL . "</script>";
		?>
</section>
<script>
	document.getElementById("default").click();
</script>