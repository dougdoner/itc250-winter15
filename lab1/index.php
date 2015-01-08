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
        url: "post.php",
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
