<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>COLOR SELECTION</title>
    <link rel="stylesheet" type="text/css" href="./my.css">
  </head>


  <body>
    <center>
      <h1>COLOR SELECTION</h1>

      <div id="container"></div> <!-- canvasを設置するためのdivタグ -->

      <div style="font-size: 70%; margin-top:30px; margin-bottom:80px;">
        <p>©️2019 小貫智弥 | Tomoya Onuki</p>
      </div>
    </center>



    <script type="text/javascript">

    //cookie値を連想配列として取得する
    function getCookieArray(){
      var arr = new Array();
      if(document.cookie != ''){
        var tmp = document.cookie.split('; ');
        for(var i=0;i<tmp.length;i++){
          var data = tmp[i].split('=');
          arr[data[0]] = decodeURIComponent(data[1]);
        }
      } else {
        for (var i = 0; i < 3; i++) {
          arr['color'+i] = '#000000';
        }
      }
      return arr;
    }

    // 選択した色
    var selectedColor = [];//["#000000", "#000000", "#000000"];
    var arr = getCookieArray();
    selectedColor[0] = arr['color0'];
    selectedColor[1] = arr['color1'];
    selectedColor[2] = arr['color2'];
    for (var i = 0; i < 3; i++) {
      console.log(selectedColor[i]);
      if( selectedColor[i] === undefined ) selectedColor[i] = '#000000';
    }

    function colorSelecter() {
      var cvs = document.createElement("canvas"); // canvasタグの動的生成
      var width = 800;  // サイズ
      var height = 400; // サイズ
      cvs.width = width;
      cvs.height = height; // サイズの設定
      document.getElementById("container").appendChild(cvs); // l2のdivに配置する
      var ctx = cvs.getContext("2d"); // canvasに描画するためのオブジェクト


      // 色に関する変数たち
      var hsb = [[0,0,0], [0,0,0], [0,0,0]];
      var rgb = [[0,0,0], [0,0,0], [0,0,0]];

      // 初期化
      for (var i = 0; i < 3; i++) {
        rgb[i] = hex2rgb(selectedColor[i]);
        hsb[i] = rgb2hsb(rgb[i]);
      }
      console.log(hsb);
      console.log(rgb);

      var selectingPanelID = -1;
      var sliderWidth = 280;
      var sliderHeight = 40;
      var bX = -10, bY = 235; // スライダのポインタ
      var sX = -10, sY = 335; // スライダのポインタ
      var drag = false;       // スライダをドラッグしたい


      // -----------------------------
      // 描画関数 ---------------------
      // -----------------------------
      function draw() {
        // カラーホイール -----------------
        // -----------------------------
        var baseColor = [
          "#f9be01", "#f19601", "#ec6c01",
          "#e4012e", "#a50082", "#561b85",
          "#034fa4", "#006ab5", "#00a3ad",
          "#00a93c", "#abcd06", "#fdd902",
        ]; // 基本色

        ctx.save();
        ctx.translate(200, 200);
        var radius = 30;
        for(var i = 0; i < baseColor.length; i++) {
          ctx.save();
          ctx.rotate(2 * Math.PI * i / 12);
          ctx.translate(0, 150);
          ctx.fillStyle = baseColor[i];
          ctx.beginPath();
          ctx.moveTo(200, 120);
          ctx.arc(0, 0, radius, 0, 2 * Math.PI);
          ctx.fill();
          ctx.restore();
        }
        ctx.restore();
        // -----------------------------

        // パレット ----------------------
        var side = 80;
        var margin = 20;

        ctx.textBaseline = "top"; // 文字設定：ベースライン

        ctx.save();
        ctx.translate(450, 20);

        // タイトル
        ctx.font = "20pt Arial"; // フォント設定
        ctx.fillStyle = selectedColor[i];
        ctx.fillText("Color Palette", 0, 0);

        ctx.translate(0, 35);
        ctx.font = "15pt Arial"; // フォント設定
        for(var i = 0; i < 3; i++) {
          var x = (side + margin) * i;
          var y = 0;
          ctx.fillStyle = selectedColor[i];
          drawPanel(x,y,side, i);  // 四角の描画
          ctx.fillText(selectedColor[i], x, y+side+5);
        }
        ctx.restore();
        // -----------------------------


        // 明度スライダー -----------------
        ctx.save();
        ctx.translate(450, 200);

        // タイトル
        ctx.font = "20pt Arial"; // フォント設定
        ctx.fillStyle = selectedColor[i];
        ctx.fillText("Brightness", 0, 0);

        ctx.translate(0, 35);
        // 線形グラデーション
        var g = ctx.createLinearGradient(0, 0, sliderWidth, sliderHeight);
        g.addColorStop(0, 'white');
        g.addColorStop(1, 'black');
        ctx.fillStyle = g;
        ctx.fillRect(0, 0, sliderWidth, sliderHeight);
        ctx.restore();

        // スライダのポインタ
        ctx.fillStyle = "#000000";
        ctx.beginPath();
        ctx.arc(bX, bY, 3, 0, 2 * Math.PI);
        ctx.arc(bX, bY+sliderHeight, 3, 0, 2 * Math.PI);
        ctx.fill();
        // -----------------------------


        // 彩度スライダー -----------------
        ctx.save();
        ctx.translate(450, 300);

        // タイトル
        ctx.font = "20pt Arial"; // フォント設定
        ctx.fillStyle = selectedColor[i];
        ctx.fillText("Saturation", 0, 0);

        ctx.translate(0, 35);
        // 線形グラデーション
        var g = ctx.createLinearGradient(0, 0, sliderWidth, sliderHeight);
        g.addColorStop(0, 'white');
        if(selectingPanelID == -1) {
          g.addColorStop(1, "black");
        } else {
          g.addColorStop(1, selectedColor[selectingPanelID]);
        }
        // g.addColorStop(1, "red");
        ctx.fillStyle = g;
        ctx.fillRect(0, 0, sliderWidth, sliderHeight);
        ctx.restore();

        // スライダのポインタ
        ctx.fillStyle = "#000000";
        ctx.beginPath();
        ctx.arc(sX, sY, 3, 0, 2 * Math.PI);
        ctx.arc(sX, sY+sliderHeight, 3, 0, 2 * Math.PI);
        ctx.fill();
        // -----------------------------
      }
      // -----------------------------
      // -----------------------------



      // -----------------------------
      // カラーパネルの描画
      // -----------------------------
      function drawPanel(x,y,side,id) {

        if(id != selectingPanelID) {
          ctx.fillRect(x, y, side, side);
        } else {
          var r = 20;
          ctx.beginPath();
          ctx.moveTo(x,y + r);
          ctx.arc(x+r,y+side-r,r,Math.PI,Math.PI*0.5,true);
          ctx.arc(x+side-r,y+side-r,r,Math.PI*0.5,0,1);
          ctx.arc(x+side-r,y+r,r,0,Math.PI*1.5,1);
          ctx.arc(x+r,y+r,r,Math.PI*1.5,Math.PI,1);
          ctx.closePath();
          ctx.fill();
        }
      }
      // -----------------------------
      // -----------------------------



      // -----------------------------
      // カラーホイールから色相を選ぶ関数
      // -----------------------------
      function selectHue(x, y) {
        // 色を抽出
        var imagedata = ctx.getImageData(x, y, 1, 1);
        var data = Array.prototype.slice.apply(imagedata.data);
        rgb[selectingPanelID] = data;
        var max = Math.max(data[0],data[1],data[2]);
        var min = Math.min(data[0],data[1],data[2]);
        if(min == data[0]) hsb[selectingPanelID][0] = 60 * (data[2] - data[1]) / (max - min) + 180;
        if(min == data[1]) hsb[selectingPanelID][0] = 60 * (data[0] - data[2]) / (max - min) + 300;
        if(min == data[2]) hsb[selectingPanelID][0] = 60 * (data[1] - data[0]) / (max - min) + 60;
        hsb[selectingPanelID][2] = max;
        hsb[selectingPanelID][1] = max - min;
      }
      // -----------------------------
      // -----------------------------


      // -----------------------------
      // 彩度を選ぶ関数
      // -----------------------------
      // function selectSaturation(x, y) {
      //   // 色を抽出
      //   var imagedata = ctx.getImageData(x, y, 1, 1);
      //   var rgb = Array.prototype.slice.apply(imagedata.data);
      //   var max = Math.max(rgb[0],rgb[1],rgb[2]);
      //   var min = Math.min(rgb[0],rgb[1],rgb[2]);
      //   hsb[selectingPanelID][1] = max - min;
      // }
      // -----------------------------
      // -----------------------------



      // -----------------------------
      // 明度を選ぶ関数
      // -----------------------------
      // function selectBrightness(x, y) {
      //   // 色を抽出
      //   var imagedata = ctx.getImageData(x, y, 1, 1);
      //   var rgb = Array.prototype.slice.apply(imagedata.data);
      //   var max = Math.max(rgb[0],rgb[1],rgb[2]);
      //   hsb[selectingPanelID][2] = max;
      // }
      // -----------------------------
      // -----------------------------



      // -----------------------------
      // RGBをコードに変更
      // -----------------------------
      function rgb2hex(rgb) {
        selectedColor[selectingPanelID] = "#";        // 初期化
        for(var i = 0; i < 3; i++) {
          var data = rgb[i].toString(16);             // 16進数に変換
          if(data.length < 2) data = "0"+data;        // 0詰め処理
          selectedColor[selectingPanelID] += data;    // カラーコードに変換
        }
        console.log(selectedColor[selectingPanelID]);
      }
      // -----------------------------
      // -----------------------------



      // -----------------------------
      // hsbをrgbに変換する
      // -----------------------------
      function hsv2rgb(h, s, v) {
        if (h < 0) {
          h = h + Math.ceil(-h / 360) * 360;
        } else if (h > 360) {
          h = h % 360;
        }

        if (s < 0) { s = 0; }
        else if (s > 255) { s = 255; }

        if (v < 0) {
          v = 0;
        } else if (v > 255) {
          v = 255;
        }

        if (s == 0) {
          v = 0|v;
          return [v, v, v];
        }

        var r, g, b;
            s /= 255;
        var i = (0|(h / 60)) % 6,
            f = (h / 60) - i,
            p = v * (1 - s),
            q = v * (1 - f * s),
            t = v * (1 - (1 - f) * s);
        switch (i) {
          case 0: r = v; g = t; b = p; break;
          case 1: r = q; g = v; b = p; break;
          case 2: r = p; g = v; b = t; break;
          case 3: r = p; g = q; b = v; break;
          case 4: r = t; g = p; b = v; break;
          case 5: r = v; g = p; b = q; break;
        }
        rgb[selectingPanelID][0] = parseInt(r);
        rgb[selectingPanelID][1] = parseInt(g);
        rgb[selectingPanelID][2] = parseInt(b);
      }
      // -----------------------------
      // -----------------------------


      // -----------------------------
      // 16進数からrgbに変換
      // -----------------------------
      function hex2rgb(colorCode) {
        var rgb = [];
        rgb[0] = parseInt(colorCode.substr(1,2),16);
        rgb[1] = parseInt(colorCode.substr(3,2),16);
        rgb[2] = parseInt(colorCode.substr(5,2),16);
        return rgb;
      }
      // -----------------------------
      // -----------------------------


      // -----------------------------
      // -----------------------------
      function rgb2hsb(rgb) {
        var hsb = [];
        var max = Math.max(rgb[0],rgb[1],rgb[2]);
        var min = Math.min(rgb[0],rgb[1],rgb[2]);
        if(min == rgb[0]) hsb[0] = 60 * (rgb[2] - rgb[1]) / (max - min) + 180;
        if(min == rgb[1]) hsb[0] = 60 * (rgb[0] - rgb[2]) / (max - min) + 300;
        if(min == rgb[2]) hsb[0] = 60 * (rgb[1] - rgb[0]) / (max - min) + 60;
        hsb[2] = max;
        hsb[1] = max - min;

        return hsb;
      }
      // -----------------------------
      // -----------------------------


      // -----------------------------
      // 再描画関数 --------------------
      // -----------------------------
      function reRender() {
        ctx.clearRect(0,0,width,height);  // 画面をクリア
        draw();
      }
      // -----------------------------
      // -----------------------------

      function updateSliderPoint() {
        // スライダ用のポインタの座標更新
        sX = 450 + hsb[selectingPanelID][1] / 250 * sliderWidth;
        bX = 450 + sliderWidth - hsb[selectingPanelID][2] / 250 * sliderWidth;
      }



      cvs.addEventListener( "click",
        function(e) {
          var x = e.offsetX;
          var y = e.offsetY;

          // 色を変えるパネルを選ぶ
          if(55 < y && y < 55+80) {
            if(450 < x && x < 450+80){
              if(selectingPanelID != 0) { selectingPanelID = 0; }
              else { selectingPanelID = -1; }
            } else if(550 < x && x < 550+80) {
              if(selectingPanelID != 1) { selectingPanelID = 1; }
              else { selectingPanelID = -1; }
            } else if(650 < x && x < 650+80) {
              if(selectingPanelID != 2) { selectingPanelID = 2; }
              else { selectingPanelID = -1; }
            }
          }
          console.log("ID:"+selectingPanelID);

          // パネルを選択してる時
          if(selectingPanelID == 0 || selectingPanelID == 1 || selectingPanelID == 2){
            // カラーホイール上なら彩度を変更
            if(0 < x && x < 400 && 0 < y && y < 400) {
              selectHue(x, y);
            }

            console.log("HSB:"+hsb[selectingPanelID]);
            console.log("RGB:"+rgb[selectingPanelID]);

            rgb2hex(rgb[selectingPanelID]); // カラーコードに変更

            updateSliderPoint();
          }
          reRender(); // 再描画
          document.cookie = 'color0='+selectedColor[0];
          document.cookie = 'color1='+selectedColor[1];
          document.cookie = 'color2='+selectedColor[2];
        }
      ); // マウスがクリックされたら色を取得


      cvs.addEventListener( "mousemove",
        function(e) {
          var x = e.offsetX;
          var y = e.offsetY;
          console.log(drag);
          if(drag) {
            // パネルを選択してる時
            if(selectingPanelID == 0 || selectingPanelID == 1 || selectingPanelID == 2){
              // 明度スライダ上なら彩度を変更
              if(450 <= x && x <= 450+280 && 235 < y && y < 235+40) {
                // selectBrightness(x, y);
                bX = x;
                hsb[selectingPanelID][2] = (450 + sliderWidth - bX) * 250 / sliderWidth;;
                hsv2rgb(hsb[selectingPanelID][0], hsb[selectingPanelID][1], hsb[selectingPanelID][2]);
              }

              // 彩度スライダ上なら彩度を変更
              if(450 <= x && x <= 450+280 && 335 < y && y < 335+40) {
                // selectSaturation(x, y);
                sX = x;
                hsb[selectingPanelID][1] = (sX - 450) * 250 / sliderWidth;;
                hsv2rgb(hsb[selectingPanelID][0], hsb[selectingPanelID][1], hsb[selectingPanelID][2]);
              }
              rgb2hex(rgb[selectingPanelID]); // カラーコードに変更

              // updateSliderPoint();
            }
            reRender(); // 再描画
            document.cookie = 'color0='+selectedColor[0];
            document.cookie = 'color1='+selectedColor[1];
            document.cookie = 'color2='+selectedColor[2];
          }
        }
      );


      cvs.addEventListener( "mousedown", function(e){ drag = true; } );
      cvs.addEventListener( "mouseup", function(e){ drag = false; } );


      reRender();
    }

    colorSelecter();


    </script>
  </body>
</html>
