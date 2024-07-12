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
            
            <h1>Status Posting System</h1>

            <!-- Form for posting status -->
            <form class="postform" action="poststatusprocess.php" method="POST">
                <!-- Input field for status code -->
                <label for="stcode">Status Code:</label>
                <input type="text" name="stcode" maxlength="5"  placeholder="S####" required/> <br><br>

                <!-- Input field for status -->
                <label for="st">Status:</label>
                <input type="text" name="st" placeholder="Doing my first assignment...." required/> <br><br>

                <!-- Radio buttons for sharing options -->
                <label>Share:</label><br>
                <input type="radio" id="university" name="share" value="University" required>
                <label for="university">University</label><br>
                <input type="radio" id="class" name="share" value="Class" required>
                <label for="class">Class</label><br>
                <input type="radio" id="private" name="share" value="Private" required>
                <label for="private">Private</label><br><br>

                <!-- Input field for date -->
                <label for="date">Date:</label>
                <!-- PHP code to get current date -->
                <?php $currentDate = date('d/m/Y'); ?> 
                <input type="text" id="date" name="date" value="<?php echo $currentDate; ?>" required /><br><br>

                <!-- Checkboxes for permissions -->
                <label>Permission:</label><br>
                <input type="checkbox" id="allow_like" name="permission[]" value="Allow Like">
                <label for="allow_like">Allow Like</label><br>
                <input type="checkbox" id="allow_comments" name="permission[]" value="Allow Comments">
                <label for="allow_comments">Allow Comments</label><br>
                <input type="checkbox" id="allow_share" name="permission[]" value="Allow Share">
                <label for="allow_share">Allow Share</label><br><br>

                <!-- Submit button -->
                <input class="button" type="submit" action="submit">
            </form>
            <br>

            <!-- Link to home page -->
            <div class="links">
                <li class="link_house"><a href="index.html">Return to homepage</a></li>
            </div>
        </div>
    </body>
</html>
