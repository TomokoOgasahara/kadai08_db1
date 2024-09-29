<!DOCTYPE html>
<html lang="ja">
<head>

  <meta charset="UTF-8">
  <title>データ登録</title>

  <link href="css/sample.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700;800&family=Shippori+Mincho+B1:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
<div class="jumbotron">
   <fieldset>
    <legend>Wom-tech 女性活躍口コミサイト</legend>
</div>

<div class="form">
    <br><label>企業名：<input type="text" name="company"></label><br>

    <br><label>性別：
    <input type="radio" name="gender" value="男">男
    <input type="radio" name="gender" value="女">女
    <input type="radio" name="gender" value="回答しない">回答しない
    </label><br>

    <br><label>職種：
    <select name="role">
      <option value="商品企画">商品企画</option> 
      <option value="研究開発">研究開発</option> 
      <option value="生産技術">生産技術</option> 
      <option value="生産管理">生産管理</option> 
      <option value="品質管理">品質管理</option> 
      <option value="製造">製造</option> 
      <option value="営業">営業</option> 
      <option value="r広報・マーケティング8">広報・マーケティング</option> 
      <option value="法務">法務</option>
      <option value="総務・人事">総務・人事</option>      
    </select>
    </label><br> 
    
    <br><label>入社形態：
    <input type="radio" name="join" value="新卒">新卒
    <input type="radio" name="join" value="キャリア">キャリア
    </label><br>
  
    <br><label>状態：
    <input type="radio" name="status" value="現職">現職
    <input type="radio" name="status" value="退職済">退職済
    </label><br>    

    <br><label>在籍年数：<input type="text" name="experience"></label><br>

    <br><label>雇用形態：
    <input type="radio" name="type" value="正社員">正社員
    <input type="radio" name="type" value="パート・派遣">パート・派遣
    </label><br>

    <br><label>役職：<input type="text" name="position"></label><br>

    <br>①年収/給与：
    <input type="radio" name="star1" value="1">1
    <input type="radio" name="star1" value="2">2
    <input type="radio" name="star1" value="3">3
    <input type="radio" name="star1" value="4">4
    <input type="radio" name="star1" value="5">5

    <br><br>②働きやすさ(制度・文化)：
    <input type="radio" name="star2" value="1">1
    <input type="radio" name="star2" value="2">2
    <input type="radio" name="star2" value="3">3
    <input type="radio" name="star2" value="4">4
    <input type="radio" name="star2" value="5">5

    <br><br>③働きがい(成長性・公平性)：
    <input type="radio" name="star3" value="1">1
    <input type="radio" name="star3" value="2">2
    <input type="radio" name="star3" value="3">3
    <input type="radio" name="star3" value="4">4
    <input type="radio" name="star3" value="5">5

    <br><br>良い点：<br><textarea name="memo1" cols="30" rows="10"></textarea>
    <br><br>悪い点：<br><textarea name="memo2" cols="30" rows="10"></textarea>

    <br><br><button class="glass-button" input type="submit" value="送信">送信</button>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>
