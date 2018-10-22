function checkUsername(str) {
                if (str.length == 0) {
                    document.getElementById("error").innerText = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("error").innerText = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "/accountNameValidate?q=" + str, true);

                    xmlhttp.send();
                }
            }