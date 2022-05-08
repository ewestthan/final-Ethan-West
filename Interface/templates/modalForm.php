<?php
function printModalForm($climb)
{
    print '<div id="myModal' . $climb['pmkClimbId'] . '" class="modal">';
    print '<div class="modal-content">';
    print '<h3>Edit Description and Enter Video Link</h3>';
    print '<span class="close' . $climb['pmkClimbId'] . '>&times;</span>';
    print '<input type="text" id="txtLink" name="txtLink" value="' . $climb['fldImage'] . '" tabindex="300">';
    print '<input type="text" id="txtDescription" name="txtDescription" value="' . $climb['fldDescription'] . '" tabindex="300">';
    print '</div></div>';
}
