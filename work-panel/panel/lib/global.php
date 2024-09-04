<?php //á
if(!isset($_GET['format']))
header('Content-Type: text/html; charset=utf-8');


$Array_Meses=[1=>"enero","febrero","marzo","abril","mayo","junio","julio","agosto","setiembre","octubre","noviembre","diciembre"];
$Array_Horas=[0=>"12am","1am","2am","3am","4am","5am","6am","7am","8am","9am","10am","11am","12pm","1pm","2pm","3pm","4pm","5pm","6pm","7pm","8pm","9pm","10pm","11pm"];
$Array_Horas2=[
	0=>"12:00am",
	"12:15am",
	"12:30am",
	"12:45am",
	"1:00am",
	"1:15am",
	"1:30am",
	"1:45am",
	"2:00am",
	"2:15am",
	"2:30am",
	"2:45am",
	"3:00am",
	"3:15am",
	"3:30am",
	"3:45am",
	"4:00am",
	"4:15am",
	"4:30am",
	"4:45am",
	"5:00am",
	"5:15am",
	"5:30am",
	"5:45am",
	"6:00am",
	"6:15am",
	"6:30am",
	"6:45am",
	"7:00am",
	"7:15am",
	"7:30am",
	"7:45am",
	"8:00am",
	"8:15am",
	"8:30am",
	"8:45am",
	"9:00am",
	"9:15am",
	"9:30am",
	"9:45am",
	"10:00am",
	"10:15am",
	"10:30am",
	"10:45am",
	"11:00am",
	"11:15am",
	"11:30am",
	"11:45am",
	"12:00pm",
	"12:15pm",
	"12:30pm",
	"12:45pm",
	"1:00pm",
	"1:15pm",
	"1:30pm",
	"1:45pm",
	"2:00pm",
	"2:15pm",
	"2:30pm",
	"2:45pm",
	"3:00pm",
	"3:15pm",
	"3:30pm",
	"3:45pm",
	"4:00pm",
	"4:15pm",
	"4:30pm",
	"4:45pm",
	"5:00pm",
	"5:15pm",
	"5:30pm",
	"5:45pm",
	"6:00pm",
	"6:15pm",
	"6:30pm",
	"6:45pm",
	"7:00pm",
	"7:15pm",
	"7:30pm",
	"7:45pm",
	"8:00pm",
	"8:15pm",
	"8:30pm",
	"8:45pm",
	"9:00pm",
	"9:15pm",
	"9:30pm",
	"9:45pm",
	"10:00pm",
	"10:15pm",
	"10:30pm",
	"10:45pm",
	"11:00pm",
	"11:15pm",
	"11:30pm",
	"11:45pm"
];


$FORMSCLASS=[
	'1'=>'linea_derecha_inicio',
	'2'=>'linea_derecha',
	'3'=>'linea_derecha_espacio',
	'50'=>'linea_derecha_50',
	'100'=>'linea_derecha_100',
	'150'=>'linea_derecha_150',
	'a'=>'linea_derecha_align',
	'a1'=>'linea_derecha_align_inicio',
	'a3'=>'linea_derecha_align_espacio'
];

