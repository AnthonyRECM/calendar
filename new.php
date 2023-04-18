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
        
    ?>
    <?php
        $selected_date = new DateTime();//->format('d/m/Y'); 
    ?>
    <a href="/"><-</a>
    <br>
    <form action="/upload_event.php" method="post">
        Date: <input type="datetime" name="time" id="time">
        <br>
        Duration: <input type="text" name="duration" id="duration">
        <input type="submit" value="submit">
    </form>
</body>
<?php
function weekday($weekday, $date) {
    echo $weekday;
}
?>
</html>