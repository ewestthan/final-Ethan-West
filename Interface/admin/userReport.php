<?php
include 'top.php';
if (isset($_POST['btnDelete'])) {
    if (DEBUG) {
        print '<p>POST array:</p><pre>';
        print_r($_POST);
        print '</pre>';
    }
    $username = filter_var($_POST['hidUsername']);

    // $sql = 'DELETE FROM tblUsers WHERE fldUsername = '. $username . ' AND fnkListId = ' . $listId;
    // $data = '';

    // if(DEBUG){
    //     print $thisDatabaseReader->displayQuery($sql, $data);
    // }
    // $thisDatabaseWriter->select($sql, $data);


    $sql = 'DELETE FROM tblUsers WHERE fldUsername = "' . $username . '"';
    $data = '';
    if (DEBUG) {
        print $thisDatabaseWriter->displayQuery($sql, $data);
    }
    $thisDatabaseWriter->select($sql, $data);
}
?>

<main>
    <h2>Vermont's Wildlife</h2>
    <table>
        <tr>
            <th>User Name</th>
            <th>Age</th>
            <th>Number of Tables</th>
            <th></th>
        </tr>
        <?php
        $sql = 'SELECT pmkUserId, fldUsername, fldFirstName, fldLastName, fldAge FROM tblUsers';
        $data = '';
        $users = $thisDatabaseWriter->select($sql, $data);
        if (is_array($users)) {
            foreach ($users as $user) {
                print '<form action="' . PHP_SELF . '" id="frmUpdate" method="post">';
                print "<tr>";
                print "<td>" . $user['fldFirstName'] .  " " . $user['fldLastName'] . "</td>";
                print "<td>" . $user['fldAge'] .  "</td>";
                print "<td>" . sizeof($user) - 3 . "</td>";
                print '<input type="hidden" id="hidUsername" name="hidUsername" value="' . $user['fldUsername'] . '">';
                print '<td><a href="addUser.php?usr=' . $user['pmkUserId'] . '">Update</a>';
                print '<input type="submit" value="Delete" tabindex="999" name="btnDelete"></td>';
                print "</tr>";
            }
        }

        print '<tr class="addButton">';
        print '<td colspan=12><a href="addUser.php"><img src="../images/plus.png"></a></td>';
        print '</tr>';

        print '</form>';
        ?>
    </table>
</main>

<?php
include 'footer.php';
?>