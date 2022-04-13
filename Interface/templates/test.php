<?php
include "top.php";
?>

<section class="tab">
    <h1>Testing Page</h1>
    <button type="button" onClick="showHideAddButtons()">Drag and Drop on</button>
    <table>
        <tr>
            <th>Rank</th>  
            <th>Grade</th>
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

        <tr class="addButton" id='addButton' style="display:none">
          <td colspan=12><button onClick="showHideForm('hiddenForm')"><img src="../images/plus.png"></button></td>
        </tr>

        <tr id="hiddenForm" style="display: none;">
          <form action="<?php print PHP_SELF ?>" id="frmUpdate" method="post">
            <td><span class="close">&times;</span></td>
            <td class="textbox" colspan=12><input type="text" id="txtGrade" name="txtGrade" value="Grade" tabindex="300"></td>
            <td><p><input type="submit" value="Update" tabindex="999" name="btnUpdate"></p></td>
          </form>
        </tr>

        <tr class="addButton" id='addButton' style="display:none">
          <td colspan=12><button onClick="showHideForm('hiddenForm')"><img src="../images/plus.png"></button></td>
        </tr>

        <tr id="hiddenForm" style="display: none;">
          <form action="<?php print PHP_SELF ?>" id="frmUpdate" method="post">
            <td><span class="close">&times;</span></td>
            <td class="textbox" colspan=12><input type="text" id="txtGrade" name="txtGrade" value="Grade" tabindex="300"></td>
            <td><p><input type="submit" value="Update" tabindex="999" name="btnUpdate"></p></td>
          </form>
        </tr>    
    </table>
</section>

<script>
function showHideAddButtons() {
  var buttons = document.getElementsByClassName('addButton');
  for (let i = 0; i < buttons.length; i++) {
    if (buttons[i] != null) {
      if (buttons[i].style.display == "table-row") {
        buttons[i].style.display = 'none';
      }
      else{
        buttons[i].style.display = 'table-row';
      }
    }
  }
  return false;
}

function showHideForm(rank) {
         	var form = document.getElementById('hiddenForm');
          var button = document.getElementById('addButton');
          let span = document.getElementsByClassName("close")[0];
         	if (form != null) {
         		if (form.style.display == "table-row") {
         			form.style.display = 'none';
              button.style.display = 'table-row';
         		}
         		else{
         			form.style.display = 'table-row';
              button.style.display = 'none';
         		}
             span.onclick = function(event) {
                form.style.display = "none";
                button.style.display = 'table-row';
              }
         		return false;
         	}
         }
</script>