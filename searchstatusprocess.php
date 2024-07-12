<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="style.css">
        <title>Search</title>
    </head>
    <body>
    <div class="content">
    <?php

        // Including settings file and establishing database connection
        require_once("connection.php");
        $dbConnect = mysqli_connect($host, $user, $pswd);
        mysqli_select_db($dbConnect, $dbName);

        
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            // Retrieving search keyword from GET request
            $search = $_GET["Search"];

            // Validating search keyword
            if (!$search || ctype_space($search))
            {
                // Displaying error message if search keyword is empty
                echo "<p>The search string is empty. Please enter a keyword to search. </p>";
                echo "<p>Please <a class=\"link_house\"href=\"searchstatusform.html\">click here</a> to go back to the search page.</p>";
                exit;
            }

            // Checking if 'statuses' table exists in the database
            $checkIfTableExists = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'statuses'";
            $checkIfTableExistsResult = mysqli_query($dbConnect, $checkIfTableExists);
            if (mysqli_num_rows($checkIfTableExistsResult) <= 0)
            {
                // Displaying message if no statuses are found
                echo "<p>No status found in the system. Please go to the <a class=\"link_house\" href=\"poststatusform.php\">post status</a> page to post one.</p>";
            }
            else
            {
                // Searching for statuses matching the search keyword
                $searchStatus = "SELECT * FROM statuses WHERE status LIKE '%$search%'";
                $searchStatusResult = mysqli_query($dbConnect, $searchStatus);
                if (mysqli_num_rows($searchStatusResult) <= 0)
                {
                    // Displaying message if no matching statuses are found
                    echo "<p>Status not found. Please try a different keyword. </p>";
                    echo "<p>Please <a class=\"link_house\" href=\"searchstatusform.html\">click here</a> to go back to the search page.</p><br><br>";
                    echo "<a class=\"link_house\" href=\"index.html\">Return to homepage</a>";
                }
                else 
                {
                    // Displaying search results
                    echo "<h3>Results matching search keyword(s):  \"$search\" </h3> <br>";

                    // Displaying each matching status
                    while ($row = mysqli_fetch_assoc($searchStatusResult))
                    {
                        echo "<p>Status Code: " . $row["status_code"] . "</p>";
                        echo "<p>Status: " . $row["status"] . "</p>";
                        echo "<p>Share: " . $row["share"] . "</p>";
                        echo "<p>Date Posted: " . $row["date"] . "</p>";
                        echo "<p>Permission: " . $row["permission"] . "</p>";
                        echo "<br><br>";
                    }

                    // Links section
                    echo "<div class=\"links\">";
                    echo "<a class=\"link_house\" href=\"searchstatusform.html\">Search for another status</a><br><br><br>";
                    echo "<a class=\"link_house\" href=\"index.html\">Return to homepage</a>";
                    echo "</div>";
                }
            }
        }

        // Closing database connection
        mysqli_close($dbConnect);
        
    ?>
    </div>
    </body>
</html>
