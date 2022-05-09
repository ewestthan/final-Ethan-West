<!-- TODO
finish setting up modal
add function to detirmine final Rating
make table headers sticky

MODAL:
display row on bottom

Editing:
Save order after drag and drop

later on
check marks for sent on personal list
add upvotes and downvotes to each climb
-->

<?php
include 'top.php';
include 'modal.php';
//The main index list Id
$ericsList = 24;
?>


<section class="tab">
    <h1>Eric's Top 100 double digits</h1>
    <table id="mainTable">
        <tr>
            <th id='rank' onclick='sortByRank()'>Rank</th>
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

        $sql = 'SELECT * FROM top100 WHERE fnkListId = ' . $ericsList;

        if (DEBUG) {
            print $thisDatabaseWriter->displayQuery($sql);
        }

        $climbs = $thisDatabaseWriter->select($sql);

        foreach ($climbs as $climb) {
            print '<tr onclick="showModal(' . $climb['pmkClimbId'] . ')">'; //include mouse click display image/description and links to vids
            print '<td>' . $climb['fldRank'] . '</td>';
            print '<td>V' . $climb['fldGrade'] . '</td>';
            print '<td>' . $climb['fldName'] . '</td>';
            print '<td>' . $climb['fldLocation'] . '</td>';

            $score = 0;
            if ($climb['fldUncontrived'] == 1) {
                print '<td><i class="fa fa-check"></i></td>';
                $score++;
            } else {
                print '<td><i class="fa fa-remove"></i></td>';
            }
            if ($climb['fldObviousStart'] == 1) {
                print '<td><i class="fa fa-check"></i></td>';
                $score++;
            } else {
                print '<td><i class="fa fa-remove"></i></td>';
            }
            if ($climb['fldGoodRock'] == 1) {
                print '<td><i class="fa fa-check"></i></td>';
                $score++;
            } else {
                print '<td><i class="fa fa-remove"></i></td>';
            }
            if ($climb['fldFlatLanding'] == 1) {
                print '<td><i class="fa fa-check"></i></td>';
                $score++;
            } else {
                print '<td><i class="fa fa-remove"></i></td>';
            }
            if ($climb['fldTall'] == 1) {
                print '<td><i class="fa fa-check"></i></td>';
                $score++;
            } else {
                print '<td><i class="fa fa-remove"></i></td>';
            }
            if ($climb['fldGoodSetting'] == 1) {
                print '<td><i class="fa fa-check"></i></td>';
                $score++;
            } else {
                print '<td><i class="fa fa-remove"></i></td>';
            }
            print '<td>' . $score . '</td>';
            printModal($climb);
        }
        print '</table>';
        ?>
</section>