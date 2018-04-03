function getUrl(route) {
	route = typeof route !== 'undefined' ? route : null;
	var $url = location.protocol + '//' + location.host;
	return route !== null ? $url + route : $url;
}

function addOrSubstractQty($value, $string) {
	if ($string.indexOf('prod-plus') >= 0) {
		$value += 1;
	} else if($string.indexOf('prod-minus') >= 0) {
		if ($value > 1) {
			$value -= 1;
		}
	}
	return $value;
}

function getSecondPart(str) {
    return str.split('.').pop();
}

function getFirstPart(str) {
    return str.split('.')[0];
}

function toFloat(num) {
	var dotPos = num.lastIndexOf('.');
	var commaPos = num.lastIndexOf(',');
	var sep = ((dotPos > commaPos) && dotPos) ? dotPos : (((commaPos > dotPos) && commaPos) ? commaPos : false);
	if (!sep) {
		return parseFloat(num.replace(/[^\d]/g, ""));
	}
	return parseFloat(
		num.substr(0, sep).replace(/[^\d]/g, "") + '.' +
		num.substr(sep+Number(1), num.length).replace(/[^\d]/g, "")
	);
}

function number_format (number, decimals, dec_point, thousands_sep) {
    // strip all characters but numerical ones
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
    	var k = Math.pow(10, prec);
    	return '' + Math.round(n * k) / k;
    };
    // ie fix
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
    	s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
    	s[1] = s[1] || '';
    	s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}