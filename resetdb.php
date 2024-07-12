<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="style.css">
        <title>Reset Database</title>
    </head>
    <body>
    <div class="content">
        <?php

            // Including settings file and establishing database connection
            require_once("connection.php");
            $dbConnect = mysqli_connect($host, $user, $pswd);
            mysqli_select_db($dbConnect, $dbName);

            // Checking if the reset button is clicked
            if (isset($_POST["reset"]))
            {
                // Dropping the 'statuses' table to reset the database
                $resetDb = "DROP TABLE `statuses`"; 

                // Executing the query to drop the table
                if (mysqli_query($dbConnect, $resetDb)) 
                {
                    // Displaying success message if table is dropped successfully
                    echo "<p>Database table has been reset successfully.</p>";
                    echo "<a class=\"link_house\" href=\"index.html\">Return to homepage</a>";
                } 
                else 
                {
                    // Displaying error message if table cannot be dropped
                    echo "<p>Error resetting database table. </p>";
                    echo "</p> No status found in the system. </p>";
                    echo "<p>Please go to the <a class=\"link_house\" href=\"poststatusform.php\">post status page</a> to post one.</p>";

                }
            }

            // Closing database connection
            mysqli_close($dbConnect);

        ?>
    </div>
    </body>
</html>
