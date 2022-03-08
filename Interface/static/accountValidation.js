function checkname(){
    var name=document.getElementById( "txtUsername" ).value;	
    if(name){
        $.ajax({
            type: 'post',
            url: 'checkdata.php',
            data: {
            user_name:name,
            },
            success: function (response) {
                $( '#name_status' ).html(response);
                if(response=="OK"){
                    return true;	
                }
                else{
                    return false;	
                }
            }
        });
    }
        else{
            $( '#name_status' ).html("");
            return false;
        }
}

function checkemail(){
    var email=document.getElementById( "txtEmail" ).value;
        
    if(email){
        $.ajax({
            type: 'post',
            url: 'checkdata.php',
            data: {
            user_email:email,
            },
            success: function (response) {
                $( '#email_status' ).html(response);
                if(response=="OK")	{
                    return true;	
                }
                else{
                    return false;	
                }
            }
        });
    }
    else{
        $( '#email_status' ).html("");
        return false;
    }
}

function checkall(){
    var namehtml=document.getElementById("name_status").innerHTML;
    var emailhtml=document.getElementById("email_status").innerHTML;

    if((namehtml && emailhtml)=="OK"){
        return true;
    }
    else{
        return false;
    }
}

var input = document.getElementById("submit");
// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Trigger the button element with a click
    document.getElementById("submit").click();
  }
});

function showPassword() {
    var x = document.getElementById("txtPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}

var input = document.getElementById("submit");
var y = document.getElementById("txtPassword");
input.addEventListener("keyup", function(){
    y.type = 'text';
});
