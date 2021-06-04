function rgb2hsl(rgb) {
	var r = rgb[0] / 255;
	var g = rgb[1] / 255;
	var b = rgb[2] / 255;

	var max = Math.max(r, g, b);
	var min = Math.min(r, g, b);
	var diff = max - min;

	var h = 0;
	var l = (max + min) / 2 * 100;
	var s = 0;
	if( (1 - (Math.abs(max + min - 1))) * 100 == 0) {
		s = 0;
	} else {
		s = diff / (1 - (Math.abs(max + min - 1))) * 100;
	}
	

	switch (min) {
		case max:
			h = 0;
			break;

		case r:
			h = Math.round((60 * ((b - g) / diff)) + 180);
			break;

		case g:
			h = Math.round((60 * ((r - b) / diff)) + 300);
			break;

		case b:
			h = Math.round((60 * ((g - r) / diff)) + 60);
			break;
	}
	h = parseInt(h, 10);
	s = parseInt(s, 10);
	l = parseInt(l, 10);
	return [h, s, l];
}

function hsl2rgb ( hsl ) {
	var h = hsl[0] ;
	var s = hsl[1] ;
	var l = hsl[2] ;

	var max = l + ( s * ( 1 - Math.abs( ( 2 * l ) - 1 ) ) / 2 ) ;
	var min = l - ( s * ( 1 - Math.abs( ( 2 * l ) - 1 ) ) / 2 ) ;

	var rgb = [0, 0, 0];
	var i = parseInt( h / 60 ) ;

	switch( i ) {
		case 0 :
		case 6 :
			rgb = [ max, min + (max - min) * (h / 60), min ] ;
		break ;

		case 1 :
			rgb = [ min + (max - min) * (120 - h / 60), max, min ] ;
		break ;

		case 2 :
			rgb = [ min, max, min + (max - min) * (h - 120 / 60) ] ;
		break ;

		case 3 :
			rgb = [ min, min + (max - min) * (240 - h / 60), max ] ;
		break ;

		case 4 :
			rgb = [ min + (max - min) * (h - 240 / 60), min, max ] ;
		break ;

		case 5 :
			rgb = [ max, min, min + (max - min) * (360 - h / 60) ] ;
		break ;
	}

	// return rgb.map( function ( value ) {
	// 	return value * 255 ;
	// } ) ;

	return rgb.map(v => Math.round(v));
	// return [ rgb[0] * 255, rgb[1] * 255, rgb[2] * 255 ];
}


// -----------------------------
// RGBをコードに変更
// -----------------------------
function rgb2hex ( rgb ) {
	// return "#" + rgb.map( function ( value ) {
	// 	return ( "0" + value.toString( 16 ) ).slice( -2 ) ;
	// } ).join( "" ) ;
	var hex = "#";
	rgb.forEach(val => {
		if( parseInt(val, 10) < 10) hex += 0;
		hex += parseInt(val, 10).toString(16);
	});
	// console.log(rgb+" -> "+hex);
	return hex;
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
		v = 0 | v;
		return [v, v, v];
	}

	var r, g, b;
	s /= 255;
	var i = (0 | (h / 60)) % 6,
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
	rgb[0] = parseInt(colorCode.substr(1, 2), 16);
	rgb[1] = parseInt(colorCode.substr(3, 2), 16);
	rgb[2] = parseInt(colorCode.substr(5, 2), 16);
	return rgb;
}
// -----------------------------
// -----------------------------


// -----------------------------
// -----------------------------
function rgb2hsb(rgb) {
	var hsb = [];
	var max = Math.max(rgb[0], rgb[1], rgb[2]);
	var min = Math.min(rgb[0], rgb[1], rgb[2]);
	if (min == rgb[0]) hsb[0] = 60 * (rgb[2] - rgb[1]) / (max - min) + 180;
	if (min == rgb[1]) hsb[0] = 60 * (rgb[0] - rgb[2]) / (max - min) + 300;
	if (min == rgb[2]) hsb[0] = 60 * (rgb[1] - rgb[0]) / (max - min) + 60;
	hsb[2] = max;
	hsb[1] = max - min;

	return hsb;
}
// -----------------------------
// -----------------------------