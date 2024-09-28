<?php
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  //Password:MAMP='root',XAMPP=''
  $db_name = 'wom-tech_kadai08_db1';
  $db_host = 'mysql3101.db.sakura.ne.jp';
  $db_id = 'wom-tech';
  $db_pw = 'Tomoko_24';

  $server_info = 'mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
  $pdo = new PDO($server_info, $db_id, $db_pw);

} catch (PDOException $e) {
  exit('DB_CONNECT:'.$e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM wom_table_1"; 
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //true or false


//３．データ表示
// $view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]

// star1の平均値をPHPで計算
$sum1 = 0;
$count1 = 0;
foreach ($values as $value) {
  if (is_numeric($value['star1'])) {
    $sum1 += $value['star1'];
    $count1++;
  }
}
$average1 = $count1 > 0 ? $sum1 / $count1 : 0; // 平均値を計算

// star2の平均値をPHPで計算
$sum2 = 0;
$count2 = 0;
foreach ($values as $value) {
  if (is_numeric($value['star2'])) {
    $sum2 += $value['star2'];
    $count2++;
  }
}
$average2 = $count2 > 0 ? $sum2 / $count2 : 0; // 平均値を計算

// star3の平均値をPHPで計算
$sum3 = 0;
$count3 = 0;
foreach ($values as $value) {
  if (is_numeric($value['star3'])) {
    $sum3 += $value['star3'];
    $count3++;
  }
}
$average3 = $count3 > 0 ? $sum3 / $count3 : 0; // 平均値を計算

//JSONに値を渡す場合に使う
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.jsを読み込む -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@300;400;500;700;900&display=swap" rel="stylesheet">

<title>Wom-tech 企業口コミ投稿結果</title>

<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}
td{border: 1px solid red;}</style>
</head>
<body id="main">

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>

<!-- Head[End] -->

<!-- Main[Start] -->

<body>

<h1>Wom-tech 企業口コミ投稿結果</h1>

<div class="graph-box">
    <h2 class="graph-title">①年収に対する満足度</h2>
    <h2>平均値：<?= number_format($average1, 2); ?></h2>
    <!-- PHPで計算された平均値を表示 -->
    <canvas id="myBarChart1" width="200" height="200"></canvas>
</div>

<div class="graph-box">
    <h2 class="graph-title">②働きがいに対する満足度</h2>
    <h2>平均値：<?= number_format($average2, 2); ?></h2>
    <!-- PHPで計算された平均値を表示 -->
    <canvas id="myBarChart2" width="200" height="200"></canvas>
</div>

<div class="graph-box">
    <h2 class="graph-title">③働きやすさに対する満足度</h2>
    <h2>平均値：<?= number_format($average3, 2); ?></h2>
    <!-- PHPで計算された平均値を表示 -->
    <canvas id="myBarChart3" width="200" height="200"></canvas>
</div>

</body>

<div>
    <div class="container jumbotron"></div>
<table>
<?php foreach($values as $value){ ?>
  <tr>
   <td><?=$value["id"]?></td>
   <td><?=$value["company"]?></td>
   <td><?=$value["gender"]?></td>
   <td><?=$value["role"]?></td>
   <td><?=$value["join"]?></td>
   <td><?=$value["status"]?></td>
   <td><?=$value["experience"]?></td>
   <td><?=$value["type"]?></td>
   <td><?=$value["position"]?></td>
   <td><?=$value["star1"]?></td>
   <td><?=$value["star2"]?></td>
   <td><?=$value["star3"]?></td>
   <td><?=$value["memo1"]?></td>
   <td><?=$value["memo2"]?></td>
</tr> 
<?php } ?>
</table>

</div>
<!-- Main[End] -->



<script>

//JSON受け取り
  var jsonData = '<?=$json?>';
  const obj = JSON.parse(jsonData); // PHPから受け取ったJSONデータをオブジェクトに変換

// star1, star2, star3のデータをそれぞれの配列に格納
  var star1 = [];
  obj.forEach(function(item) {
    star1.push(item.star1); // star1列の値を配列に追加
  });

  var star2 = [];
  obj.forEach(function(item) {
    star2.push(item.star2); // star2列の値を配列に追加
  });

  var star3 = [];
  obj.forEach(function(item) {
    star3.push(item.star3); // star3列の値を配列に追加
  });

// star1の中の数値をカウントするためのオブジェクト
  var count1 = {};
  star1.forEach(function(num){
      if(count1[num]){
          count1[num]++;
      }
      else {
          count1[num] = 1;
      }
  });

  var labels1 = Object.keys(count1); // 数値の種類（キー）をラベルに
  var data1 = Object.values(count1); // 出現回数（値）をデータに

// star1の平均値を求める
  let sum1 = star1.reduce((a, b) => a + b, 0);
  let average1 = (sum1 / star1.length).toFixed(2);
  console.log("star1の平均値: " + average1);

// star2の中の数値をカウントするためのオブジェクト
  var count2 = {};
  star2.forEach(function(num){
      if(count2[num]){
          count2[num]++;
      }
      else {
          count2[num] = 1;
      }
  });

  var labels2 = Object.keys(count2); // 数値の種類（キー）をラベルに
  var data2 = Object.values(count2); // 出現回数（値）をデータに

// star3の中の数値をカウントするためのオブジェクト
  var count3 = {};
  star3.forEach(function(num){
      if(count3[num]){
          count3[num]++;
      }
      else {
          count3[num] = 1;
      }
  
  });

  var labels3 = Object.keys(count3); // 数値の種類（キー）をラベルに
  var data3 = Object.values(count3); // 出現回数（値）をデータに   

// グラフを描画する
createBarChart(labels1, data1, 'myBarChart1');
createBarChart(labels2, data2, 'myBarChart2');
createBarChart(labels3, data3, 'myBarChart3');

// グラフを描画する関数の定義
function createBarChart(labels, data, canvasId){

    const ctx = document.getElementById(canvasId).getContext('2d');
    new Chart(ctx, {
        type: 'bar', // 棒グラフの指定
        data: {
            labels: labels, // X軸のラベル
            datasets: [{
                data: data, // データセット
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // 背景色
                borderColor: 'rgba(75, 192, 192, 1)', // 枠線の色
                borderWidth: 1 // 枠線の幅
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true, // Y軸が0から始まるように設定
                    ticks: {
                        maxTicksLimit : 10
                    }
                }

                }
            }
        }
    )};


</script>



</script>
</body>
</html>