/*
$COMANDOS_OBJETO=[
				'inp','short','long'
				,'int','int5'
				,'fot','vid','txt'
				,'bit1','bit'
				,'fechc','fech'
				,'del'
				,'grupos','sub','items'
];

$COMANDOS_TUTO="
CAMPOS:
inp:		input,w:150					ej: nombre:inp
short:		input,w:50					ej: nombre:short
long:		input,w:300					ej: nombre:long
int:		input,variable:float		ej: numero:int
int5:		input,variable:float,w:5	ej: numero:int5
bit:		com,radio,w:50,default:0	ej: opcion:bit
bit1:		com,radio,w:50,default:1	ej: opcion:bit1
bit:		img,com,radio,w:50			ej: opcion:bit
fech:		fch,w:100					ej: fecha:fech
fechc:		fch,constante,w:100			ej: fecha:fech



";

$LIBRARIES['web']=array('name'=>"web",'value'=>
'
BODY {bg=#FFF,w=972,font=calibri,s}
DIVBODY {s}
CONTENT {p-i,p-d,shadow,radius,s}
CANVAS {min-h=350,bg=#FFF,inter=5,dbl=178M,tpl,cpl,borde=1,p-b,p-t,p-lados,s}

HEADEROUT {h,s}
HEADERPRE {h,s}
HEADER {h,m-b,bg,s}
BAR {h=auto,m-b,bg,s}
HEADERAFTER {h,bg,s}
FOOTERPRE {h,s}
FOOTERAFTER {h,s}
FOOTEROUT {h,s}
'
);

$LIBRARIES['menus']=array('name'=>"Menu",'value'=>
'
FILA{s}
ME{ex=jpg,bg,s}
UL-IZQ{ena=0,w=5}
UL-DER{ena=0,w=5}
LI-IZQ{ena=0,w=5}
LI-DER{ena=0,w=5}
LI-BOR{ena=0,w=1,bg,s}
LI{s}
LI-SEL{s}
A{h,m-lados=1,p-lados,p-t,size,color,bg,color-sel,bg-sel,weight,s}
'
);

$LIBRARIES['arboles']=array('name'=>"Arbol",'value'=>
'
UL{s}
LI{size,h,min-h,color,s}
SEL{color,bg,ima=0,s}
NIVEL1{p,p-l,bg,color,ima=0,s,a-s}
NIVEL2{p,p-l,bg,color,ima=0,s,a-s}
NIVEL3{p,p-l,bg,color,ima=0,s,a-s}
'
);

$LIBRARIES['bloques']=array('name'=>"Block",'value'=>
'
BLOQUE{m-t,m-b=10}
ARRIBA{ena=1,dis,min-h,size,color,bg,bg-out,p-lados,p-t,p-b,s}
SUBARRIBA{ena=1,dis,min-h,size,color,bg,p-lados,p-t,s}
MARCO{min-h,bg,bg-out,p-t=0,p-izq=0,p-der=0,p-b=0,scroll,h,m,s}
ABAJO{ena=1,dis,min-h,size,color,bg,bg-out,p-lados,p-t,s}
'
);

$LIBRARIES['listados']=array('name'=>"List",'value'=>
'
FILA{p-lados,w=100%,float=left,s}
ITEM{ena=1,h=auto,min-h,w=100%,bg,bg-sel,bg-out,p-b,p-t,p-l,s}
ITEMOVER{ena=1,s}
FOTO{ena=1,w,h,p=0,bg,borde,bg-sel,borde-w=1,borde-sel,sangria=0,m-b,s}
TITULO{ena=1,color,bg,size,align,text,weight,s}
SUBTITULO{ena=1,color,size,align,text,weight,s}
TEXTO{ena=1,size,color,align,text,weight,s}
FECHA{ena=0,s}
PRECIO{ena=0,w,h,p-a,p-i,p-d,s}
CARRITO{ena=0}
PAGINACION{ena=1,dis,size,bg,color,bg-sel,color-sel,m-izq,p,weight=bold,s}
TREN{color,size,m-der,m-izq,s,s-fila}
'
);

$LIBRARIES['formularios']=array('name'=>"Form",'value'=>
'
LEGEND{ena=0,color,size,s,bg,p-t,p-b}
BEFORE{ena=0,color,size,s,bg,p-t,p-b}
FILA{w,color,s}
LABEL{color,w,align=right,s}
INPUT{borde=#999999,bg=#F5F7FB,color=#000000,w=250,ta-h,s}
SMALL{color,s}
'
);
$LIBRARIES['footers']=array('name'=>"Foot",'value'=>
'
FILA{h,bg,p-t,p-b,p-lados,size,color,color-sel,s}
BY{size,color,color-sel}
INFO{align,color,color-sel,p-b,s}
MENU{align,color,color-sel,p-b,s}
'
);
$LIBRARIES['fichas']=array('name'=>"File",'value'=>
'
FILA{p-lados,w=100%,float=left,s}
PAGINACION{ena=1,dis}
ITEM{ena=1,h=auto,min-h,w=100%,bg,bg-sel,bg-out,s}
FOTO{ena=1,w,h,p=0,bg,borde,bg-sel,borde-w=1,borde-sel,sangria=0,m-b,s}
TITULO{ena=1,color,bg,size,align,text,weight,s}
SUBTITULO{ena=1,color,size,align,text,weight,s}
TEXTO{ena=1,size,color,align,text,weight,s}
FECHA{ena=0,s}
PRECIO{ena=0,w,h,p-a,p-i,p-d,s}
CARRITO{ena=0}
TREN{color,size,m-der,m-izq,s,s-fila}
'
);

$LIBRARIES['carritos']=array('name'=>"Cart",'value'=>
'
ACTUALIZAR{color,font}
ElIMINAR{color,font}
VACIAR{color,font}
VERCARRITO{color,font}
ENVIAR{color,font}
ITEM{color,font,s}
PRECIOITEM{color,font}
TOTAL{color,font}
PRECIOTOTAL{color,font}
'
);

$LIBRARIES['tablas']=array('name'=>"Tbl",'value'=>
'

'
);

*/

