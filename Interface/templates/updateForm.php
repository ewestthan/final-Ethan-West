<?php

function displayUpdateForm($climb, $thisDatabaseWriter){
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