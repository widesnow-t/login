<?php

//セッション開始
session_start();

//ログイン判定
if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<?php include_once __DIR__ . '/_head.html'; ?>

<body>
    <div class="wrapper">
        <h1 class="title">Member Only</h1>
        <h2 class="sub-title">テストユーザーさん ようこそ！</h2>
        <p class="info">登録したユーザーのみ閲覧可能なページです</p>
        <div class="btn-area">
            <a href="" class="btn log-out-btn">ログアウト</a>
        </div>
    </div>
</body>

</html>