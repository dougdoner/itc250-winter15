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
}
?>
