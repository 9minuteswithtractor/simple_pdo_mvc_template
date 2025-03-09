<?php

use App\Core\Helper;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// ::_.-._.-._.-._.-._.-._._.-._-._.-._.-.-._.-.::___ISSUE
// BUG => cannot unset $_COOKIE['session_token'] -> see Helper::destroySession
// ::_.-._.-._.-._.-._.-._._.-._-._.-._.-.-._.-.::___end_ISSUE


// TODO Auth [Holy] : =>   

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
            width: min-content;

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

    <div style="display: flex; border: 2px solid black;padding: 0.1rem; width: 70vw;">
        <input type="button" value="toggle_session_info" onclick="document.querySelector('p').toggleAttribute('hidden')" style="cursor: pointer; padding: 0.5rem; border-radius: 5px; font-size: medium;">
        <input type="button" value="clear_session" onclick="destroySession();" style="cursor: pointer; padding: 0.5rem; border-radius: 5px; font-size: medium;">
        <p hidden style="margin: 50px 50px;"><?= print_r($info) ?></p>
    </div>
    <div style="display: flex; padding: 0.1rem; width: 70vw; align-items: center; justify-content: space-between;">
        <h2>Hello, <span style="color:green; "><?= htmlspecialchars($user) ?></span>!</h2>



        <button type="button" style="padding: 12px 24px; cursor: pointer; border: 1px solid #000000; background-color: #D3D3D3; color: #000000; font-size: 16px; border-radius: 5px; transition: background-color 0.3s ease; " onclick=login();>Login</button>
    </div>

    <h2 class="title"><span style="background-color: black; color: white; padding: 5px; border-radius: 5px; ">></span> Latest content</h2>

    <div class="content" style="border: 2px solid black; padding: 25px;">
        <ul style="list-style: none;">
            <?php foreach ($posts as $post) : ?>

                <li>
                    <form action="<?php '/posts'; ?>" method="DELETE" onsubmit="return confirm('Your post is going to be deleted ...'); <?php  ?> ">
                        <a href="/posts/<?= $post['id'];
                                        ?>"><?= htmlspecialchars($post['title']); ?></a>
                        <p><?= htmlspecialchars($post['content']); ?></p>
                        <p><em><strong>author</strong></em> : <span style="color: green; font-weight: bold;"><?= htmlspecialchars($post['author']); ?></span></p>
                        <p><em>date_created</em>: <?= htmlspecialchars($post['date_created']); ?></p>
                        <?php if ($user === $post['author']):  ?>
                            <input type="submit" name="<?= $post['id']; ?>" value="delete" style="cursor: pointer;">
                        <?php endif; ?>
                        <hr>
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
                    alert('Session cleared and cookies destroyed!');
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
                    confirm('You are now logged in');
                })
                .catch(error => {
                    console.error('There was an error logging in:', error);
                });
        }
    </script>
</body>

</html>