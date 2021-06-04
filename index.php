<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>COLOR SELECTION</title>
  <link rel="stylesheet" type="text/css" href="./my.css">
  <link rel="stylesheet" type="text/css" href="./style.css">

  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="https://riversun.github.io/jsframe/jsframe.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="./js/color_convert.js"></script>
  <script src="./js/color_selector2.js"></script>
</head>


<body>

  <!-- 新しい配色システム -->
  <center>
    <h1>COLOR SELECTION</h1>
  </center>

  <div id="color_scheme">
    <div id="left_contents">
      <div id="hue">
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
        <div class="item"></div>
      </div>
    </div>


    <div id="right_contents">
      <div class="ui">
        <div id="saturation">
          <div class="label">Saturation: <span class="value">100</span> </div>
          <div class="gradation"></div>
          <input type="range" min="0" max="100" value="100" step="1">
        </div>
      </div>

      <div class="ui">
        <div id="lightness">
          <div class="label">Lightness: <span class="value">50</span> </div>
          <div class="gradation"></div>
          <input type="range" min="0" max="100" value="50" step="1">
        </div>
      </div>


      <div id="color_palet0">
        <div class="color"></div>
        <div class="label">
          <div class="hex">#000000</div>
          <div class="rgb">rgb(255, 0, 0)</div>
          <div class="hsl">hsl(0, 100%, 50%)</div>
        </div>
      </div>

      <div id="color_palet1">
        <div class="color"></div>

        <div class="label">
          <div class="hex">#ffffff</div>
          <div class="rgb">rgb(255, 255, 255)</div>
          <div class="hsl">hsl(0, 0, 100)</div>
        </div>
      </div>

      <div id="color_palet2">
        <div class="color"></div>
        <div class="label">
          <div class="hex">#000000</div>
          <div class="rgb">rgb(0, 0, 0)</div>
          <div class="hsl">hsl(0, 0, 0)</div>
        </div>
      </div>
    </div>
  </div>
  <!-- ここまで -->
  <center>
    <div class="footer">


      <!-- みんなの配色リンク -->
      <!-- <div>
        <a href="./color_file.php" class="button">みんなの配色をみる</a>
      </div> -->
      <!-- ここまで -->

      <!-- 送信フォーム -->
      <!-- <div>
        <form action="save_color.php" method="post" id="AjaxForm">
          <input type="submit" id="save" class="button" value="色を保存する">
        </form>
      </div> -->
      <!-- 送信用のjs -->
      <!-- <script type="text/javascript" src="./js/ajax_form.js"></script> -->
      <!-- 保存の通知 -->
      <!-- <script type="text/javascript" src="./js/save_notfy.js"></script> -->
      <!-- ここまで -->



      <!-- フッター -->
      <div style="font-size: 70%; margin-top:30px; margin-bottom:80px;">
        <p>©️2019-2020 小貫智弥 | Tomoya Onuki</p>
      </div>
      <!-- ここまで -->
    </div>

  </center>
</body>

</html>