<?php
require_once('funcs.php');
$pdo = db_conn();

//1.  DB接続します
// try {
//     //Password:MAMP='root',XAMPP=''
//     $pdo = new PDO('mysql:dbname=kadai_book;charset=utf8;host=localhost','root','root');
// } catch (PDOException $e) {
//     exit('DBConnectError'.$e->getMessage());
// }

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    sql_error($status);
}else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
        while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $view .= '<p>';
            $view .= '<a href="detail.php?id=' . $r["id"] . '">';
            $view .= $r["lid"] . " " . $r["name"] . " " . $r["kanri_flg"];
            $view .= '</a>';
            $view .= "　";
            $view .= '<a class="btn btn-danger" href="delete.php?id=' . $r["id"] . '">';
            $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
            $view .= '</a>';
            $view .= '</p>';
        }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="register.php">ユーザー登録</a>
        </div>
    </div>
    </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
    <a href="insert2.php"></a>
    <?php echo $view ?>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>