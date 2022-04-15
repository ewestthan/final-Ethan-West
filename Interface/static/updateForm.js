var row;
function start(){
  row = event.target;
}
function dragover(){
  var e = event;
  e.preventDefault();

  let children= Array.from(e.target.parentNode.parentNode.children);
  if(children.indexOf(e.target.parentNode)>children.indexOf(row))
    e.target.parentNode.after(row);
  else
    e.target.parentNode.before(row);
}

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

function showHideForm(rowNumber) {
    var form = document.getElementById('hiddenForm' + rowNumber);
    var button = document.getElementById('addButton' + rowNumber);
    let span = document.getElementById("close" + rowNumber);

    if (form != null) {
        if (form.style.display == "table-row") {
            form.style.display = 'none';
            button.style.display = 'block';
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