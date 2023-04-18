<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Calendar</title>
</head>

<body>
    <?php
    session_start();

    require_once 'secrets.php';
    require_once 'api.php';
    ?>
    <nav>
        <a href="/">Calendar</a>
        <?php
        if (session('access_token')) {
            $user = apiRequest($apiURLBase . 'user');
            echo '<span class="profile_span"><a href="/profile.php"><img src="';
            echo $user->avatar_url;
            echo '" width="30px" style="position: relative;top: 10px;"> ';
            echo $user->name;
            echo '</a></span>';
        } else {
            echo '<a href="/application.php?action=login">Login with GitHub</a>';
        }
        ?>
    </nav>
    <?php
        if(isset($user)) {
            
            $sql = "SELECT id, avatar, created_at FROM users WHERE log_in = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $user->login;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $avatar, $created_at);
                    if (mysqli_stmt_fetch($stmt)) {
                    }
                } else {
                    header('Location: http://calendar.eeta.gg/create_db_entry.php');
                    //echo '<h1>This user could not be found?</h1>';
                }
            }
        }

        } else {
            echo "<h1>You're not logged in, <a href='/application.php?action=login'>Login with GitHub</a> </h1>";
        }
    ?>
    <?php
        $selected_date = 0;//new DateTime();//->format('d/m/Y'); 
    ?>
    <div class="container">
        <div class="Calendar" style="display:grid;grid-template-columns: repeat(7, 1fr);">
            <div>
                <?php weekday('Sunday',$selected_date) ?> 
            </div>
            <div>
                <?php weekday('Monday',$selected_date) ?>
            </div>
            <div>
                <?php weekday('Tuesday',$selected_date) ?>
            </div>
            <div>
                <?php weekday('Wednesday',$selected_date) ?>
            </div>
            <div>
                <?php weekday('Thursday',$selected_date) ?>
            </div>
            <div>
                <?php weekday('Friday',$selected_date) ?>
            </div>
            <div>
                <?php weekday('Saturday',$selected_date) ?>
            </div>
        </div>
        <div class="Values">
            <br>
            <?php echo $selected_date ?></div>
        <div class="Time"></div>
    </div>
</body>
<?php
function weekday($weekday, $date) {
    echo $weekday;
}
?>
</html>