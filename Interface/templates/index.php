<!-- TODO
add sorting function by clicking table headers, sort by grade, attributes, etc
fix "x" span element on modal to exit modal
finish setting up modal
add function to detirmine final Rating
make table headers sticky
sort checkmarks, display only climbs with that checkmark

MODAL:
embed the video on left side
add description on right
display row on bottom

Editing:
add the form to add climbs
add add functionality to edit checkmarks
save updated data to database

later on
add personal lists
check marks for sent on personal list
add upvotes and downvotes to each climb
-->

<?php
include 'top.php';

function printModal($id, $thisDatabaseWriter){
    $sql = 'SELECT * FROM top100 WHERE fldRank = "' . $id . '"';
        
    if (DEBUG) {
        print $thisDatabaseWriter->displayQuery($sql);
    }

    $climb = $thisDatabaseWriter->select($sql);

    print '<div id="myModal' . $climb[0]['fldRank'] . '" class="modal">';
        print '<div class="modal-content">';
            print '<h3>' . $climb[0]['fldName'] . '</h3>';            
            print '<span class="close">&times;</span>';
            print '<section class="flex-container">';
                print '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"></iframe>';
                print '<p>' . $climb[0]['fldDescription'] . '</p>';
            print '</section>';
    print '</div></div>';
    print '</tr>' . PHP_EOL;
}
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

        $sql = 'SELECT * FROM top100';
        
        if (DEBUG) {
            print $databaseWriter->displayQuery($sql);
        }

        $climbs = $thisDatabaseWriter->select($sql);

        foreach ($climbs as $climb) {
            print '<tr onclick="showModal(' . $climb['fldRank'] . ')">'; //include mouse click display image/description and links to vids
            print '<td>' . $climb['fldRank'] . '</td>';
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
            printModal($climb['fldRank'], $thisDatabaseWriter);
        }
        print '</table>';
		?>
</section>