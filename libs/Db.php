<?php  // Db.php
declare(strict_types=1);

class Db {
    // シングルトンにするため
    private function __construct() {
    }

    //　DBハンドルを取得
    public static function getDbHandle() {
        static $dbh = null;
        if (null === $dbh) {
            // DBへの接続
            //　接続用情報
            $host = 'localhost';
            $dbname = 'bbs2023';
            $charset = 'utf8mb4';
            $user = 'bbs2023user';
            $pass = 'bbs2023pass';

            // 接続
            $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
            $options = [
                \PDO::ATTR_EMULATE_PREPARES => false,  // エミュレート無効
                \PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,  // 複文無効
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,  // エラー時に例外を投げる(好み)
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ];
            //
            try {
                $dbh = new \PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e){
                echo $e->getMessage(); // XXX 実際は出力はしない(logに書くとか)
                exit;
            }
        }

        return $dbh;
    }
}
