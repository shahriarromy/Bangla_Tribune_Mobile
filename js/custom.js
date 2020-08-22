var bDays = new Array(11);
bDays[0] = '০';
bDays[1] = '১';
bDays[2] = '২';
bDays[3] = '৩';
bDays[4] = '৪';
bDays[5] = '৫';
bDays[6] = '৬';
bDays[7] = '৭';
bDays[8] = '৮';
bDays[9] = '৯';
function banglaNumber(v) {
    v = v.toString();
    v = v.split("");
    var bangla = "";
    $(v).each(function (index, element) {
        if (parseInt(element) >= 0 && parseInt(element) <= 9)
            bangla += bDays[element];
        else
            bangla += element;
    });
    return bangla;
}

function languageNumber(v, l) {
    if (l == 'bn') {
        return banglaNumber(v);
    }
    else {
        return v;
    }
}
var jw_bn_convert = function(n,ln){
	if( !ln || ln == 'en' ) return n;
	var bn = {'0':'০','1':'১','2':'২','3':'৩','4':'৪','5':'৫','6':'৬','7':'৭','8':'৮','9':'৯'};
	var str = String(n);
	var ret = '';
	for( i in str ){
		ret += bn[str[i]];
		}
	return ret;
	}
var jw_limit_text_chars = function (o) {
    var ths = new Object();
    ths.element = o.element ? o.element : '';
    ths.char_limit = o.char_limit ? o.char_limit : 160;
    ths.language = o.language ? o.language : 'en';
    if (!ths.element)
        return false;
    ths.char_counter = function () {
        var comment_char_counter = $(this).parent().find('.comment_char_count');
        if (!comment_char_counter.length) {
            $(this).before('<div class="comment_char_count p10" align="left"></div>');
            comment_char_counter = $(this).parent().find('.comment_char_count');
        }
        if (ths.char_limit < $(this).val().length) {
            $(this).val($(this).val().substring(0, ths.char_limit - 1));
        }
        comment_char_counter.html(jw_bn_convert($(this).val().length, ths.language) + ' / ' + jw_bn_convert(ths.char_limit, ths.language));
    }
    $(ths.element).on('keypress', ths.char_counter).on('change', ths.char_counter).on('keyup', ths.char_counter);
}

function get_param_global( name ) {
  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if( results == null )
    return "";
  else
    return results[1];
}
function nFormatter(num) {
     if (num >= 1000000000) {
        return (num / 1000000000).toFixed(1).replace(/\.0$/, '') + 'G';
     }
     if (num >= 1000000) {
        return (num / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
     }
     if (num >= 1000) {
        return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
     }
     return num;
}

$(document).ready(function(){
    $('#top_menu').on('click', function(){
        var menuOpenClose = $('#bs-example-navbar-collapse-1');
        if(menuOpenClose.is(':visible')){
            menuOpenClose.slideUp();
        } else {
            menuOpenClose.slideDown();
        }
    });
    $('.tabbedLinks ul.nav li').on('click', function(){
        var tab_id = $(this).attr('data-tab');

        $('.tabbedLinks ul.nav li').removeClass('active');
        $('.tab-content .tab-pane').removeClass('active');

        $(this).addClass('active');
        $("#"+tab_id).addClass('active');
    });
});