function submit_a_file(form_id, source_div_id, target_div_id,file_id){
    var url = 'ajax_action.php?action=print_a_file&file_id='+file_id;

    $('#'+form_id).ajaxForm(function() {
        $('#'+source_div_id).text('');

        $('<div>').load(url, function() {
            $('#'+target_div_id).prepend($(this));
        });
    });
}



function submit_an_event(form_id, source_div_id, target_div_id,event_id){
    var url = 'ajax_action.php?action=print_an_event&event_id='+event_id;

    $('#'+form_id).ajaxForm(function() {
        $('#'+source_div_id).text('');

        $('<div>').load(url, function() {
            $('#'+target_div_id).prepend($(this));
        });
    });
}


function submit_write_up(form_id, source_div_id, target_div_id,post_id){

    var url = 'ajax_action.php?action=print_a_write_up&post_id='+post_id;

    $('#'+form_id).ajaxForm(function() {
        $('#'+source_div_id).text('');

        $('<div>').load(url, function() {
            $('#'+target_div_id).prepend($(this));
        });
    });
}

function change_semester(url){
    var val_inf = $('#semester_selector option:selected').attr('date_inf');
    var val_sup = $('#semester_selector option:selected').attr('date_sup');
    sto('date_inf',val_inf);
    sto('date_sup',val_sup);


    document.location.replace(url);
}

























 //// ---- Functions to manage Cookies ---------------- //

// D'autres scripts et des tutoriaux sur http://www.toutjavascript.com
// Déclaration des variables 'domaine' et 'date d'expiration'
var pathname=location.pathname;
var myDomain=pathname.substring(0,pathname.lastIndexOf('/')) +'/';
var date_exp = new Date();
//date_exp.setTime(date_exp.getTime()+(365*24*3600*1000));

// Voici les 3 fonctions de gestions des cookies
////////////////////////////////////////////////
function getCookieVal(offset) {
	var endstr=document.cookie.indexOf (";", offset);
	if (endstr==-1)
      		endstr=document.cookie.length;
	return unescape(document.cookie.substring(offset, endstr));
}
function GetCookie (name) {
	var arg=name+"=";
	var alen=arg.length;
	var clen=document.cookie.length;
	var i=0;
	while (i<clen) {
		var j=i+alen;
		if (document.cookie.substring(i, j)==arg)
                        return getCookieVal (j);
                i=document.cookie.indexOf(" ",i)+1;
                        if (i==0) break;}
	return null;
}
function SetCookie (name, value) {
// un cookie a besoin d'un nom, d'une valeur, d'un nom de domaine, d'une date d'expiration
//
	var argv=SetCookie.arguments;
	var argc=SetCookie.arguments.length;
	var expires=(argc > 2) ? argv[2] : null;
	var path=(argc > 3) ? argv[3] : null;
	var domain=(argc > 4) ? argv[4] : null;
	var secure=(argc > 5) ? argv[5] : false;
	document.cookie=name+"="+escape(value)+
		//((expires==null) ? "" : ("; expires="+expires.toGMTString()))+
		((path==null) ? "" : ("; path="+path))+
		((domain==null) ? "" : ("; domain="+domain))+
		((secure==true) ? "; secure" : "");
}

// Example:
// writeCookie("myCookie", "my name", 24);
// Stores the string "my name" in the cookie "myCookie" which expires after 24 hours.
function writeCookie(name, value, hours)
{
  var expire = "";
  if(hours != null)
  {
    expire = new Date((new Date()).getTime() + hours * 3600000);
    expire = "; expires=" + expire.toGMTString();
  }
  document.cookie = name + "=" + escape(value) + expire;
}

// Example:
// alert( readCookie("myCookie") );
function readCookie(name)
{
  var cookieValue = "";
  var search = name + "=";
  if(document.cookie.length > 0)
  {
    offset = document.cookie.indexOf(search);
    if (offset != -1)
    {
      offset += search.length;
      end = document.cookie.indexOf(";", offset);
      if (end == -1) end = document.cookie.length;
      cookieValue = unescape(document.cookie.substring(offset, end))
    }
  }
  return cookieValue;
}


function sto(nom,valeur) {
// 	Fonction appelée par le bouton "Stocker une information"
// 	Le nom de l'information est précédée de "_" pour ne pas interférer avec les noms utilisés par le site.
//			SetCookie("_"+nom,valeur,date_exp,myDomain);
	writeCookie(nom, valeur, 36500);
}

function get(nom) {
// Fonction appelée par le bouton "Récupérer une information"
// Le nom de l'information est précédée de "_" pour ne pas interférer avec les noms utilisés par le site.
//		var valeur=GetCookie("_"+nom);
//		if (valeur!=null) {return valeur;}
//		else {return "";}

	return readCookie(nom);
}

function drop(nom)
{
	date=new Date;
	date.setFullYear(date.getFullYear()-1);
	writeCookie(nom,"",date);
}


