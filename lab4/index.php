<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ITC 250 Lab 4</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        <div class="wrap">
            <h1>Web favorites</h1>
            <p>Please enter a site name and URL below to save it here</p>
            <form class="favForm">
                <div><input type="text" placeholder="Name" name="FavName"></div>
                <div><input type="text" placeholder="URL" name="FavURL"></div>
                <input type="submit" value="Submit">
            </form>

            <table class="displayTable">
                <thead>
                <tr>
                    <th>
                        Favorite Name
                    </th>
                    <th>
                        Favorite URL
                    </th>
                    <th>
                        Date Added
                    </th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </body>
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="js/formHandler.js"></script>
</html>
