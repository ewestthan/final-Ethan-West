<?php 
include 'top.php';
$user_data = check_login($dbUsername, $dbName);

$listId = isset($_GET['tbl']) ? (int) htmlspecialchars($_GET['tbl']) : 0;
//validate record exists
if(isset($_POST['hidListId'])){
    $listId = (int) htmlspecialchars($_POST['hidListId']);
}

$sql = 'SELECT * FROM tblLists WHERE pmkListId = "' . $listId . '"';
if (DEBUG) {
    print $thisDatabaseWriter->displayQuery($sql);
}
$list = $thisDatabaseWriter->select($sql);

function displayForm($rowNumber, $rank, $listId){
    $grade = '';
    $name = '';
    $location = '';
    $uncontrived = 0;
    $obvious = 0;
    $goodRock = 0;
    $flatLanding = 0;
    $tall = 0;
    $goodSetting = 0;
    
    print '<tr  id="hiddenForm' . $rowNumber . '" style="display:none;">';
    print '<form action="' . PHP_SELF . '" id="frmUpdate' . $rank . '" method="post">';
    print '<td>' . $rowNumber . '<span class="close" id="close' . $rowNumber . '">&times;</span></td>';
    print '<td class="textbox"><input type="text" id="txtGrade" name="txtGrade" value="' . $grade . '" tabindex="300"></td>';
    print '<td class="textbox"><input type="text" id="txtName" name="txtName" value="' . $name . '" tabindex="300"></td>';
    print '<td class="textbox"><input type="text" id="txtLocation" name="txtLocation" value="' . $location . '" tabindex="300"></td>';
    print '<td class="checkbox"><input type="checkbox" id="chkUncontrived" value ="1" name="chkUncontrived" '; 
    if($uncontrived == 1) print 'checked'; 
    print ' tabindex="500"></td>';
    print '<td class="checkbox"><input type="checkbox" id="chkObvious" value ="1" name="chkObvious" ';
    if($obvious == 1) print 'checked'; 
    print ' tabindex="500"></td>';
    print '<td class="checkbox"><input type="checkbox" id="chkGoodRock" value ="1" name="chkGoodRock" ';
        if($goodRock == 1) print 'checked'; 
        print ' tabindex="500"></td>';
    print '<td class="checkbox"><input type="checkbox" id="chkFlatLanding" value ="1" name="chkFlatLanding" ';
        if($flatLanding == 1) print 'checked'; 
        print ' tabindex="500"></td>';
    print '<td class="checkbox"><input type="checkbox" id="chkTall" value ="1" name="chkTall" ';
        if($tall == 1) print 'checked'; 
        print ' tabindex="500"></td>';
    print '<td class="checkbox"><input type="checkbox" id="chkGoodSetting" value ="1" name="chkGoodSetting" ';
        if($goodSetting == 1) print 'checked';
        print ' tabindex="500"></td>';
    print '<input type="hidden" id="hidRank" name="hidRank" value="' . $rank . '">';
    print '<input type="hidden" id="hidListId" name="hidListId" value="' . $listId . '">';
    print '<td colspan=2><p><input type="submit" value="Save" tabindex="999" name="btnUpdate"></p></td>
    </form></tr>';
}

if(isset($_POST['btnDelete'])){
    if(DEBUG){
        print '<p>POST array:</p><pre>';
        print_r($_POST);
        print'</pre>';
    }
    $climbId = filter_var($_POST['hidClimbId']);
    
    $sql = 'DELETE FROM top100 WHERE pmkClimbId = '. $climbId . ' AND fnkListId = ' . $listId;
    $data = '';
    if(DEBUG){
        print $thisDatabaseReader->displayQuery($sql, $data);
    }
    $thisDatabaseWriter->select($sql, $data);
}

if(isset($_POST['btnDeleteList'])){
    if(DEBUG){
        print '<p>POST array:</p><pre>';
        print_r($_POST);
        print'</pre>';
    }
    $listId = filter_var($_POST['hidListId']);
    
    $sql = 'DELETE FROM top100 WHERE fnkListId = ' . $listId;
    $data = '';
    if(DEBUG){
        print $thisDatabaseReader->displayQuery($sql, $data);
    }
    $thisDatabaseWriter->select($sql, $data);
    
    $sql = 'DELETE FROM tblLists WHERE pmkListId = ' . $listId;
    $data = '';
    if(DEBUG){
        print $thisDatabaseReader->displayQuery($sql, $data);
    }
    $thisDatabaseWriter->select($sql, $data);
    header("Location: profile.php");
	die;
}

