
<?php
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