//error_reporting(0);

//date_default_timezone_set('America/New_York');
// date_default_timezone_set('America/Lima');
// echo '<pre>';print_r($_SERVER);echo '</pre>';
$vars=parse_ini_file($PATH_CUSTOM."config/config.ini",true);
$vars['LOCAL']['url_publica']=str_replace(array("localhost","127.0.0.1"),$_SERVER['HTTP_HOST'],$vars['LOCAL']['url_publica']);
//echo "<pre>"; print_r($vars); echo "</pre>";
$vars_global=$vars['GENERAL'];

$UPLOAD_FTP=(isset($vars_global['UPLOAD_FTP']))?$vars_global['UPLOAD_FTP']:0;

extract($vars_global);
// $LOCALHOST='';
// if(enhay($_SERVER['SERVER_NAME'],'localhost')){
// 	$LOCALHOST=$_SERVER['SERVER_NAME'];
// }
// echo '<pre>';
// print_r($vars_global);
// print_r($_SERVER);
// echo '</pre>';
// exit();

$USU_IMG_DEFAULT=$vars_global['USU_IMG_DEFAULT']=$vars['GENERAL']['USU_IMG_DEFAULT']='img/blank.gif';




if ( substr($_SERVER['SERVER_NAME'],-9,9)=='localhost' or $_SERVER['SERVER_NAME']=="127.0.0.1" or substr($_SERVER['SERVER_NAME'],0,7)=="192.168") {

	$vars['LOCAL']['httpfiles']=($vars['GENERAL']['MODO_LOCAL_ARCHIVOS_REMOTOS']==1)?$vars['REMOTE']['httpfiles']:$vars['LOCAL']['httpfiles'];
	$vars_server=$vars['LOCAL'];
	$vars_server_mysql=$vars['LOCAL_MYSQL'];
	$vars_server_ftp=$vars['LOCAL_FTP'];
	$server_place="LOCAL";
	$Local=1;
	$SERVER['LOCAL']=1;
	$LOCAL=1;
	// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
	// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
	// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

} else {
	$vars_server=$vars['REMOTE'];
	$vars_server_mysql=$vars['REMOTE_MYSQL'];
	$vars_server_ftp=$vars['REMOTE_FTP'];
	$server_place="REMOTO";
	$Local=0;
	$SERVER['LOCAL']=0;
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
	// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

	//error_reporting(E_ALL);
}
//echo "<pre>";print_r($SERVER);echo "</pre>";

$parse=parse_url($_SERVER['HTTP_REFERER']);
$SERVER['from_externo']=($parse['host']!=$_SERVER['SERVER_NAME'] )?1:0;
$SERVER['from_interno']=($SERVER['from_externo'])?0:1;

$SERVER['REDIRECT_QUERY_STRING']=$_SERVER['REDIRECT_QUERY_STRING'];
unset($parse);


/*
$vars_server_local=$vars['LOCAL'];
$vars_server_remoto=$vars['REMOTE'];
$vars_server_ftp_local=$vars['LOCAL_FTP'];
$vars_server_ftp_remoto=$vars['REMOTE_FTP'];
*/
$get_num_vars=0;
foreach($vars as $vars2){
foreach($vars2 as $vars3){
$get_num_vars++;
}
} unset($vars2); unset($vars3);

extract($vars_server);
extract($vars_server_mysql);
extract($vars_server_ftp);

define(CLAV,"poiiop");

/*
$DEPARTAMENTOS_PERU = array(
						"Amazonas",
						"Áncash",
						"Apurímac",
						"Arequipa",
						"Ayacucho",
						"Cajamarca",
						"Callao",
						"Cusco",
						"Huancavelica",
						"Huánuco",
						"Ica",
						"Junín",
						"La Libertad",
						"Lambayeque	",
						"Lima",
						"Loreto",
						"Madre de Dios",
						"Moquegua",
						"Pasco",
						"Piura",
						"Puno",
						"San Martín",
						"Tacna",
						"Tumbes"
						);
*/
$script_B = explode("?",$_SERVER['REQUEST_URI']);
if($script_B[1]){ $SERVER['PARAMS']=$script_B[1]; }