if(isset($_POST['btnUpdate'])){
    if(DEBUG){
        print '<p>POST array:</p><pre>';
        print_r($_POST);
        print'</pre>';
    }
    $saveData = true;

    $rank = filter_var($_POST['hidRank']);
    $rank = filter_var($_POST['hidListId']);
    $grade = filter_var($_POST['txtGrade']);
    $name = filter_var($_POST['txtName']);
    $location = filter_var($_POST['txtLocation']);
    $uncontrived = getData('chkUncontrived');
    $obvious = getData('chkObvious');
    $goodRock = getData('chkGoodRock');
    $flatLanding = getData('chkFlatLanding');
    $tall = getData('chkTall');
    $goodSetting = getData('chkGoodSetting');
    $video = '';
    $description = '';
    $finalRating = 0;

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
        $sql = 'INSERT INTO top100 SET ';
        $sql .= 'fnkListId = ?, ';
        $sql .= 'fldRank = ?, ';
        $sql .= 'fldGrade = ?, ';
        $sql .= 'fldName = ?, ';
        $sql .= 'fldLocation = ?, ';
        $sql .= 'fldUncontrived = ?, ';
        $sql .= 'fldObviousStart = ?, ';
        $sql .= 'fldGoodRock = ?, ';
        $sql .= 'fldFlatLanding = ?, ';
        $sql .= 'fldTall = ?, ';
        $sql .= 'fldGoodSetting = ?, ';
        $sql .= 'fldImage = ?, ';
        $sql .= 'fldDescription = ?, ';
        $sql .= 'fldFinalRating = ?';


        $sql .= ' ON DUPLICATE KEY UPDATE ';
        $sql .= 'fnkListId = ?, ';
        $sql .= 'fldGrade = ?, ';
        $sql .= 'fldName = ?, ';
        $sql .= 'fldLocation = ?, ';
        $sql .= 'fldUncontrived = ?, ';
        $sql .= 'fldObviousStart = ?, ';
        $sql .= 'fldGoodRock = ?, ';
        $sql .= 'fldFlatLanding = ?, ';
        $sql .= 'fldTall = ?, ';
        $sql .= 'fldGoodSetting = ?, ';
        $sql .= 'fldImage = ?, ';
        $sql .= 'fldDescription = ?, ';
        $sql .= 'fldFinalRating = ?';

        $data = array();
        $data[] = $listId;
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
        $data[] = $video;
        $data[] = $description;
        $data[] = $finalRating;

        $data[] = $listId;
        $data[] = $grade;
        $data[] = $name;
        $data[] = $location;
        $data[] = $uncontrived;
        $data[] = $obvious;
        $data[] = $goodRock;
        $data[] = $flatLanding;
        $data[] = $tall;
        $data[] = $goodSetting;
        $data[] = $video;
        $data[] = $description;
        $data[] = $finalRating;

        if(DEBUG){
            print $thisDatabaseWriter->displayQuery($sql, $data);
        }
        if($thisDatabaseWriter->insert($sql, $data)){
            print 'Updated!';
        }
        else{
            print "Couldn't update";
        }
    }
}
?>

