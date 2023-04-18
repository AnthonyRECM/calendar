<?php

session_start();

require_once 'secrets.php';
require_once 'api.php';

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

// Prepare an insert statement
$sql = "INSERT INTO users (log_in, avatar) VALUES (?, ?)";

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_avatar);

    // Set parameters
    $param_username = $username;
    $param_avatar = $user->avatar_url;


    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to index page
        header("location: index.php");
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

?>