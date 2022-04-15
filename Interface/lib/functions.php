<?php
function check_login($dbUsername, $dbName){
	if(isset($_SESSION['id'])){
    	$databaseWriter = new DataBase($dbUsername, 'w', $dbName);

		$id = array($_SESSION['id']);
		$query = "SELECT `pmkUsername` FROM tblUsers WHERE `pmkUsername` = ? limit 1";
		print $databaseWriter->displayQuery($query, $id);
		$result = $databaseWriter->select($query, $id);
		if($result) {
			$query = "SELECT * FROM tblUsers WHERE `pmkUsername` = ?";
			$user_data = $databaseWriter->select($query, $id);
			return $user_data;
		}
	} 
	else{
		return false;
	}
}

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


//Get trim and sanatize data
function getData($field)
{
	if (!isset($_POST[$field])) {
        $data = 0;
    } else {
        $data = htmlspecialchars(trim($_POST[$field]));
    }
    return $data;
} 


function verifyAlphaNum($testString){
    return(preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}
?>