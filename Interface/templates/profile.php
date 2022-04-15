<?php
include 'top.php';
include 'modal.php';
session_start();
$user_data = check_login($dbUsername, $dbName);

if(isset($_POST['btnCreateTable'])){
    if(DEBUG){
        print '<p>POST array:</p><pre>';
        print_r($_POST);
        print'</pre>';
    }

    $listName = filter_var($_POST['txtListName']);
    $username = filter_var($_POST['hidUsername']);
    
    print $listName;
    print $username;
    $sql = 'INSERT INTO tblLists SET ';
    $sql .= 'fnkUsername = ?, ';
    $sql .= 'fldListName = ?';

    $data = array();
    $data[] = $username;
    $data[] = $listName;

    if(DEBUG){
        print $thisDatabaseWriter->displayQuery($sql, $data);
    }
    if($thisDatabaseWriter->select($sql, $data)){
        header("Location: profileEdit.php?tbl=" . $listId);
        exit();
    }
}
?>

<h2>Welcome back <?php echo $user_data[0]['pmkUsername']; ?></h2>
<section class='userinfo'>
<?php
print '<h3 class="userinfo">' . $user_data[0]['fldFirstName'] . ' ' . $user_data[0]['fldLastName'] . '</h3>';
print '<p class="userinfo">' . $user_data[0]['fldAge'] . ' years old';
?>


<button href='updateMain.php'>Create New</button>
<form action="<?php print PHP_SELF?>" id="frmCreateTable" method="post">
        <label for="txtListName" id="label">Name</label>
		<input id="text" type="text" name="txtListName">
        <p><input id="text" type="hidden" name="hidUsername" value=<?php print $user_data[0]['pmkUsername']; ?>></p>
		<input name="btnCreateTable" id="button" type="submit" value="submit">
</form>

<section class="tab">
    <h1>My list</h1>
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

        $sql = 'SELECT * FROM top100 JOIN tblLists ON pmkListId = fnkListId JOIN tblUsers ON pmkUsername = fnkUsername WHERE pmkUsername = "' . $user_data[0]['pmkUsername'] . '"';
        
        if (DEBUG) {
            print $thisDatabaseWriter->displayQuery($sql);
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
            printModal($climb);
        }
        print '</table>';
		?>
</section>
</section>
</body>
</html>