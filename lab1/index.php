<?php

//if the inputTemp key exists in the global $_POST object, the user inputted value is assigned to the $tempInput variable. This is used to prevent php errors in the event of the user submitting the form with an empty string (This can also be prevented with client-side form validation).
if (isset($_POST['inputTemp'])) {
  //assigns the inputted number to the $tempInput variable
  $tempInput = $_POST['inputTemp'];
  
  //this control structure is used to determine the type of conversion formula is used. The select box passes a value of "F" or "C" when the form is submitted.
  if ($_POST['tempType'] == 'F') {
    $outputTemp = (5 / 9) * ($tempInput - 32);
  } else {
    $outputTemp = (9 / 5) * $tempInput + 32;
  }
  //number_format limits the number of places after the decimal point (for pretty numbers)
  echo " Your converted temperature is: " . number_format($outputTemp, 1);
  
  //die is used so nothing else is echo'd onto the page (including the html part of the page)
  die;
}

?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>F to C</title>
  </head>
  <body>
  
    <form class="inputForm">
      <input type="text" class="tempInputText" name="inputTemp" placeholder="Fahrenheit temp">
      <select class="tempSelect" name="tempType">
        <option value="F" selected>Fahrenheit to Celsius</option>
        <option value="C">Celsius to Fahrenheit</option>
      </select>
      <input class="button" type="submit" value="convert it">
    </form>
    <p class="outputP"></p>
  </body>
  <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script>
    
    //changes placecholder label for text input based on which select option was selected
    function changeInputPlaceholder() {
      var $this = $(this);
      var inputType = $this.find("option:selected");
      var selectTempType = inputType.attr("value");
      if (selectTempType == "F") {
        $(".tempInputText").val("");
        $(".tempInputText").attr("placeholder", "Fahrenheit temp");
      } else {
        $(".tempInputText").val("");
        $(".tempInputText").attr("placeholder", "Celsius temp");
      }

    }
    
    $(".tempSelect").change(changeInputPlaceholder);
    
    //when the user submits the form, jquery.ajax sends the values of the form in an array to the post.php script. The .done method is triggered when the post.php script successfully returns a value (in this case an echo string).
    $('.inputForm').submit(function(event) {
      $.ajax({
        type: 'post',
        url: "index.php",
        data: $(".inputForm").serializeArray()
      })
        .done(function(data) {
          $(".outputP").text(data);
        })
      //prevents the page or form from default behavior of posting the form to itself
      event.preventDefault();
    });
  </script>
</html>