$script_A = explode("/",$_SERVER['REQUEST_URI']);
$url_script=$script_A[sizeof($script_A)-1];

$script_A = explode("/",$_SERVER['SCRIPT_FILENAME']);
$file_script=$script_A[sizeof($script_A)-1];

$script_A = explode("/",$_SERVER['SCRIPT_NAME']);
unset($script_A[sizeof($script_A)-1]);
$dir_script=implode("/",$script_A);

unset($script_B); unset($script_A);
// list($url_script,$url_variables)=explode("?",$url_script);

$SERVER['URL']=$url_script;
$SERVER['ARCHIVO']=$url_script;
$SERVER['ARCHIVO_REAL']=$file_script;
$SERVER['BASE']="//".$_SERVER['HTTP_HOST'].$dir_script."/";
$SERVER['ROOT']=(substr($vars_server['url_publica'],-1,1)=='/')?substr($vars_server['url_publica'],0,-1):$vars_server['url_publica'];
$SERVER['PANEL']=$SERVER['ROOT'].'/panel';
// echo '<pre>'; print_r($vars_server['url_publica']); echo '</pre>';
// echo '<pre>'; print_R("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); echo '</pre>';
$SERVER['PATH']=str_replace('//','/','/'.str_replace($vars_server['url_publica'],'',"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
// echo '<pre>'; print_r($SERVER['PATH']); echo '</pre>';
$SERVER['RUTA']=str_replace('http:/','http://',str_replace('//','/',$SERVER['ROOT'].$SERVER['PATH']));
// echo '<pre>'; print_r($SERVER); echo '</pre>';


$SERVER['RUTA_RELATIVA']=str_replace($SERVER['PANEL'],'',$SERVER['RUTA']);
$SERVER['RUTA_RELATIVA']=(substr($SERVER['RUTA_RELATIVA'],0,1)=='/')?substr($SERVER['RUTA_RELATIVA'],1):$SERVER['RUTA_RELATIVA'];

// print_r($SERVER);exit();

$LOGIN=(!(strpos($_SERVER['SCRIPT_NAME'], "login.php")===false))?1:0;

$BGCOLOR_DESARROLLO="#FFEEE0";

// $LOREN_IPSUM="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, s";

// $LOREN_IPSUM_HTML="<p>$LOREN_IPSUM</p><p>$LOREN_IPSUM</p><p>$LOREN_IPSUM</p>";

$limite_campos_en_lista=5;

unset($dir_script);


function get_browser_()
{
	global $_SERVER;
	$user_agent=$_SERVER['HTTP_USER_AGENT'];
	$browsers = array(
		'Opera' => 'Opera',
		'Chrome' => 'Chrome',
		'Firefox'=> '(Firebird)|(Firefox)',
		'Galeon' => 'Galeon',
		'Mozilla'=>'Gecko',
		'MyIE'=>'MyIE',
		'Lynx' => 'Lynx',
		'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
		'Konqueror'=>'Konqueror',
		'SearchBot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)',
		'IE10' =>'(MSIE 10\.[0-9]+)',
		'IE9' => '(MSIE 9\.[0-9]+)',
		'IE8' => '(MSIE 8\.[0-9]+)',
		'IE7' => '(MSIE 7\.[0-9]+)',
		'IE6' => '(MSIE 6\.[0-9]+)',
		'IE5' => '(MSIE 5\.[0-9]+)',
		'IE4' => '(MSIE 4\.[0-9]+)',
	);

	foreach($browsers as $browser=>$pattern)
	{
		if(!(strpos(" ".$user_agent." ",$pattern)===false))		
		// if (eregi($pattern, $user_agent))
			return $browser;
	}
	return 'Unknown';

}
// }

$SERVER['browser']=get_browser_();

function isMobileDevice() {
	
	$useragent=$_SERVER['HTTP_USER_AGENT'];

	return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));

}


