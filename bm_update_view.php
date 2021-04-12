<?php

//１．PHP
//select.phpのPHP部分コードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正、GETの内容をSELECTする！
require_once('funcs.php');
$pdo = db_conn();
$id = $_GET['id'];

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE id=' . $id . ';');
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
    // while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //     //GETデータ送信リンク作成
    //     // <a>で囲う。
    //     $view .= '<p>';
    //         $view .= '<a href="detail.php?id=' . $result['id'] . '">';
    //     $view .= $result["indate"] . "：" . $result["name"];
    //         $view .= '</a>';
    //     $view .= '</p>';
    // }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お気に入りの本</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">お気に入りの本一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>お気に入りの本を登録</legend>
                <label>書籍名：<input type="text" name="name"></label><br>
                <label>書籍URL：<input type="text" name="url"></label><br>
                <label>書籍コメント：<textArea name="comment" rows="4" cols="40"></textArea></label><br>
                <input type="hidden" name="id" value="<?= $result['id'] ?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>