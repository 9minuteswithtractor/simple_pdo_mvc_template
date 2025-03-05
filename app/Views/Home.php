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

<body style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100vw;">
    <div style="display: flex; align-items: center; justify-content: center; width: 70vw; ">
        <h1><em>Read</em> and <em>write</em> about topics that <u>matter</u> to You!</h1>
    </div>
    <?= '<pre>' ?>

    <div style="display: flex; border: 2px solid black;padding: 0.1rem; width: 70vw;">
        <input type="button" value="toggle_session_info" onclick="document.querySelector('p').toggleAttribute('hidden')" style="cursor: pointer; padding: 0.5rem; border-radius: 5px; font-size: medium;">
        <input type="button" value="clear_session" onclick=window.location.reload();<?= session_destroy(); ?> style="cursor: pointer; padding: 0.5rem; border-radius: 5px; font-size: medium;">
        <p hidden style="margin: 50px 50px;"><?= print_r($info) ?></p>
    </div>
    <h2>Hello, <span style="color:green;"><?= htmlspecialchars($user) ?></span>!</h2>
    <h2><span style="color:darkorange;">></span> Latest content {</h2>
    <ul>
        <?php foreach ($posts as $post) : ?>
            <div style="border: 2px solid black; padding: 25px;">
                <li>
                    <a href="/posts/<?= $post['id'] ?>"><?= htmlspecialchars($post['title']); ?></a>
                    <p><?= htmlspecialchars($post['content']); ?></p>
                    <p><?= htmlspecialchars($post['date_created']); ?></p>
                    <hr>


                </li>
            </div>
        <?php endforeach; ?>

    </ul>
    <h2>}</h2>
</body>

</html>