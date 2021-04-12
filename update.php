<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

//1. POSTデータ取得
$name = $_POST["name"];
$url = $_POST["url"];
$comment = $_POST["comment"];
$id = $_POST["id"];


//2. DB接続します
//*** function化する！  *****************
require_once('funcs.php');
$pdo = db_conn();
// try {
//     //ID:'root', Password: 'root'
//     $pdo = new PDO('mysql:dbname=kadai_book;charset=utf8;host=localhost','root','root');
//   } catch (PDOException $e) {
//     exit('DBConnectError:'.$e->getMessage());
//   }
// try {
//     $db_name = "gs_db3";    //データベース名
//     $db_id   = "root";      //アカウント名
//     $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
//     $db_host = "localhost"; //DBホスト
//     $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
// } catch (PDOException $e) {
//     exit('DB Connection Error:' . $e->getMessage());
// }


//３．データ登録SQL作成
$sql = $pdo->prepare(
            "UPDATE
                gs_bm_table
            SET
                name = :a1,
                url = :a2,
                age = :age,
                comment = :a3,
                indate = sysdate()
                WHERE 
                    id = :id
            ;"
);

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $url, PDO::PARAM_STR);
$stmt->bindValue(':a3', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    sql_error($stmt);
    // $error = $stmt->errorInfo();
    // exit("ErrorMessage:". print_r($error, true));
  }else{
    //５．select.
    redirect('select.php');
    // header("Location: select.php");
    // exit;
  
  }
