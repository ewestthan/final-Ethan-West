function openSession(evt, SessionId) {
  // Declare all variables
  var i, tabcontent, tablinks, activeTab;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].className = tabcontent[i].className.replace(" activeContent", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  activeTab = document.getElementById(SessionId)
  activeTab.style.display = "block";
  activeTab.className += " activeContent";
  evt.currentTarget.className += " active";
}