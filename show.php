<?php

require_once __DIR__ . '/functions.php';
//セッション開始
session_start();

//ログイン判定
if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}
$current_user = findUserById($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="ja">

<?php include_once __DIR__ . '/_head.html'; ?>

<body>
    <div class="wrapper">
        <h1 class="title">Member Only</h1>
        <h2 class="sub-title"><?= h($current_user['name']) ?>さん ようこそ！</h2>
        <p class="info">登録したユーザーのみ閲覧可能なページです</p>
        <div class="btn-area">
            <a href="logout.php" class="btn log-out-btn">ログアウト</a>
        </div>
    </div>
</body>

</html>