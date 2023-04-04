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
        <a href="#">Calendar</a>
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
        $selected_date = new DateTime();//->format('d/m/Y'); 
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