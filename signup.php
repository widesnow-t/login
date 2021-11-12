<?php
require_once __DIR__ . '/functions.php';

$email = '';
$name = '';
$password = '';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $name = filter_input(INPUT_POST, 'name');
    $password = filter_input(INPUT_POST, 'password');

    $errors = signupValidate($email, $name, $password);

    if (empty($errors)) {
        insertUser($email, $name, $password);

        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang = "ja">

<?php include_once __DIR__ . '/_head.html' ?>


<body>
    <div class="wrapper">
        <h1 class="title">Sing UP</h1>
        <?php if ($errors): ?>
            <ul class="errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= h($error) ?></li>
                <?php endforeach; ?>
        <?php endif; ?>
            </ul>
        <form action="" method="post">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" placeholder="Email" value="<?= h($email) ?>">
            <label for="name">ユーザー名</label>
            <input type="text" name="name" id="name" placeholder="UserName" value="<?= h($name) ?>">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" placeholder="Password">
            <div class="btn-area">
                <input type="submit" value="新規登録" class="btn submit-btn">
                <a href="login.php" class="btn link-btn">ログインはこちら</a>
            </div>
        </form>
    </div>
</body>