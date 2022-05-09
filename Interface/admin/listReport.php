<?php
include 'top.php';

$listId = 0;
if (isset($_POST['btnDelete'])) {
    if (DEBUG) {
        print '<p>POST array:</p><pre>';
        print_r($_POST);
        print '</pre>';
    }
    $listId = filter_var($_POST['hidListId']);

    $sql = 'DELETE FROM top100 WHERE fnkListId = ' . $listId;
    $data = '';
    if (DEBUG) {
        print $thisDatabaseWriter->displayQuery($sql, $data);
    }
    $thisDatabaseWriter->select($sql, $data);

    $sql = 'DELETE FROM tblLists WHERE pmkListId = ' . $listId;
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
            <th>List Name</th>
            <th>UserName</th>
            <th>Number of Climbs</th>
            <th></th>
        </tr>
        <?php
        $sql = 'SELECT fnkUsername, pmkListId, fldListName FROM tblLists';
        $data = '';
        $lists = $thisDatabaseWriter->select($sql, $data);
        if (is_array($lists)) {
            foreach ($lists as $list) {

                $sql = 'SELECT pmkClimbId FROM top100 WHERE fnkListId = ' . $list['pmkListId'];
                $data = '';
                $climbs = $thisDatabaseWriter->select($sql, $data);

                print '<form action="' . PHP_SELF . '" id="frmUpdate" method="post">';
                print "<tr>";
                print "<td>" . $list['fldListName'] . "</td>";
                print "<td>" . $list['fnkUsername'] .  "</td>";
                print "<td>" . sizeof($climbs) . "</td>";
                print '<input type="hidden" id="hidListId" name="hidListId" value="' . $list['pmkListId'] . '">';
                print '<td><a href="listEdit.php?tbl=' . $list['pmkListId'] . '">Update</a>';
                print '<input type="submit" value="Delete" tabindex="999" name="btnDelete"></td>';
                print "</tr>";
            }
        }

        print '<tr class="addButton">';
        print '<td colspan=12><a href="listEdit.php?tbl=0"><img src="../images/plus.png"></a></td>';
        print '</tr>';

        print '</form>';
        ?>
    </table>
</main>

<?php
include 'footer.php';
?>