<?php
include 'top.php';
include 'modal.php';
$user_data = check_login($dbUsername, $dbName);

if (isset($_POST['btnCreateTable'])) {
    if (DEBUG) {
        print '<p>POST array:</p><pre>';
        print_r($_POST);
        print '</pre>';
    }

    $listName = filter_var($_POST['txtListName']);
    $username = filter_var($_POST['hidUsername']);

    $sql = 'INSERT INTO tblLists SET ';
    $sql .= 'fnkUsername = ?, ';
    $sql .= 'fldListName = ?';

    $data = array();
    $data[] = $username;
    $data[] = $listName;

    if (DEBUG) {
        print $thisDatabaseWriter->displayQuery($sql, $data);
    }
    if (!$thisDatabaseWriter->insert($sql, $data)) {
        print "Can't Create List";
    }
}
?>

<section class='userinfo'>
    <?php
    print '<h3 class="userinfo">' . $user_data[0]['fldFirstName'] . ' ' . $user_data[0]['fldLastName'] . '</h3>';
    print '<p class="userinfo">' . $user_data[0]['fldAge'] . ' years old';
    ?>
</section>
<section>
    <form action="<?php print PHP_SELF ?>" id="frmCreateTable" method="post">
        <h3>Create a New Table</h3>
        <input id="crtTable" type="text" name="txtListName">
        <input id="crtTable" type="hidden" name="hidUsername" value=<?php print $user_data[0]['fldUsername']; ?>>
        <input name="btnCreateTable" id="button" type="submit" value="submit">
    </form>
</section>
<section class="tab">
    <?php
    $sql = 'SELECT * FROM tblLists JOIN tblUsers ON fldUsername = fnkUsername WHERE fldUsername = "' . $user_data[0]['fldUsername'] . '"';
    if (DEBUG) {
        print $thisDatabaseWriter->displayQuery($sql);
    }
    $lists = $thisDatabaseWriter->select($sql);
    $counter = 1;
    print '<div>';
    foreach ($lists as $list) {
        if ($counter == 1) {
            $default = ' id="default"';
        } else {
            $default = '';
        }
        print '<button' . $default . ' class="tablinks" onclick="showTable(event, \'List' . $list['pmkListId'] . '\')">' . $list['fldListName'] . '</button>' . PHP_EOL;
        $counter++;
    }
    print '</div>';

    foreach ($lists as $list) {
        $listId = $list['pmkListId'];
        print '<section id="List' . $listId . '" class="tabcontent">';

        $sql = 'SELECT * FROM top100 JOIN tblLists ON pmkListId = fnkListId WHERE fnkListId = ' . $listId . ' ORDER BY fldRank ASC';
        if (DEBUG) {
            print $thisDatabaseWriter->displayQuery($sql);
        }
        $list = $thisDatabaseWriter->select($sql);

        foreach ($list as $climb) {
            printModal($climb);
        }

        print '<table id="mainTable">';
        print '<tr>';
        print '<th id="rank" onclick="sortByRank()">Rank</th>';
        print '<th id="grade" onclick="sortByHardest()">Grade</th>';
        print '<th>Name</th>';
        print '<th>Location</th>';
        print '<th>Uncontrived</th>';
        print '<th>Obvious Start</th>';
        print '<th>Good Rock</th>';
        print '<th>Flat Landing</th>';
        print '<th>Tall</th>';
        print '<th>Beautiful setting</th>';
        print '<th>Final Rating</th>';
        print '</tr>';



        foreach ($list as $climb) {
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
            print '</tr>';
        }
        print '</table>';
        print '<a href = profileEdit.php?tbl=' . $listId . '><button>Edit List</button></a>';
        print '</section>';
    }
    ?>
</section>
<?php
include "footer.php";
?>