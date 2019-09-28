function createCharacter(){

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var result = xhttp.responseText;
            document.getElementById("result").innerHTML = result;
        }
    }

    xhttp.open("GET", "displayInfo.php", true);
    xhttp.send();
}