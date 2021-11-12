<?php

require_once __DIR__ . '/functions.php';

//セッション開始
session_start();

//ログイン判定
if (!empty($_SESSION['id'])) {
    header('Location: show.php');
    exit;
}

//初期化
$email = '';
$password = '';
//エラーチェック用の配列
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    //バリデーション
    $errors = loginValidate($email, $password);

    if (empty($errors)) {
        $user = findUserByEmail($email);

        //ログイン処理
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            header('Location: show.php');
            exit;
        } else {
            $errors[] = MSG_EMAIL_PASSWORD_NOT_MATCH;
        }
    }
}
var_dump($user);
?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body>
    <div class="wrapper">
        <h1>Log In</h1>
        <?php if ($errors): ?>
            <ul class="errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= h($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form action="" method="post">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" placeholder="Email" value="<?= h($email) ?>">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" placeholder="Password">
            <div class="btn-area">
                <input type="submit" value="ログイン" class="btn submit-btn">
                <a href="signup.php" class="btn link-btn">新規ユーザー登録はこちら</a>
            </div>
        </form>
    </div>
</body>

</html>