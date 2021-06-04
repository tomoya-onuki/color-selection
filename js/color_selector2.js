var COLOR_PALET_FLAG = -1;

$(function () {
    var hsl = init();
    hue_circle();

    /////////////////////////
    // lightnessスライダーの操作
    $('#lightness > input').on('input change', function () {
        hsl[2] = parseInt($(this).val());
        $('#lightness > .label >.value').text(hsl[2]);
        // console.log(hsl);
        setColor(hsl);
    });

    /////////////////////////
    // saturationスライダーの操作
    $('#saturation > input').on('input change', function () {
        hsl[1] = parseInt($(this).val());
        $('#saturation > .label >.value').text(hsl[1]);
        // console.log(hsl);
        setColor(hsl);
    });

    //////////////////
    // hueサークルの操作
    $('#hue > .item').each(function () {
        $(this).on('click', function () {
            var str = $(this).css('background');
            const regexp = /\d+, \d+, \d+/g;
            var matches_array = str.match(regexp);
            var rgb = matches_array[0].split(', ');
            var _hsl = rgb2hsl(rgb);
            hsl[0] = _hsl[0];
            setColor(hsl);
        });
    });


    ////////////////////
    // カラーパレットの選択
    $('#color_palet0 > .color').on('click', function () {
        $('.color').css('border-radius', '0px');
        $(this).css('border-radius', '12px');
        hsl = getColor($(this));
        $('#saturation > input').val(hsl[1]);
        $('#lightness > input').val(hsl[2]);
        $('#saturation > .label >.value').text(hsl[1]);
        $('#lightness > .label >.value').text(hsl[2]);
        COLOR_PALET_FLAG = 0;
    });
    $('#color_palet1 > .color').on('click', function () {
        $('.color').css('border-radius', '0px');
        $(this).css('border-radius', '12px');
        hsl = getColor($(this));
        $('#saturation > input').val(hsl[1]);
        $('#lightness > input').val(hsl[2]);
        $('#saturation > .label >.value').text(hsl[1]);
        $('#lightness > .label >.value').text(hsl[2]);
        COLOR_PALET_FLAG = 1;
    });
    $('#color_palet2 > .color').on('click', function () {
        $('.color').css('border-radius', '0px');
        $(this).css('border-radius', '12px');
        hsl = getColor($(this));
        $('#saturation > input').val(hsl[1]);
        $('#lightness > input').val(hsl[2]);
        $('#saturation > .label >.value').text(hsl[1]);
        $('#lightness > .label >.value').text(hsl[2]);
        COLOR_PALET_FLAG = 2;
    });


    copyToClipboard();
});

function setColor(hsl) {

    var obj = null;
    switch (COLOR_PALET_FLAG) {
        case 0:
            obj = $('#color_palet0');
            break;
        case 1:
            obj = $('#color_palet1');
            break;
        case 2:
            obj = $('#color_palet2');
            break;
    }

    if (obj != null) {
        var cssHsl = 'hsl(' + hsl[0] + ', ' + hsl[1] + '%, ' + hsl[2] + '%)';
        obj.children('.color').css('background', cssHsl);
        obj.find('.hsl > .text').text(cssHsl);

        var str = obj.find('.color').css('background');
        // rgbで取得されるのでr,g,bを正規表現で抽出
        const regexp = /\d+, \d+, \d+/g;
        var token = str.match(regexp);

        // rgb(r,g,b)という形式に整形
        var cssRgb = 'rgb(' + token[0] + ')';
        obj.find('.rgb > .text').text(cssRgb);
        var rgb = token[0].split(', ');

        // hex
        var hex = rgb2hex(rgb);
        obj.find('.hex > .text').text(hex);

        // saturationグラデーションを作成
        $('#saturation > .gradation').css('background', 'linear-gradient(90deg, hsl(0,0%,50%) 0%, ' + cssHsl + ' 100%)');

        // リンクの生成
        obj.find('.link').attr('href', "https://www.google.com/search?q="+cssRgb);
    }
}


function getColor(obj) {
    var str = obj.css('background');
    const regexp = /\d+, \d+, \d+/g;
    var token = str.match(regexp);
    var rgb = token[0].split(', ');
    var _hsl = rgb2hsl(rgb);
    console.log(_hsl);
    return _hsl;
}

function init() {
    var l = parseInt($('#lightness > input').val());
    $('#lightness > .label >.value').text(l);

    var s = parseInt($('#saturation > input').val());
    $('#saturation > .label >.value').text(s);

    var h = 210;

    for (var i = 0; i < 3; i++) {
        COLOR_PALET_FLAG = i;
        setColor([h, s, l]);
    }

    COLOR_PALET_FLAG = -1;
    return [h, s, l];
}


function hue_circle() {
    var baseColor = [
        "#f9be01", "#f19601", "#ec6c01",
        "#e4012e", "#a50082", "#561b85",
        "#034fa4", "#006ab5", "#00a3ad",
        "#00a93c", "#abcd06", "#fdd902",
    ]; // 基本色

    var item_num = $('#hue > .item').length;
    var deg = 360.0 / item_num;
    var red = (deg * Math.PI / 180.0);
    var circle_r = $("#hue > .item").width() * 2.5;

    $('#hue > .item').each(function (i) {
        var x = Math.cos(red * i) * circle_r + circle_r;
        var y = Math.sin(red * i) * circle_r + circle_r;
        $(this).css('left', x);
        $(this).css('top', y);
        $(this).css('background', baseColor[i]);
    });
}



function copyToClipboard() {
    $('.copy_btn').on('click', function() {
            console.log("click");
            console.log($(this).parent().find('.text').text());
            var text = $(this).parent().find('.text').text();
            text.select();

            // 選択しているテキストをクリップボードにコピーする
            document.execCommand("Copy");

            // コピーをお知らせする
            alert("Copy！");
        
    });

}