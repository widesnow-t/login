<?php
require_once __DIR__ . '/config.php';

function connectDb()
{
    try{
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
    exit;
    }
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES,'UTF-8');
}

function signupValidate($email, $name, $password)
{
    $errors = [];
    if (empty($email)) {
        $errors[] = MSG_EMAIL_REQUIRED;
    }

    if (empty($name)) {
        $errors[] = MSG_NAME_REQUIRED;
    }

    if (empty($password)) {
        $errors[] = MSG_PASSWORD_REQUIRED;
    }

    return $errors;
}

function insertUser($email, $name, $password)
{

    $dbh = connectDb();

    $sql = <<<EOM
    INSERT INTO
        users
        (email, name, password)
    VALUES
        (:email, :name, :password);
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    // パスワードのハッシュ化
    $pw_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $pw_hash, PDO::PARAM_STR);

    $stmt->execute();
}

function loginValidate($email, $password)
{
    $errors = [];

    if (empty($email)) {
        $errors[] = MSG_EMAIL_REQUIRED;
    }

    if (empty($password)) {
        $errors[] = MSG_PASSWORD_REQUIRED;
    }

    return $errors;
}
function findUserByEmail($email)
{
    $dbh = connectDb();

    $sql = <<<EOM
    SELECT
        *
    FROM
        users
    WHERE
        email = :email;
    EOM;
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function findUserById($id)
{
    $dbh = connectDb();

    $sql = <<<EOM
    SELECT
        *
    FROM
        users
    WHERE
        id = :id;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
