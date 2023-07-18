<?php  // write.php
declare(strict_types=1);

ob_start();

require_once(__DIR__ . '/../libs/Db.php');

//　formの「書き込み内容」を把握する
/*
$datum = [];
$datum['name'] = $_POST['name'] ?? '';
$datum['title'] = $_POST['title'] ?? '';
$datum['body'] = $_POST['body'] ?? '';
// validate
$error = [];
if ('' === $datum['name']) {
    $error[] = "name validate error";
}
if ('' === $datum['body']) {
    $error[] = "body validate error";
}
*/

// 別解
$datum = [];
$error = []; 
// 対象とvalidateパターンを把握
$params = [
    'name' => 'must',
    'title' => '',
    'body' => 'must',
];
foreach($params as $key => $val) {
    //　データの取得
    $datum[$key] = (string) ($_POST[$key] ?? '');
    // validate
    if ('must' === $val) {
        if ('' === $datum[$key]) {
            $error[] = "{$key} validate error";
        }
    }
}

// エラーだったらはじく
if ([] !== $error) {
    var_dump($error);
    exit;
}

//　書き込みブラウザと書き込み元IPアドレスを把握する
$datum['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
$datum['from_ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

// var_dump($datum);

// DBハンドルを取得
$dbh =  Db::getDbHandle();

try {
    /* DBに書き込み内容をinsertする */
    // プリペアドステートメントを作成する
    $sql = 'INSERT INTO bbses(name, title, body, user_agent, from_ip, created_at)
      VALUES(:name, :title, :body, :user_agent, :from_ip, :created_at);';
    $pre = $dbh->prepare($sql);
    // var_dump($pre);

    //　値をバインドする
    // $pre->bindValue(':name', $datum['name']);
    // $pre->bindValue(':title', $datum['title']);
    // $datum["name"] = null; // 例外テスト用
    foreach($datum as $key => $val) {
        $pre->bindValue(":{$key}", $val);
    }
    $pre->bindValue(':created_at', date(DATE_ATOM));

    //　SQLを実行する
    $r = $pre->execute();
    var_dump($r);
} catch(PDOException $e) {
    echo $e->getMessage();
    exit;
}

//　top pageに遷移させる
header("Location: ./index.php");
