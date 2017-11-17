function update_nav_info() {

    fetch_unix_timestamp = function () {
        return parseInt(new Date().getTime().toString().substring(0, 10))
    };

    var url = "../../Functions/nav-statistics.php";
    var timestamp = fetch_unix_timestamp();
    var nocacheurl = url + "?t=" + timestamp + "&project_name=" + document.getElementById("project").innerHTML

    $.ajax({
        type: 'POST',
        url: nocacheurl,
        data: 'id=testdata',
        dataType: "text",
        cache: false,
        success: function (data) {
            document.getElementById("pending").innerHTML = data;
        }

    }); //end ajax

}