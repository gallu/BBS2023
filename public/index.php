<?php  // index.php
declare(strict_types=1);

// var_dump( __DIR__ );
// var_dump( __DIR__ . '/../' );
// var_dump( realpath(__DIR__ . '/../') );

// 基準になるディレクトリ(最後の / はない形式で)
define('BASEPATH', realpath(__DIR__ . '/..'));

require_once BASEPATH . '/vendor/autoload.php';
require_once BASEPATH . '/libs/Db.php';

$templates_dir = BASEPATH . '/templates';
$loader = new \Twig\Loader\FilesystemLoader($templates_dir);
$twig = new \Twig\Environment($loader);

//　DBハンドルを取得する
$dbh =  Db::getDbHandle();
// var_dump($dbh);

// 書き込まれた内容を読み込む
// プリペアドステートメントの作成
$sql = 'SELECT * FROM bbses ORDER BY bbs_id DESC LIMIT 30 OFFSET 0;';
$pre = $dbh->prepare($sql);

//　値のバインド
// 今回はプレースホルダがないのでバインドなし

//　SQLを実行
$r = $pre->execute();
// var_dump($r);

// データを取得する
$data = $pre->fetchAll();
// var_dump($data);

//　読み込んだ内容をテンプレートに渡す
$context = [
    "data" => $data,
];

echo $twig->render('index.twig', $context);
