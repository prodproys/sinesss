<?php //á
set_time_limit(0);
//error_reporting(E_ALL);
include("lib/includes.php");

// $_GET['s']='nombre,nombre;apellidos;code;document_number|people|';

// prin($_GET);

if(!empty($_GET['dli'])) include($_GET['dli']);


$s1=explode("|",$_GET['s']);
// prin($s1);
// $s1[3]=" left join people on people.id=documents.id_persona ";

$s1['1']=trim($s1['1']);

$s2=explode(",",$s1['0']);
// prin($s2);
$s20=explode('.',$s2['0']);
if(empty($s20['1'])){
	$ID=$s1['1'].".".$s2['0'];
} else {
	$ID=$s2['0'];
}
// prin($ID);
$s3=explode(";",$s2['1']);
$s5=explode(" ",trim($_GET['q']));
foreach($s5 as $tio){
	$s6a[]=trim($tio);
}
// $s6="%".implode('%',$s6a)."%";
$s6=implode('%',$s6a);
// prin($s6);
/*
$EXTRA_FILTRO='';
$tablas1=trim($s1['1']);
foreach($objeto_tabla as $mememe=>$ot){
    if($ot['tabla']==$tablas1){
        list($MEEE,$EXTRA_FILTRO) = pre_procesar_objeto_tabla_0($objeto_tabla[$mememe]);
        break;
    }
}
*/

$s12=explode("order by",$s1['2']);

$lineas=select(
		array(
			$ID.' as i',
			"CONCAT_WS(' ',".implode(",",$s3).") as v"
		),
		$s1['1']." \n".
		$s1['3']." \n",
		render_concats($s12['0'],$s3,$s6,$s1['1'])." \n".
		// $EXTRA_FILTRO." \n".
		// ( ($_SESSION['xt'])?$_SESSION['xt']." \n":"" ).
		( ($s12['1'])?"order by ".$s12['1']:"\n " ).
		"limit 0,12",
		0);

if(!$lineas){ $lineas=array(); }

// prinx($lineas);

function render_likes($where,$likes,$Q){
	$html='';
	if($where!=''){ $html.=$where." "; } 
	else{ $html.='where 1 '; } 
	$html.=(sizeof($likes)>0)?' and ':'';

	foreach($likes as $lik){
	$Likes[]="\n $lik like '%".$Q."%' ";
	}
	$html.="( ".implode(" or ",$Likes)." )";

	// $html.="( ".
	// $html.="CONCAT_WS(' ',".implode(",",$likes).") like '".$Q."'";
	// $html.=" or ".
	// $html.="CONCAT_WS('',".implode(",",$likes).") like '%".$Q."%'";
	// $html.=") ".
	return $html;
}

			
function render_concats($where,$likes,$Q,$tabla){

	global $objeto_tabla;
	foreach($objeto_tabla as $mememe=>$ot){
		$file2OBJ[$ot['archivo']]=$mememe;
	}
	
	list($where,$dos)=explode("order by",$where);
	$orderby=($dos)?"order by ".$dos:"";
	$html='';
	if($where!=''){ $html.=$where." "; } 
	else{ $html.='where 1 '; } 
	$html.=(sizeof($likes)>0)?' and ':'';
	/*
	foreach($likes as $lik){
	$Likes[]=" $lik like '%".$Q."%' ";
	}
	$html.="( ".implode(" or ",$Likes)." )";
	*/
	// $html.="( ".
	$html.="CONCAT_WS(' ',".implode(",",$likes).") like '%".$Q."%'";

	if(function_exists('middleware_context_list')){
		list($me,$extra_filtro)=middleware_context_list($objeto_tabla[$file2OBJ[$tabla]]);
	}

	$html.=" $extra_filtro ";
	// $html.=" or ".
	// $html.="CONCAT_WS('',".implode(",",$likes).") like '%".$Q."%'";
	// $html.=") ".
	$html.=" ".$orderby;
	return $html;
	}

/*
$lineas=array();
$items=select($sss['0'],$sss['1'],str_replace("==","=",$sss['2']."=".$_GET['s2']),1	);
foreach($items as $item){
foreach($item as $dato){ $data[]=$dato; } 
$lineas[]=$data; unset($data);
}
prin($lineas);
exit();

	$lineas=select(
	$tbquery,
	$tbl,
	"where 1 $EXTRA_FILTRO $busqueda_query ".$datos_tabla['where_id']." 
	order by "
	. ( ($FilTro_o=='')?'':$FilTro_o."," )
	. ( ($datos_tabla['group'])?' '.$datos_tabla['group'].' desc, ':'' )
	. ( ($datos_tabla['order_by']=='')? (  $datos_tabla['id']." ". (($datos_tabla['orden']=='1')?"desc":"asc") ):$datos_tabla['order_by'] )
	,0);
	*/


// $lineas0[]=['i'=>'','v'=>''];
// $lineas0[]=['i'=>'','v'=>''];
// $lineas=array_merge($lineas0,$lineas);


echo str_replace("  "," ",json_encode($lineas));
	