/*

$combos=array(
				'inp'	=>'inp'
				,'int'	=>'int'
				,'txt'	=>'txt'
				,'fot'	=>'fot'
				,'fech'	=>'fech'
				,'bit'	=>'bit'
				,'opc'	=>'opc'

				);
$EDITOR_TEXTUAL_CAMPOS = "";
$EDITOR_TEXTUAL_CAMPOS.= "<div class='dredre'>";
$EDITOR_TEXTUAL_CAMPOS.= "<div>";
$EDITOR_TEXTUAL_CAMPOS.= "<input type='text' id='nuevo_campo' />";
$EDITOR_TEXTUAL_CAMPOS.= "<select>";
foreach($combos as $com=>$bos){ $EDITOR_TEXTUAL_CAMPOS.= "<option value='$com'>$bos</option>"; }
$EDITOR_TEXTUAL_CAMPOS.= "</select>";
$EDITOR_TEXTUAL_CAMPOS.= "</div>";
$EDITOR_TEXTUAL_CAMPOS.= "<div style='position:relative;'>";
$EDITOR_TEXTUAL_CAMPOS.= "<textarea id='jjjson' class='flext growme' style='border:1px solid #999;' >";
$EDITOR_TEXTUAL_CAMPOS.= "</textarea>";
$EDITOR_TEXTUAL_CAMPOS.= "<a style='position:absolute;right:5px;top:0px;'
 href='#' onclick=\"javascript:procesar_objt(); return false;\" rel='nofollow' >procesar campos</a>";
$EDITOR_TEXTUAL_CAMPOS.= "</div>";
$EDITOR_TEXTUAL_CAMPOS.= "</div>";
$EDITOR_TEXTUAL_CAMPOS.= "<script>";
$EDITOR_TEXTUAL_CAMPOS.= "$('jjjson').addEvent('keydown',function(event){if(event.key=='a'&&event.control){procesar_objt();};});";
$EDITOR_TEXTUAL_CAMPOS.= "</script>";

$EDITOR_TEXTUAL_PROPIEDADES = "";
$EDITOR_TEXTUAL_PROPIEDADES.= "<div class='dredre'>";
$EDITOR_TEXTUAL_PROPIEDADES.= "<div>";
$EDITOR_TEXTUAL_PROPIEDADES.= "<input type='text' id='nueva_propiedad' />";
$EDITOR_TEXTUAL_PROPIEDADES.= "<select>";
foreach($combos as $com=>$bos){ $EDITOR_TEXTUAL_PROPIEDADES.= "<option value='$com'>$bos</option>"; }
$EDITOR_TEXTUAL_PROPIEDADES.= "</select>";
$EDITOR_TEXTUAL_PROPIEDADES.= "</div>";
$EDITOR_TEXTUAL_PROPIEDADES.= "<div style='position:relative;'>";
$EDITOR_TEXTUAL_PROPIEDADES.= "<textarea id='jjjsonprop' class='flext growme' style='border:1px solid #000;' >";
$EDITOR_TEXTUAL_PROPIEDADES.= "</textarea>";
$EDITOR_TEXTUAL_PROPIEDADES.= "<a style='position:absolute;right:5px;top:0px;'
 href='#' onclick=\"javascript:procesar_props(); return false;\" rel='nofollow' >procesar propiedades</a>";
$EDITOR_TEXTUAL_PROPIEDADES.= "</div>";
$EDITOR_TEXTUAL_PROPIEDADES.= "</div>";
$EDITOR_TEXTUAL_PROPIEDADES.= "<script>";
$EDITOR_TEXTUAL_PROPIEDADES.= "$('jjjsonprop').addEvent('keydown',function(event){if(event.key=='a'&&event.control){procesar_props();};});";
$EDITOR_TEXTUAL_PROPIEDADES.= "</script>";

$EDITOR_TEXTUAL_OBJETO = "";
$EDITOR_TEXTUAL_OBJETO.= "<div class='dredre'>";
$EDITOR_TEXTUAL_OBJETO.= "<div>";
$EDITOR_TEXTUAL_OBJETO.= "<input type='text' id='nuevo_objecto' />";
$EDITOR_TEXTUAL_OBJETO.= "<select>";
foreach($combos as $com=>$bos){ $EDITOR_TEXTUAL_OBJETO.= "<option value='$com'>$bos</option>"; }
$EDITOR_TEXTUAL_OBJETO.= "</select>";
$EDITOR_TEXTUAL_OBJETO.= "</div>";
$EDITOR_TEXTUAL_OBJETO.= "<div style='position:relative;'>";
$EDITOR_TEXTUAL_OBJETO.= "<textarea id='jjjsonproy' class='flext growme' style='border:2px solid #666; background-color:#f5f5f5;'>";
$EDITOR_TEXTUAL_OBJETO.= "</textarea>";
$EDITOR_TEXTUAL_OBJETO.= "<a style='position:absolute;right:5px;top:0px;'
 href='#' onclick=\"javascript:procesar_proyecto(); return false;\" rel='nofollow' >procesar proyecto</a>";
$EDITOR_TEXTUAL_OBJETO.= "</div>";
$EDITOR_TEXTUAL_OBJETO.= "</div>";
$EDITOR_TEXTUAL_OBJETO.= "<script>";
$EDITOR_TEXTUAL_OBJETO.= "$('jjjsonproy').addEvent('keydown',function(event){if(event.key=='a'&&event.control){procesar_proyecto();};});";
$EDITOR_TEXTUAL_OBJETO.= "</script>";
*/

