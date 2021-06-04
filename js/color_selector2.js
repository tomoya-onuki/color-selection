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

        if (COLOR_PALET_FLAG != 0) {
            $(this).css('border-radius', '12px');
            hsl = getColor($(this));
            $('#saturation > input').val(hsl[1]);
            $('#lightness > input').val(hsl[2]);
            $('#saturation > .label >.value').text(hsl[1]);
            $('#lightness > .label >.value').text(hsl[2]);
            COLOR_PALET_FLAG = 0;
        } else {
            COLOR_PALET_FLAG = -1;
        }

    });
    $('#color_palet1 > .color').on('click', function () {
        $('.color').css('border-radius', '0px');

        if (COLOR_PALET_FLAG != 1) {
            $(this).css('border-radius', '12px');
            hsl = getColor($(this));
            $('#saturation > input').val(hsl[1]);
            $('#lightness > input').val(hsl[2]);
            $('#saturation > .label >.value').text(hsl[1]);
            $('#lightness > .label >.value').text(hsl[2]);
            sat_gradation(hsl);
            COLOR_PALET_FLAG = 1;
        } else {
            COLOR_PALET_FLAG = -1;
        }

    });
    $('#color_palet2 > .color').on('click', function () {
        $('.color').css('border-radius', '0px');

        if (COLOR_PALET_FLAG != 2) {
            $(this).css('border-radius', '12px');
            hsl = getColor($(this));
            $('#saturation > input').val(hsl[1]);
            $('#lightness > input').val(hsl[2]);
            $('#saturation > .label >.value').text(hsl[1]);
            $('#lightness > .label >.value').text(hsl[2]);
            sat_gradation(hsl);
            COLOR_PALET_FLAG = 2;
        } else {
            COLOR_PALET_FLAG = -1;
        }
    });


    


    $('.text').on('input', function () {
        var color = "";
        var _rgb;

        var colorType = $(this).parent().attr('class');

        switch (colorType) {
            case 'hex':
                color = $(this).val();
                _rgb = hex2rgb($(this).val());
                break;
            case 'rgb':
                color = 'rgb(' + $(this).val() + ')';
                var str = $(this).val().replace(' ', '');
                _rgb = str.split(',');
                break;
            case 'hsl':
                var str = $(this).val().replace(' ', '');
                var token0 = str.split(',');
                color = 'hsl(' + token0[0] + ', ' + token0[1] + '%, ' + token0[2] + '%)';
                break;
            case 'hsv':
                var str = $(this).val().replace(' ', '');
                var token0 = str.split(',');
                _rgb = hsv2rgb(token0);
                color = 'rgb(' + _rgb[0] + ', ' + _rgb[1] + ', ' + _rgb[2] + ')';
                break;
            case 'cmyk':
                var str = $(this).val().replace(' ', '');
                var token0 = str.split(',');
                _rgb = cmyk2rgb(token0);
                color = 'rgb(' + _rgb[0] + ', ' + _rgb[1] + ', ' + t_rgb[2] + ')';
                break;
        }


        //　先祖のidをチェックして、colorPaletを探す
        $(this).parents().each(function () {
            var tmp = String($(this).attr('id'));

            if (tmp.indexOf('color_palet') != -1) {
                // console.log(color);
                $(this).find('.color').css('background', color);


                switch (colorType) {
                    case 'hex':
                        $(this).find('.rgb > .text').val(_rgb);
                        $(this).find('.hsl > .text').val(rgb2hsl(_rgb));
                        $(this).find('.hsv > .text').val(rgb2hsv(_rgb));
                        $(this).find('.cmyk > .text').val(rgb2cmyk(_rgb));
                        break;
                    case 'rgb':
                        $(this).find('.hex > .text').val(rgb2hex(_rgb));
                        $(this).find('.hsl > .text').val(rgb2hsl(_rgb));
                        $(this).find('.hsv > .text').val(rgb2hsv(_rgb));
                        $(this).find('.cmyk > .text').val(rgb2cmyk(_rgb));
                        break;
                    case 'hsl':
                        var str = $(this).find('.color').css('background');
                        const regexp = /\d+, \d+, \d+/g;
                        var token = str.match(regexp);
                        _rgb = token[0].split(', ');
                        $(this).find('.rgb > .text').val(_rgb);
                        $(this).find('.hex > .text').val(rgb2hex(_rgb));
                        $(this).find('.hsv > .text').val(rgb2hsv(_rgb));
                        $(this).find('.cmyk > .text').val(rgb2cmyk(_rgb));
                        break;
                    case 'hsv':
                        $(this).find('.rgb > .text').val(_rgb);
                        $(this).find('.hex > .text').val(rgb2hex(_rgb));
                        $(this).find('.hsl > .text').val(rgb2hsl(_rgb));
                        $(this).find('.cmyk > .text').val(rgb2cmyk(_rgb));
                        break;
                    case 'cmyk':
                        $(this).find('.rgb > .text').val(_rgb);
                        $(this).find('.hex > .text').val(rgb2hex(_rgb));
                        $(this).find('.hsl > .text').val(rgb2hsl(_rgb));
                        $(this).find('.hsv > .text').val(rgb2hsv(_rgb));
                        break;
                }
            }
        });
    });



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
        obj.find('.hsl > .text').val(hsl[0] + ', ' + hsl[1] + ', ' + hsl[2]);

        var str = obj.find('.color').css('background');
        // rgbで取得されるのでr,g,bを正規表現で抽出
        const regexp = /\d+, \d+, \d+/g;
        var token = str.match(regexp);

        // rgb(r,g,b)という形式に整形
        var rgbStr = token[0];
        obj.find('.rgb > .text').val(rgbStr);
        var rgb = token[0].split(', ');

        // hex
        var hex = rgb2hex(rgb);
        obj.find('.hex > .text').val(hex);

        // hsv
        var hsb = rgb2hsv(rgb);
        if (hsb[0] == -1) hsb[0] = hsl[0];
        obj.find('.hsv > .text').val(hsb[0] + ', ' + hsb[1] + ', ' + hsb[2]);

        // CMYK
        var cmyk = rgb2cmyk(rgb);
        obj.find('.cmyk > .text').val(cmyk[0] + ', ' + cmyk[1] + ', ' + cmyk[2] + ', ' + cmyk[3]);

        // saturationグラデーションを作成
        sat_gradation(hsl);

        // リンクの生成
        obj.find('.link').attr('href', "https://www.google.com/search?q=" + 'rgb(' + rgbStr + ')');
    }
}


function getColor(obj) {
    var str = obj.css('background');
    const regexp = /\d+, \d+, \d+/g;
    var token = str.match(regexp);
    var rgb = token[0].split(', ');
    var _hsl = rgb2hsl(rgb);
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
    $('.copy_btn').on('click', function () {
        // console.log("click");
        // console.log($(this).parent().find('.text').text());
        var text = $(this).parent().find('.text').text();
        text.select();

        // 選択しているテキストをクリップボードにコピーする
        document.execCommand("Copy");

        // コピーをお知らせする
        alert("Copy！");

    });

}


function sat_gradation(hsl) {
    $('#saturation > .gradation').css('background', 'linear-gradient(90deg, hsl(0,0%,50%) 0%, ' + 'hsl(' + hsl[0] + ', ' + hsl[1] + '%, ' + hsl[2] + '%)' + ' 100%)');
}