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
    <title>HOME | BLOG</title>
</head>

<body style="display: flex; flex-direction: column; align-items: center; justify-content: center; ">
    <h1>Welcome to simple Blog Home Page!</h1>
    <?= '<pre>' ?>

    <div style="display: flex; border: 2px solid black;padding: 0.1rem;">
        <input type="button" value="toggle_config_info" onclick="document.querySelector('p').toggleAttribute('hidden')" style="cursor: pointer; padding: 0.5rem; border-radius: 5px;">
        <input type="button" value="clear_session" onclick=window.location.reload();<?= session_destroy(); ?> style="cursor: pointer; padding: 0.5rem; border-radius: 5px;">
        <p hidden style="margin: 50px 50px;"><?= print_r($info) ?></p>
    </div>
    <h2><span style="color:darkorange;">></span> Some Blog Posts</h2>
    <ul>
        <?php foreach ($posts as $post) : ?>
            <li>
                <a href="/posts/<?= $post['id'] ?>"><?= $post['name'] ?></a>
            </li>
        <?php endforeach; ?>
    </ul>

</body>

</html>