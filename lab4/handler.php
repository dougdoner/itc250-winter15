<?php

//includes mysql connection info
require('../includes/connect.php');

//selects all data from wn15_favs table and returns a json object to be handled by the browser
function getData($mysql)
{
    $sql = 'SELECT * FROM wn15_favs ORDER BY DateAdded DESC';

    $prepared = $mysql->prepare($sql);

    $prepared->execute();

    $results = $prepared->get_result();

    $json = array();

    foreach ($results as $r)
    {
        //for each row that is returned, store that row as an array in the $json[] array
        $json[] = $r;
    }

    echo json_encode($json);
}

function insertData($mysql)
{
    $favName = "";
    $favURL = "";
    if (isset($_POST["FavName"]))
    {
        $favName = htmlentities($_POST["FavName"]);
    }
    if (isset($_POST["FavURL"]))
    {
        $favURL = htmlentities($_POST["FavURL"]);
    }

    $sql = "INSERT INTO wn15_favs VALUES(NULL, ?, NOW(), ?)";

    $prepared = $mysql->prepare($sql);
    $prepared->bind_param("ss", $favURL, $favName);
    $prepared->execute();
}

//checks if post or get
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    insertData($mysql);
}
else if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    getData($mysql);
}

