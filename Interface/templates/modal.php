
<?php
function printModal($climb)
{
    print '<div id="myModal' . $climb['pmkClimbId'] . '" class="modal">';
    print '<div class="modal-content">';
    print '<span id="close" class="close' . $climb['pmkClimbId'] . '">&times;</span>';
    print '<h3>' . $climb['fldName'] . '</h3>';
    print '<section class="flex-container">';
    print '<iframe src="https://www.youtube.com/embed/' . $climb['fldImage'] . '"></iframe>';
    print '<p id="description">' . $climb['fldDescription'] . '</p>';
    print '</section>';
    print '</div></div>';
    print '</tr>' . PHP_EOL;
}
?>