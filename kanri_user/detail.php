<?php
$id = $_GET["id"]; //?id~**を受け取る
require_once("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="user.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>[編集]</legend>
                <label>名前：<input type="text" name="name" value="<?= $row["name"] ?>"></label><br>
                <label>ID：<input type="text" name="lid" value="<?= $row["lid"] ?>"></label><br>
                <label>PW：<input type="text" name="lpw" value="<?= $row["lpw"] ?>"></label><br>
                <!-- <input type="hidden" name="kanri_flg" value=""> -->
                <input type="submit" value="送信">
                <input type="hidden" name="id" value="<?= $id ?>">
            </fieldset>
        </div>
    </form>
</body>

</html>