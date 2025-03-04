<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection Err</title>
</head>

<body style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; ">
    <h1>🚩Error 500 (failed database connection)🚩</h1>
    <p><?= $error->getMessage() ?></p>

</body>

</html>