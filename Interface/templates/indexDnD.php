<!-- TODO
add sorting function by clicking table headers, sort by grade, attributes, etc
fix "id" span element on modal to exit modal
finish setting up modal
add function to detirmine final Rating
add search bar at top for location and climb name 
make table headers sticky

-->

<?php
include 'top.php';

function printModal($climb){
    print '<div id="myModal' . $climb['fldRank'] . '" class="modal">';
        print '<div class="modal-content">';
            print '<h3>' . $climb['fldName'] . '</h3>';            
            print '<span class="close">&times;</span>';
            print '<section class="flex-container">';
                print '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"></iframe>';
                print '<p>' . $climb['fldDescription'] . '</p>';
            print '</section>';
    print '</div></div>';
    print '</tr>' . PHP_EOL;
}
?>

<section class="tab">
    <h1>Eric's Top 100 double digits</h1>
    <table id="dndTable">
        <tbody>
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
    </tbody>
        <tbody class="row_drag">
		<?php

        $sql = 'SELECT * FROM top100';
        
        if (DEBUG) {
            print $thisDatabaseWriter->displayQuery($sql);
        }

        $climbs = $thisDatabaseWriter->select($sql);

        foreach ($climbs as $climb) {
            print '<tr onclick="showModal(' . $climb['fldRank'] . ')" id="' . $climb['fldRank'] . '">'; //include mouse click display image/description and links to vids
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
            printModal($climb, $thisDatabaseWriter);
        }
		?>
        </tbody>
        </table>
        
        <form method="post">
            <input id="button" type="submit" value="Save"><br><br>
	    </form>

        <?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$arrays = json_decode($_POST['idsJSON'], true);   
     foreach($arrays as $name) {
         printf($name);
     }
	// if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

	// 	//read from database
	// 	$query = "SELECT `fldPassword` FROM tblUser WHERE pmkUsername = ? limit 1";
	// 	$value = array($user_name);
	// 	echo $databaseWriter->displayQuery($query, $value);
	// 	$result = $databaseWriter->select($query, $value);

	// 	if ($result && $result[0]['fldPassword'] === $password) {
	// 		$_SESSION['id'] = $user_name;
	// 		header("Location: profile.php");
	// 		die;
	// 	}

	// 	echo "wrong username or password!";
	// } else {
	// 	echo "invalid username or password";
	// }
}

?>



	
</section>

<script type="text/javascript">
    $( ".row_drag" ).sortable({
        delay: 100,
        stop: function() {
            var selectedRow = new Array();
            $('.row_drag>tr').each(function() {
                selectedRow.push($(this).attr("id"));
            });
           alert(selectedRow);
        }
    });
</script>

<script>
var table, rows, switching, i, x, name, id;
table = document.getElementById("dndTable");
rows = table.rows;
var ids = new Array();
var names = new Array();
for (i = 1; i < (rows.length); i++) {
    id = rows[i].getElementsByTagName("td")[0];
    id = id.innerText;
    id = parseInt(id);
    ids.push(id);
    var idsJSON = JSON.stringify(ids);

    name = rows[i].getElementsByTagName("td")[2];
    name = name.innerText;
    names.push(name);
    var namesJSON = JSON.stringify(names)
}
</script>