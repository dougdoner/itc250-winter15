<?php
/*
    itc 250 winter 2015
    lab 2
    Author: Douglas Doner
    Date: 1/21/2015
*/
if (($_POST)) {
    if (!empty($_POST["toppings"])) {
        $toppingsArray = $_POST["toppings"];

        if (count($_POST["toppings"]) > 1) {
            $lastArrayValue = end($toppingsArray);

            $lastArrayIndex = count($toppingsArray) - 1;
            unset($toppingsArray[$lastArrayIndex]);
            $outputToppings = implode(", ", $toppingsArray);

            $outputToppings = $outputToppings . " and " . $lastArrayValue;

            echo "Your toppings: " . $outputToppings;
            die;

        } else {
            echo "Toppings: " . $toppingsArray [0];
            die;
        }
    } else {
        echo "Please select at least one topping.";
        die;
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ITC 250 | Monday Sundae</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        <div class="form">
            <h2>Order some toppings!</h2>
            <form class="inputForm">
                <p><input class="checkBox" type="checkbox" name="toppings[]" value="Peanuts">Peanuts</p>
                <p><input class="checkBox" type="checkbox" name="toppings[]" value="Strawberries">Strawberries</p>
                <p><input class="checkBox" type="checkbox" name="toppings[]" value="Caramel">Caramel</p>
                <p><input class="checkBox" type="checkbox" name="toppings[]" value="chocolate">Chocolate</p>
                <p><input class="checkBox" type="checkbox" name="toppings[]" value="Tabasco">Tabasco</p>
                <p><input class="checkBox" type="checkbox" name="toppings[]" value="Kimchi">Kimchi</p>

                <input type="submit" value="order toppings">
            </form>
            <p class="outputP"></p>
        </div>
    </body>
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script>
        //when the user submits the form, jquery.ajax sends the values of the form in an array to the post.php script. The .done method is triggered when the post.php script successfully returns a value (in this case an echo string).
        $('.inputForm').submit(function(event) {
            //prevents the page or form from default behavior of posting the form to itself
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: "index.php",
                data: $(".inputForm").serializeArray()
            })
                .done(function(data) {
                    $(".outputP").text(data);
                })
        });
    </script>
</html>