$Replace4Str=array(
					//'edicion_'
					'eliminar'
					,'editar'
					,'crear_pruebas'
					,'crear_quick'
					,'edicion_completa'
					,'edicion_rapida'
					,'visibilidad'
					,'calificacion'
					,'duplicar'
					,'expandir_vertical'
					,'exportar_excel'
					,'exportar_gm'
					,'importar_csv'
					,'buscar'
					,'busqueda_estricta'
					,'crear'
					,'stat'
					,'menu'
					,'disabled'
					,'web'
					,'page'
					,'user'
					);
$Replace4Ico=array(
					//''
					'<img src="img/ico_eliminar.png"/>'
					,'edit'
					,'<img src="img/ico_prueba	.png"/>'
					,'<img src="img/ico_quick.png"/>'
					,'<img src="img/ico_editarcomplete.png"/>'
					,'<img src="img/ico_editar.png"/>'
					,'<img src="img/ico_desactivar.png"/>'
					,'<img src="img/ico_star.png"/>'
					,'<img src="img/ico_duplicar.png"/>'
					,'expan_ver'
					,'<img src="img/ico_xls.png"/>'
					,'<img src="img/ico_gm.png"/>'
					,'<img src="img/ico_csv.png"/>'
					,'<img src="img/search.png"/>'
					,'BE'
					,'<img src="img/ico_plus.png"/>'
					,'<img src="img/ico_stat.png"/>'
					,'M'
					,'<img src="img/ico_disabled.png"/>'
					,'<img src="img/ico_www.png"/>'
					,'<img src="img/ico_page.png"/>'
					,'<img src="img/ico_user.png"/>'
					);


