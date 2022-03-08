<section class="tab">
	<div>
		<?php
		$sqlSessions = 'SELECT `pmkSessionId` FROM `tblSession` WHERE `fpkUsername` = "' . $user_data[0]['pmkUsername'] . '" ORDER BY `pmkSessionId`';
		$sessionList = $databaseWriter->select($sqlSessions);
		$counter = 1;
		$idCounter = 0;
		foreach ($sessionList as $sessionId) {
			if ($counter == 1) {
				$default = ' id="default"';
			} else {
				$default = '';
			}
			print '<button' . $default . ' class="tablinks" onclick="openSession(event, \'Session' . $sessionId['pmkSessionId'] . '\'); chartUpdate(' . $idCounter . ')"> Session ' . $counter . '</button>' . PHP_EOL;
			$counter++;
			$idCounter++;
		}
		print '</div><div>';

		$counter = 1;
		foreach ($sessionList as $sessionId) {
			print '<div id="Session' . $sessionId['pmkSessionId'] . '" class="tabcontent">' . PHP_EOL;
			print '<h3>Session ' . $counter . '</h3>' . PHP_EOL;
			print '<table id="sessionData">' . PHP_EOL . '<tr>' . PHP_EOL . '<th>Rep</th>' . PHP_EOL . '<th>Hold</th>' . PHP_EOL . '<th>Length</th>' . PHP_EOL . '</tr>';

			$sqlSession = 'SELECT `pmkHangId`, `fldHold`, `fldTime` FROM `tblHang` WHERE `fpkSessionId` = ' . $sessionId['pmkSessionId'];
			if (DEBUG) {
				print $databaseWriter->displayQuery($sqlSession);
			}
			$oneSession = $databaseWriter->select($sqlSession);
			$repCounter = 1;

			foreach ($oneSession as $hang) {
				print '<tr>';
				print '<td>' . $repCounter . '</td>';
				print '<td>' . $hang['fldHold'] . '</td>';
				print '<td>' . $hang['fldTime'] . '</td>';
				print '</tr>' . PHP_EOL;
				$repCounter++;
			}
			$counter++;
			print '</table>';
			print '</div>';
		}
		print "<script>" . PHP_EOL;
		include "../static/tableTabs.js";
		include "../static/chartUpdate.js";
		print PHP_EOL . "</script>";
		?>
</section>
<script>
	document.getElementById("default").click();
</script>
