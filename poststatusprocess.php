<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="style.css">
        <title>Post a status</title>
    </head>
    <body>
    <div class="content">
    <?php

        // Including settings file and establishing database connection
        require_once("connection.php");
        $dbConnect = mysqli_connect($host, $user, $pswd);
        mysqli_select_db($dbConnect, $dbName);

        // Checking if the 'statuses' table exists, if not, creating it
        $checkIfTableExists = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'statuses'";
        $checkIfTableExistsResult = mysqli_query($dbConnect, $checkIfTableExists);
        if (mysqli_num_rows($checkIfTableExistsResult) <= 0)
        {
            $sqlCreateTable = "CREATE TABLE statuses 
            (
            status_code VARCHAR(5) NOT NULL, 
            status VARCHAR(250) NOT NULL, 
            share VARCHAR(50) NOT NULL,
            date DATE NOT NULL,
            permission VARCHAR(50) NOT NULL
            )";

            $sqlCreateTableResult = mysqli_query($dbConnect, $sqlCreateTable);
        }

        // Processing form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            // Retrieving form data
            $status_code = $_POST["stcode"];
            $status = $_POST["st"];
            $share = $_POST["share"];
            $date = $_POST["date"];
            $permission = implode(", ", $_POST["permission"]);

            // Validating status code format
            $stCodePattern = "/^S\d{4}$/";
            if (!preg_match($stCodePattern, $status_code))
            {
                // Displaying error message if status code format is invalid
                echo "<p>Invalid status code format. It must start with 'S' followed by four digits (e.g., S0001). It also cannot be blank! </p>";
                echo "<p>Please <a class=\"link_house\" href=\"poststatusform.php\">click here</a> to go back to the form page.</p>";
                exit;
            }

            // Checking if status code already exists
            $stCodeCheck = "SELECT * FROM statuses WHERE status_code LIKE '$status_code';";
            $stCodeCheckResult = mysqli_query($dbConnect, $stCodeCheck);
            if (mysqli_num_rows($stCodeCheckResult) > 0) 
            {
                // Displaying error message if status code already exists
                echo "<p>The status code already exists. Please try another one! </p>";
                echo "<p>Please <a class=\"link_house\" href=\"poststatusform.php\">click here</a> to go back to the form page.</p>";
                exit;
            }

            // Validating status format
            $stPattern = "/^[A-Za-z0-9,.\s!?]+$/";
            if (!preg_match($stPattern, $status) || ctype_space($status))
            {
                // Displaying error message if status format is invalid
                echo "<p>Invalid status format! It can only contain alphanumeric characters, spaces, commas, periods, exclamation points, and question marks, and cannot be blank! </p>";
                echo "<p>Please <a class=\"link_house\" href=\"poststatusform.php\">click here</a> to go back to the form page.</p>";
                exit;
            }

            // Validating date format
            $dateObj = DateTime::createFromFormat('d/m/Y', $date);
            if (!$dateObj || $dateObj->format('d/m/Y') !== $date) 
            {
                // Displaying error message if date format is invalid
                echo "<p>Invalid date format! Please enter a valid date in the format dd/mm/yyyy.</p>";
                echo "<p>Please <a class=\"link_house\" href=\"poststatusform.php\">click here</a> to go back to the form page.</p>";
                exit;
            }
            $date = $dateObj->format('Y-m-d');
            
            // Inserting status into the database
            $sqlInsert = "INSERT INTO statuses (status_code, status, share, date, permission) VALUES ('$status_code', '$status', '$share', '$date', '$permission')";
            mysqli_query($dbConnect, $sqlInsert);

            // Displaying success message
            echo "<p>Congratulations! The status has been posted!</p><br>";
            echo "<p>Please <a class=\"link_house\"href=\"index.html\">click here</a> to return to the Home page.</p>";
        }

        // Closing database connection
        mysqli_close($dbConnect);

    ?>
    </div>
    </body>
</html>
