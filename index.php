<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>COLOR SELECTION</title>
    <link rel="stylesheet" type="text/css" href="./my.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://riversun.github.io/jsframe/jsframe.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  </head>


  <body>
    <center>
      <h1>COLOR SELECTION</h1>

      <!-- 配色システムのメイン -->
      <div id="container"></div> <!-- canvasを設置するためのdivタグ -->
      <script type="text/javascript" src="./js/color_selecter.js"></script>
      <!-- ここまで -->

      <!-- みんなの配色リンク -->
      <div >
        <a href="./color_file.php" class="button">みんなの配色をみる</a>
      </div>
      <!-- ここまで -->

      <!-- 送信フォーム -->
      <div>
      	<form action="save_color.php" method="post" id="AjaxForm">
      		<input type="hidden" name="color01" value="#f4f4f4">
      		<input type="hidden" name="color02" value="#f4f4f4">
      		<input type="hidden" name="color03" value="#f4f4f4">
      		<input type="submit" id="save" class="button" value="色を保存する" >
      	</form>
      </div>
    	<!-- 送信用のjs --><script type="text/javascript" src="./js/ajax_form.js"></script>
      <!-- 保存の通知 --><script type="text/javascript" src="./js/save_notfy.js"></script>
      <!-- ここまで -->

      <div>
      <?php
      echo "<h1>cookie</h1>";
      echo $_COOKIE["color0"];
      echo $_COOKIE["color1"];
      echo $_COOKIE["color2"];
      ?>
      </div>

      <!-- フッター -->
      <div style="font-size: 70%; margin-top:30px; margin-bottom:80px;">
        <p>©️2019 小貫智弥 | Tomoya Onuki</p>
      </div>
      <!-- ここまで -->

    </center>
  </body>
</html>
