function validateForm()
{
    form = document.user_registration;
    var errorArray = new Array();
    focusSet = false;
    focus = null;

    if (form.username.value.length <= 3){
        errorArray.push("You need a UserName that is at least 4 character in length"); 
        setFocus('username');
    }

    if (form.password.value.length <= 3){
        errorArray.push("You need a Password that is at least 4 characters in length");
        setFocus('password'); 
    }

    if (form.FirstName.value.length <= 2 || (!form.FirstName.value.match(/^[a-zA-Z]+$/)) ){
        errorArray.push("You need a First Name longer than 2 chars, and only a-z no numbers or special chars.");
        setFocus('FirstName');
    }

    if (form.LastName.value.length <= 2 || (!form.LastName.value.match(/^[a-zA-Z]+$/)) ){
        errorArray.push("You need a Last Name longer than 2 chars, and only a-z no numbers or special chars.");
        setFocus('LastName');
    }

    if (form.PhoneNumber.value.length != 10 && (!form.PhoneNumber.value.match(/((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/))){
        errorArray.push("You need a Phone number of 10 digits, numbers only");
        setFocus('PhoneNumber');
    }

    if (form.Address.value == ""){
        errorArray.push("You need an address");
        setFocus('Address');
    }

    if (form.Zip.value == "" || isNaN(form.Zip.value) || form.Zip.value.length != 5){
        errorArray.push("You need a Zip, 0-9 numbers, only 5 digits.");
        setFocus('Zip');
    }

    if (form.City.value == ""){
        errorArray.push("You need a City");
        setFocus('City');
    }

    if (form.State.value == "--"){
        errorArray.push("Please Choose a State");
        setFocus('State');
    }

    if (form.Sex.value == ""){
        errorArray.push("Please Choose a Sex");
        setFocus('Sex');
    }

    if (errorArray.length > 0) {
        var errorReport = document.getElementById("errorlog");
        errorString = "";
        for (i = 0; i < errorArray.length; i++) {
            errorString = errorString + "-" + errorArray[i] + "\n";
        }
        alert(errorString);
        //set focus to the highest form input that is incomplete.
        document.getElementById(focus).focus();
        return false;
    }
    return(true);
}

function validateSearchForm()
{
    form = document.user_search;
    var errorArray = new Array();
    focusSet = false;
    focus = null;
    
    if(form.FirstName.value.length > 0 ){
        if (document.user_search.FirstName.value.length <= 2 
                || (!document.user_search.FirstName.value.match(/^[a-zA-Z]+$/)) ){
            errorArray.push("You need a First Name longer than 2 chars, no numbers or special chars.");
            setFocus('FirstName');
        }
    }
    
    if(document.user_search.LastName.value.length > 0 ){
        if (document.user_search.LastName.value.length <= 2 
                || (!document.user_search.LastName.value.match(/^[a-zA-Z]+$/)) ){
            errorArray.push("Last Name must be longer than 2 chars, no numbers or special chars.");
            setFocus('LastName');
        }
    }
    
    if(document.user_search.PhoneNumber.value.length > 0 ){
        if (document.user_search.PhoneNumber.value.length != 10 
                && (!document.user_search.PhoneNumber.value.match(/((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/))){
            errorArray.push("Phone number must be 10 digits, numbers only");
            setFocus('PhoneNumber');
        }
    }
    
    if(document.user_search.Zip.value.length > 0 ){
        if (isNaN(document.user_search.Zip.value) ||
                document.user_search.Zip.value.length != 5){
            errorArray.push("The zip must be only numbers and only 5 digits.");
            setFocus('Zip');
        }
    }
    
    if (errorArray.length > 0) {
        errorString = "";
        for (i = 0; i < errorArray.length; i++) {
            errorString = errorString + "-" + errorArray[i] + "\n";
        }
        alert(errorString);
        //set focus to the highest form input that is incomplete.
        document.getElementById(focus).focus();
        return false;
    }
    return(true);
}

function validateModifyUser()
{
    
    form = document.modifyUser;
    var errorArray = new Array();
    focusSet = false;
    focus = null;
    alert("hello there");
    if (form.FirstName.value.length <= 2 || (!form.FirstName.value.match(/^[a-zA-Z]+$/)) ){
        errorArray.push("You need a First Name longer than 2 chars, and only a-z no numbers or special chars.");
        setFocus('FirstName');
    }

//    if (form.LastName.value.length <= 2 || (!form.LastName.value.match(/^[a-zA-Z]+$/)) ){
//        errorArray.push("You need a Last Name longer than 2 chars, and only a-z no numbers or special chars.");
//        setFocus('LastName');
//    }
//
//    if (form.PhoneNumber.value.length != 10 && (!form.PhoneNumber.value.match(/((\(\d{3}\) ?)|(\d{3}-))?\d{3}-\d{4}/))){
//        errorArray.push("You need a Phone number of 10 digits, numbers only");
//        setFocus('PhoneNumber');
//    }
//
//    if (form.Address.value == ""){
//        errorArray.push("You need an address");
//        setFocus('Address');
//    }
//
//    if (form.Zip.value == "" || isNaN(form.Zip.value) || form.Zip.value.length != 5){
//        errorArray.push("You need a Zip, 0-9 numbers, only 5 digits.");
//        setFocus('Zip');
//    }
//
//    if (form.City.value == ""){
//        errorArray.push("You need a City");
//        setFocus('City');
//    }
//
//    if (form.State.value == ""){
//        errorArray.push("Please Choose a State");
//        setFocus('State');
//    }
//
//    if (form.Sex.value == ""){
//        errorArray.push("Please Choose a Sex");
//        setFocus('Sex');
//    }

    if (errorArray.length > 0) {
        var errorReport = document.getElementById("errorlog");
        errorString = "";
        for (i = 0; i < errorArray.length; i++) {
            errorString = errorString + "-" + errorArray[i] + "\n";
        }
        alert(errorString);
        //set focus to the highest form input that is incomplete.
        document.getElementById(focus).focus();
        return false;
    }
    return(true);
}

function validateModifyUserCreds()
{
    form = document.modifyUserCreds;
    var errorArray = new Array();
    focusSet = false;
    focus = null;
    
    if (form.username.value.length <= 3){
        errorArray.push("Your UserName must be at least 4 character in length"); 
        setFocus('username');
    }

    if (form.password.value.length <= 3 &&form.password.value.length !=0){
        errorArray.push("Your Password must be at least 4 characters in length");
        setFocus('password'); 
    }

    if (errorArray.length > 0) {
        var errorReport = document.getElementById("errorlog");
        errorString = "";
        for (i = 0; i < errorArray.length; i++) {
            errorString = errorString + "-" + errorArray[i] + "\n";
        }
        alert(errorString);
        //set focus to the highest form input that is incomplete.
        document.getElementById(focus).focus();
        return false;
    }
    return(true);
}

function setFocus(id){
    if(!focusSet){
        focusSet = true;
        focus = id;
    }
}