<section>
    <h1><?php print $list[0]['fldListName'] ?></h1>
    <button type="button" onClick="showHideAddButtons()">Drag and Drop on</button>
    <table id="dndTable">
        <tr>
            <th>Rank</th>  
            <th>Grade</th>
            <th>Name</th>
            <th>Location</th>
            <th>Uncontrived</th>
            <th>Obvious Start</th>
            <th>Good Rock</th>
            <th>Flat Landing</th>
            <th>Tall</th>
            <th>Beautiful setting</th>
            <th colspan=2></th>
        </tr>
		<?php
        $sql = 'SELECT * FROM top100 WHERE fnkListId = ' . $listId . ' ORDER BY fldRank ASC';
        if (DEBUG) {
            print $thisDatabaseWriter->displayQuery($sql);
        }
        $climbs = $thisDatabaseWriter->select($sql);
        $rowNumber = 1;
        $rank = 1;
        print '<tr id="addButton' . $rowNumber . '" class="addButton" style="display:none">';
        print '<td colspan=12><button onClick="showHideForm(' . $rowNumber . ')"><img src="../images/plus.png"></td>';
        print '</tr>';   
        displayForm($rowNumber, $rank, $listId);

        foreach ($climbs as $climb) {
            $rowNumber++;
            $climbId = $climb['pmkClimbId'];
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

            print '<tr draggable="true" ondragstart="start()" ondragover="dragover()">';
            print '<form action="' . PHP_SELF . '" id="frmUpdate" method="post">';
            print '<td>' . $rank . '</td>';
            print '<td class="textbox"><input type="text" id="txtGrade" name="txtGrade" value="' . $grade . '" tabindex="300"></td>';
            print '<td class="textbox"><input type="text" id="txtName" name="txtName" value="' . $name . '" tabindex="300"></td>';
            print '<td class="textbox"><input type="text" id="txtLocation" name="txtLocation" value="' . $location . '" tabindex="300"></td>';
            print '<td class="checkbox"><input type="checkbox" id="chkUncontrived" value ="1" name="chkUncontrived" '; 
            if($uncontrived == 1) print 'checked'; 
            print ' tabindex="500"></td>';
            print '<td class="checkbox"><input type="checkbox" id="chkObvious" value ="1" name="chkObvious" ';
            if($obvious == 1) print 'checked'; 
            print ' tabindex="500"></td>';
            print '<td class="checkbox"><input type="checkbox" id="chkGoodRock" value ="1" name="chkGoodRock" ';
                if($goodRock == 1) print 'checked'; 
                print ' tabindex="500"></td>';
            print '<td class="checkbox"><input type="checkbox" id="chkFlatLanding" value ="1" name="chkFlatLanding" ';
                if($flatLanding == 1) print 'checked'; 
                print ' tabindex="500"></td>';
            print '<td class="checkbox"><input type="checkbox" id="chkTall" value ="1" name="chkTall" ';
                if($tall == 1) print 'checked'; 
                print ' tabindex="500"></td>';
            print '<td class="checkbox"><input type="checkbox" id="chkGoodSetting" value ="1" name="chkGoodSetting" ';
                if($goodSetting == 1) print 'checked';
                print ' tabindex="500"></td>';
            
            print '<td><button>Edit Popup</button></td>';

            print '<input type="hidden" id="hidClimbId" name="hidClimbId" value="' . $climbId . '">';
            print '<input type="hidden" id="hidListId" name="hidListId" value="' . $listId . '">';
            print '<td><input type="submit" value="Update" tabindex="999" name="btnUpdate">';
            print '<input type="submit" value="Delete" tabindex="999" name="btnDelete"></td>
            </form>
            </tr>';
            // print '<div id="myModal' . $climb['fldRank'] . '" class="modal">';
            //     print '<div class="modal-content">';
            //         print '<h3>' . $climb['fldName'] . '</h3>';            
            //         print '<span class="close">&times;</span>';
            //         print '<section class="flex-container">';
            //             print '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"></iframe>';
            //             print '<p>' . $climb['fldDescription'] . '</p>';
            //         print '</section>';
            // print '</div></div>';
            // print '</tr>' . PHP_EOL;
            
            $rowNumber++;
            $rank++; 
            
            print '<tr id="addButton' . $rowNumber . '" class="addButton" style="display:none">';
            print '<td colspan=12><button onClick="showHideForm(' . $rowNumber . ')"><img src="../images/plus.png"></td>';
            print '</tr>';     
            displayForm($rowNumber, $rank, $listId);
        }
        ?>
    </table>
    <form action="<?php print PHP_SELF?>" id="frmDelete" method="post">
        <input type="hidden" id="hidListId" name="hidListId" value="<?php print $listId; ?>">
        <input name="btnDeleteList" id="button" type="submit" value="Delete List">
	</form>
</section>

