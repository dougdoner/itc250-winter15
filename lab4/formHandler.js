function displayJSON(jsonObj)
{
    //parses the JSON object into a JavaScript array
    var obj = JSON.parse(jsonObj);
    var tBody = $('.displayTable tbody');
    tBody.empty();
    for (var i = 0; i < obj.length; i++)
    {
        var displayString = '<tr>' + '<td>' + obj[i].FavName + '</td>' +
            '<td><a href="' + obj[i].FavURL + '">' + obj[i].FavURL + '</a></td>' +
            '<td>' + obj[i].DateAdded + '</td>' + '</tr>';
        tBody.append(displayString);
    }
}

function displayData()
{
    $.ajax({
        type: 'get',
        url: "handler.php"
    })
        .done(function(data) {
            displayJSON(data);
        });
}

$('.favForm').submit(function(event) {
    //prevents the page or form from default behavior of posting the form to itself
    event.preventDefault();
    $.ajax({
        type: 'post',
        url: "handler.php",
        data: $(".favForm").serializeArray()
    })
        .done(function(data) {
            displayData();
        });
});

$(document).ready(function()
{
    displayData();
});