$indicesA=array(
				'M'=>'menu'

				,'C'=>'crear'
				,'Stat'=>'stat'
				,'Q'=>'crear_quick'
				,'Pru'=>'crear_pruebas'

				,'E'=>'editar'
				,'EC'=>'edicion_completa'
				,'ER'=>'edicion_rapida'
				,'Dup'=>'duplicar'

				,'X'=>'eliminar'

				,'Vis'=>'visibilidad'
				,'Cal'=>'calificacion'
				,'B'=>'buscar'
				,'BE'=>'busqueda_estricta'
				,'O'=>'orden'
				//,'EV'=>'expandir_vertical'
				,'exX'=>'exportar_excel'
				,'exG'=>'exportar_gm'
				,'imX'=>'importar_csv'

				,'D'=>'disabled'

				,'W'=>'web'
				,'P'=>'page'
				,'U'=>'user'
				);

				/*

$MEactions='forecolor bold italic underline | justifyleft justifyright justifycenter justifyfull | insertunorderedlist insertorderedlist | undo redo removeformat | createlink unlink | indent outdent | tableadd tableedit tablerowadd tablerowedit tablerowdelete tablecoladd tablecoledit tablecoldelete | toggleview';

$MEbaseCSS='html{ height: 100%; cursor: text; } body{ font-family:calibri; font-size:12px; } h2{font-size:20px;font-weight:bold; color:#222;} h3{font-size:18px;font-weight:bold;color:#111;} h4{font-size:16px;font-weight:bold;color:#000;} h5{font-size:14px;font-weight:bold;color:#000;} h6{font-size:14px;font-weight:bold;color:#222; } table { border-collapse: collapse !important; border:0 !important; padding:0 !important; margin:0 !important; } table td,table th { padding:2px !important; margin:0 !important; }';


$HTACESS_INI='############################
#                          #
#        GENERALES         #
#                          #
############################

##
#Prioridad de archivos índices (por defecto)
##
DirectoryIndex index.html index.php

##
#Evitar acceso por el navegador a una carpeta sin "index":
Options All -Indexes

##
#Bloquea el acceso al .htaccess
##
<Files .htaccess>
Order allow,deny
</Files>

##
#Bloquea el acceso a config.ini
##
<Files config.ini>
Order allow,deny
Deny from all
</Files>

##
#Quita los Etags ( como recomienda YSLOW )
##
#Remover Etags
FileETag none

##
#Codificación UTF-8 por defecto
##
AddDefaultCharset UTF-8


############################
#                          #
#      COMPRESIÓN          #
#                          #
############################

##
#Compresión PHP de arhicovos PHP y JS, con CSS aún
##
#<FilesMatch "css\.css$">
#AddHandler application/x-httpd-php .css
#</FilesMatch>
#AddHandler application/x-httpd-php .js
#php_value output_handler ob_gzhandler


############################
#                          #
#          CACHÉ           #
#                          #
############################

##
#Configura caché ( como lo recomienda YSLOW )
##
<IfModule mod_expires.c>


	<FilesMatch "\.(jpg|jpeg|png|gif|ico)$">

	ExpiresActive On
	ExpiresDefault A31536000

	</FilesMatch>

	<FilesMatch "\.(js|css)$">

	ExpiresActive On
	ExpiresDefault A31536000

	</FilesMatch>

	<FilesMatch "\.(flv|swf)$">

	ExpiresActive On
	ExpiresDefault A31536000

	</FilesMatch>

	<FilesMatch "\.(html|php|htm)$">

	ExpiresActive On
	ExpiresDefault A0

	</FilesMatch>


</IfModule>
';

$HTACESS_END='###########    BASICOS   ###########

RewriteRule ^robots.txt$ robots.txt [L]
RewriteRule ^(panel|sistema|sistemas)/?$ panel/index.php [L,r=301,NC]
RewriteRule ^maqueta$ maqueta/index.html [L,r=301]
RewriteRule ^email$ email/index.php [L,r=301]
RewriteRule ^error$ index.php?modulo=error&tab=404 [L]
RewriteRule ^comming$ index.php?modulo=comming [L]

##

########   ERROR 404   ###########

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
#RewriteRule (.*) index.php?modulo=error&tab=404 [L]

###

</IfModule>';

*/


// echo '<pre>';print_r($SERVER);echo '</pre>';

$HTML_ALL_INICIO    = '<div id="div_allcontent" ><div id="div_contenedor" >';

$HTML_MAIN_INICIO   = '<div class="contenido_principal '. ( (  ($SERVER['ARCHIVO']!='login.php') and $_COOKIE['men'])?'menu_colapsed':'' ) .'" id="contenido_principal"  >';

$HTML_CONTENT_INICIO= '<div class="line_content">';

$HTML_CONTENT_FIN 	= '</div>';

$HTML_ALL_FIN		= '</div></div>';

$HTML_ALL_FIN		= '</div></div>';

$HTML_ESQUINAS_ARRIBA    = '';

$HTML_ESQUINAS_ABAJO    = '';

define(HTML_ALL_INICIO,$HTML_ALL_INICIO);
define(HTML_MAIN_INICIO,$HTML_MAIN_INICIO);
define(HTML_MAIN_FIN,$HTML_MAIN_FIN);
define(HTML_ALL_FIN,$HTML_ALL_FIN);

$HTML_ALL_INICIO="<div id='layer'></div>".$HTML_ALL_INICIO;

/*

	show_variables2(get_defined_vars(),[
		'_GET','_POST','_COOKIE','_FILES','_SERVER','_REQUEST','_ENV','_GLOBALS','GLOBALS',
		'Array_Meses','Array_Horas','Array_Horas2','COMANDOS_OBJETO',
		'vars','vars_global','vars_server','vars_server_mysql','vars_server_ftp',
		'SERVER','LOCAL0',
		// 'unodos',
		// 'datos_tabla',
		// 'tabla_sesion_datos_objeto',
		]);
	function show_variables2($debug,$except=[]){

		$debug_keys=array_keys($debug);
	
		foreach($debug_keys as $debug_key){
			if(in_array($debug_key,$except)){
				unset($debug[$debug_key]);
			}
		}
		echo '<pre>';print_r($debug);echo '</pre>';die();
		
	}
*/

// echo '<pre>'; print_r($SERVER); echo '</pre>';