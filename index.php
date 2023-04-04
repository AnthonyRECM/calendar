<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            if(session('access_token'))
            {
                $user = apiRequest($apiURLBase.'user');
                echo '<a href=""><img src="';
                echo $user->avatar_url;
                echo '" width="25px"> ';
                echo $user->login;
                echo '</a>';
            
            } else {
            echo '<a href="/application.php?action=login">Login with GitHub</a>'; 
            }
        ?>
    </nav>
</body>
</html>