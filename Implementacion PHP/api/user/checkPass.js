function checkPass()
{
    //Store the password field objects into variables ...
    var password = document.getElementById('password2');
    var confirm  = document.getElementById('confirm2');
    //Store the Confirmation Message Object ...
    var message = document.getElementById('confirm-message2');
    var button = document.getElementById('butt');
    //Set the colors we will be using ...
    var good_color = "#66cc66";
    var bad_color  = "#ff6666";
    var neutral_color = "#6a6f8c";
    var btn_color = "#1161ee";
    //Compare the values in the password field 
    //and the confirmation field
    if(password.value == confirm.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        confirm.style.backgroundColor = good_color;
        message.style.color           = good_color;
        message.innerHTML             = "Passwords Match!";
        button.style.backgroundColor  = btn_color;
        button.disabled               = false;

    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        confirm.style.backgroundColor = bad_color;
        message.style.color           = bad_color;
        message.innerHTML             = "Passwords Do Not Match!";
        button.style.backgroundColor  = neutral_color;
        button.disabled               = true;
    }
}  
