// When the user clicks on the button, open the modal
function showModal(id){
  // Get the <span> element that closes the modal
  let modal = document.getElementById("myModal" + id);
  modal.style.display = "block";
  
  let span = document.getElementsByClassName("close" + id)[0];
  // When the user clicks on <span> (x), close the modal
  span.onclick = function(event) {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
}
