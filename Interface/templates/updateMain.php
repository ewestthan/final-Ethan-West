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
include 'updateForm.php';

function printModal($id, $thisDatabaseWriter){
    $sql = 'SELECT * FROM top100 WHERE fldRank = "' . $id . '"';
        
    if (DEBUG) {
        print $thisDatabaseWriter->displayQuery($sql);
    }

    $climb = $thisDatabaseWriter->select($sql);

    print '<div id="myModal' . $climb[0]['fldRank'] . '" class="modal">';
    print '<div class="modal-content">';
    print '<span class="close">&times;</span>';
    print '<p>' . $climb[0]['fldName'] . '</p>';
    print '</div></div>';
    print '</tr>' . PHP_EOL;
}
?>

<section class="tab">
    <h1>Eric's Top 100 double digits</h1>
    
    <table id="dndTable">
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

        $sql = 'SELECT * FROM top100 ORDER BY fldRank ASC';
        
        if (DEBUG) {
            print $thisDatabaseWriter->displayQuery($sql);
        }

        $climbs = $thisDatabaseWriter->select($sql);

        foreach ($climbs as $climb) {
            $rank = $climb['fldRank'];
            $grade = $climb['fldGrade'];
            $name = $climb['fldName'];
            $location = $climb['fldLocation'];
            $uncontrived = $climb['fldUncontrived'];
            $obvious = $climb['fldObviousStart'];
            $goodRock = $climb['fldGoodRock'];
            $flatLanding = $climb['fldFlatLanding'];
            $tall = $climb['fldTall'];
            $goodSetting = $climb['fldGoodSetting'];

            $saveData = true;
        print '<tr>';
        print '<form action="' . PHP_SELF . '" id="frmUpdate" method="post">';
            print '<td>' . $rank . '</td>';
            print '<td class="textbox">';
                print '<input type="text" id="txtGrade" name="txtGrade" value="' . $grade . '" tabindex="300">';
            print '</td>';
            print '<td class="textbox">';
                print '<input type="text" id="txtName" name="txtName" value="' . $name . '" tabindex="300">';
            print '</td>';
            print '<td class="textbox">';
                print '<input type="text" id="txtLocation" name="txtLocation" value="' . $location . '" tabindex="300">';
            print '</td>';
            print '<td class="checkbox">';
                print '<input type="checkbox" id="chkUncontrived" value ="1" name="chkUncontrived" '; 
                if($uncontrived == 1) print 'checked'; 
                print ' tabindex="500">';
            print '</td>';
            print '<td class="checkbox">';
            print '<input type="checkbox" id="chkObvious" value ="1" name="chkObvious" ';
            if($obvious == 1) print 'checked'; 
            print ' tabindex="500">';
            print '</td>';
            print '<td class="checkbox">';
                print '<input type="checkbox" id="chkGoodRock" value ="1" name="chkGoodRock" ';
                if($goodRock == 1) print 'checked'; 
                print ' tabindex="500">';
            print '</td>';
            print '<td class="checkbox">';
                print '<input type="checkbox" id="chkFlatLanding" value ="1" name="chkFlatLanding" ';
                if($flatLanding == 1) print 'checked'; 
                print ' tabindex="500">';
            print '</td>';
            print '<td class="checkbox">';
                print '<input type="checkbox" id="chkTall" value ="1" name="chkTall" ';
                if($tall == 1) print 'checked'; 
                print ' tabindex="500">';
            print '</td>';
            print '<td class="checkbox">';
                print '<input type="checkbox" id="chkGoodSetting" value ="1" name="chkGoodSetting" ';
                if($goodSetting == 1) print 'checked';
                print ' tabindex="500">';
            print '</td>';
            print '<td>
                <p><input type="submit" value="Submit" tabindex="999" name="btnSubmit"></p>
            </td>
            </form>
            </tr>';
        }

        if(isset($_POST['btnSubmit'])){
            if(DEBUG){
                print '<p>POST array:</p><pre>';
                print_r($_POST);
                print'</pre>';
            }
            
            $grade = filter_var($_POST['txtGrade'], FILTER_SANITIZE_EMAIL);
            $name = filter_var($_POST['txtName']);
            $location = filter_var($_POST['txtLocation']);
            $uncontrived = getData('chkUncontrived');
            $obvious = getData('chkObvious');
            $goodRock = getData('chkGoodRock');
            $flatLanding = getData('chkFlatLanding');
            $tall = getData('chkTall');
            $goodSetting = getData('chkGoodSetting');
        
            if(!filter_var($grade)){
                print '<p class="mistake">Please enter a valid grade.</p>';
                $saveData = false;
            }
            if(!filter_var($name)){
                print '<p class="mistake">Please enter a valid name.</p>';
                $saveData = false;
            }
            if(!filter_var($location)){
                print '<p class="mistake">Please enter a valid location.</p>';
                $saveData = false;
            }
            
            
            if($saveData){
                $sql = 'INSERT INTO tblTop100 SET ';
                $sql .= 'fldRank = ?, ';
                $sql .= 'fldGrade = ?, ';
                $sql .= 'fldName = ?, ';
                $sql .= 'fldLocation = ?, ';
                $sql .= 'fldUncontrived = ?, ';
                $sql .= 'fldObviousStart = ?, ';
                $sql .= 'fldGoodRock = ?, ';
                $sql .= 'fldFlatLanding = ?, ';
                $sql .= 'fldTall = ?, ';
                $sql .= 'fldGoodSetting = ?';
        
                $sql .= ' ON DUPLICATE KEY UPDATE ';
                $sql .= 'fldGrade = ?, ';
                $sql .= 'fldName = ?, ';
                $sql .= 'fldLocation = ?, ';
                $sql .= 'fldUncontrived = ?, ';
                $sql .= 'fldObviousStart = ?, ';
                $sql .= 'fldGoodRock = ?, ';
                $sql .= 'fldFlatLanding = ?, ';
                $sql .= 'fldTall = ?, ';
                $sql .= 'fldGoodSetting = ?';
        
                $data = array();
                $data[] = $rank;
                $data[] = $grade;
                $data[] = $name;
                $data[] = $location;
                $data[] = $uncontrived;
                $data[] = $obvious;
                $data[] = $goodRock;
                $data[] = $flatLanding;
                $data[] = $tall;
                $data[] = $goodSetting;
        
                $data[] = $grade;
                $data[] = $name;
                $data[] = $location;
                $data[] = $uncontrived;
                $data[] = $obvious;
                $data[] = $goodRock;
                $data[] = $flatLanding;
                $data[] = $tall;
                $data[] = $goodSetting;
        
                if(DEBUG){
                    print $thisDatabaseWriter->displayQuery($sql, $data);
                }
        
                if($thisDatabaseWriter->insert($sql, $data)){
                    print 'Updated!';
                }
            }
        }
		?>
        </table>





<!-- <?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$arrays = json_decode($_POST['idsJSON'], true);   
     foreach($arrays as $name) {
         printf($name);
     }
	if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

		//read from database
		$query = "SELECT `fldPassword` FROM tblUser WHERE pmkUsername = ? limit 1";
		$value = array($user_name);
		echo $databaseWriter->displayQuery($query, $value);
		$result = $databaseWriter->select($query, $value);

		if ($result && $result[0]['fldPassword'] === $password) {
			$_SESSION['id'] = $user_name;
			header("Location: profile.php");
			die;
		}

		echo "wrong username or password!";
	} else {
		echo "invalid username or password";
	}
}

?> -->



	
</section>

<script type="text/javascript">
    $( ".row_drag" ).sortable({
        delay: 100,
        stop: function() {
            var selectedRow = new Array();
            $('.row_drag>tr').each(function() {
                selectedRow.push($(this).attr("id"));
            });
        }
    });
</script>