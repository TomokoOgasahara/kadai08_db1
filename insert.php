<?php
//1. POSTデータ取得
$company = $_POST["company"];
$gender = $_POST["gender"];
$role = $_POST["role"];
$join = $_POST["join"];
$status = $_POST["status"];
$experience = $_POST["experience"];
$type = $_POST["type"];
$position = $_POST["position"];
$star1 = $_POST["star1"];
$star2 = $_POST["star2"];
$star3 = $_POST["star3"];
$memo1 = $_POST["memo1"];
$memo2 = $_POST["memo2"];

//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $db_name = 'wom-tech_kadai08_db1';
  $db_host = 'mysql3101.db.sakura.ne.jp';
  $db_id = '******';
  $db_pw = '******';

  $server_info = 'mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
  $pdo = new PDO($server_info, $db_id, $db_pw);

} catch (PDOException $e) {
  exit('DB_CONNECT:'.$e->getMessage());
}

//3. トランザクション開始（必要なら）
$pdo->beginTransaction();

//３．データ登録SQL作成
$sql ="INSERT INTO wom_table_1(company,gender,role,`join`,status,experience,type,position,star1,star2,star3,memo1,memo2,datetime)
VALUES(:company,:gender,:role,:join,:status,:experience,:type,:position,:star1,:star2,:star3,:memo1,:memo2,sysdate());";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':company',     $company,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':gender',      $gender,      PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':role',        $role,        PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':join',        $join,        PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':status',      $status,      PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':experience',  $experience,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':type',        $type,        PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':position',    $position,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':star1',       $star1,       PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':star2',       $star2,       PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':star3',       $star3,       PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memo1',       $memo1,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':memo2',       $memo2,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//４．データ登録処理後
if($status==false){

//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{

// 5. コミットしてデータを確定
  $pdo->commit();
}

ob_start();  // バッファリングを開始
// ここに全ての処理が含まれる
header("Location: index.php");
ob_end_flush();  // バッファリングをクリア
exit();

?>
