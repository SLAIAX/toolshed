function checkUsername(str) {
    document.getElementById("error").innerHTML = "test";
    //document.getElementById("error").innerHTML = str2;

    if (str.length == 0) {
        document.getElementById("error").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("error").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", str2 + "CreateAccountController.php?q=" + str, true);

        xmlhttp.send();
    }
}