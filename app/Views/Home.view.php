<?php

use App\Core\Helper;

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
    <script src="https://cdn.jsdelivr.net/npm/axios@0.27.2/dist/axios.min.js"></script>

    <style>
        .title {
            text-transform: uppercase;


        }

        .post-content {
            font-size: larger;
            max-width: 50%
        }

        .content {
            font-size: large;
        }
    </style>


</head>

<body style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100vw;">
    <div style="display: flex; align-items: center; justify-content: center; width: 70vw; ">
        <h1><em>Read</em> and <em>write</em> about topics that <u>matter</u> to You!</h1>

    </div>

    <?= '<pre>' ?>

    <div style="width: 100%; min-width: 320px; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); display: flex; align-items: center">
        <input type="button" value="toggle_session_info" onclick="document.querySelector('p').toggleAttribute('hidden')" style="cursor: pointer; padding: 0.5rem; border-radius: 5px; font-size: medium;">
        <input type="button" value="clear_session" onclick="destroySession();" style="cursor: pointer; padding: 0.5rem; border-radius: 5px; font-size: medium;">
        <p hidden style="margin: 50px 50px;"><?= print_r($info) ?></p>
    </div>
    <div style="display: flex; padding: 0.1rem; width: 70vw; align-items: center; justify-content: space-between;">
        <h2>👋 Hello, <span style="color:green; "><?= htmlspecialchars($user) ?></span>!</h2>

        <button type="button" style="width: 90px; background: black; color: white; font-size: large; padding: 20px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); cursor: pointer;" onclick=login();>Login</button>
    </div>

    <h2 class=" title"><span style="background-color: black; color: white; width: 40px; height: 20px; padding: 5px; border-radius: 5px; "> > </span> Latest content</h2>

    <div class="content" style="width: 100%; min-width: 320px; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); ">
        <ul style="list-style: none;">
            <?php foreach ($posts as $post) : ?>
                <li style="max-height: fit-content;">
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="DELETE" onsubmit="return confirm('Your post is going to be deleted ...');">
                        <a style="font-size: larger;" href="/api/posts">
                            <?= htmlspecialchars($post['title']); ?></a>
                        <div style="width: 90%; min-width: 320px; background: #fff; color: black; padding: 20px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); ">
                            <p class="post-content"><?= htmlspecialchars($post['content']); ?></p>
                            <p><em><strong>author</strong></em> : <span style="color: green; font-weight: bold;"><?= htmlspecialchars($post['author']); ?></span></p>
                            <p><em>date_created</em>: <?= htmlspecialchars($post['date_created']); ?></p>
                            <?php if ($user === $post['author']):  ?>
                                <input type="submit" name="<?= $post['id']; ?>" value="delete" style="cursor: pointer;">
                            <?php endif; ?>
                        </div>
                    </form>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>

    <script>
        function destroySession() {
            // Send a POST request to clear the session and cookies
            axios.post('/api/clear_session')
                .then(response => {
                    // You can handle the response here if needed
                    confirm('Session cleared and cookies destroyed!');
                    // Optionally, reload the page
                    window.location.reload();
                })
                .catch(error => {
                    console.error('There was an error clearing the session:', error);
                });
        }

        function login() {
            axios.post('/api/login')
                .then(response => {
                    // You can handle the response here if needed

                    window.location.href = '/api/login';
                    // Optionally, reload the page
                    // window.location.reload();
                })
                .catch(error => {
                    console.error('There was an error clearing the session:', error);
                });
        }
    </script>
</body>

</html>