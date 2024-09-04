<?php


if(isset($_GET['ran']) and $_GET['ran']!=''){

	include("objeto.php");

}

$CUSTOM_VIEWS=$PATH_CUSTOM."views/dist/";

// prin($_GET);
// prin($tbquery);


$galleta='galleta';
$sesionhid='sesionhid3';

// prin($objeto_tabla_comp['PRIMARY_SHARES']);

// echo ($IS_MOBILE)?"es movil":"no es movil";

//forNACYN
if(isset($_GET[$galleta])){

	if($_SESSION[$sesionhid]!='unlocked'){

		echo '<div class="ingreseclave"><form method="post">
		CLAVE: <input name="clavesecreta">
		<input type="submit" value="ENVIAR">
		</form></div>';

	} else {

		redir(str_replace("?".$galleta,"",$SERVER['RUTA']));

	}

	if($_POST['clavesecreta']=='chaluja'){

		$_SESSION[$sesionhid]='unlocked';
		redir(str_replace("?".$galleta,"",$SERVER['RUTA']));
		// prin($SERVER);

	}

}


// if($_SESSION[$sesionhid]=='unlocked'){

// 	prin('unlocked');
// 	prin($_SESSION);

// }
$_GET['filter']=(substr($_GET['filter'],-1,1)=="'")?substr($_GET['filter'],0,-1):$_GET['filter'];
$_GET['filter']=(substr($_GET['filter'],0,1)=="'")?substr($_GET['filter'],1):$_GET['filter'];

// prin($_GET['filter']);

parse_str($_GET['filter'],$oouutt);


$filtros123=getStringFilters($oouutt,$objeto_tabla,$this_me);

// prin($filtros123);

if($_GET['ran']!=1){ 

	echo '<div style="display:none;">';
	include_once($objeto_tabla[$this_me]['onload_include']);
	echo '</div>';
	
}

include("setup.php");

if($_GET['ran']==0){ unset($_GET['ran']); }


//prin(sizeof($objeto_tabla[$this_me]['campos']));

// prin($SERVER);
// prin($_SERVER);

// prin($_GET);
// prin($objeto_tabla[$this_me]);

$DeRecha=array(
''=>'linea_derecha_inicio',
'1'=>'linea_derecha_inicio',
'2'=>'linea_derecha_inicio',
);




$joinss=array();




if(1){

	// ! HACKEA PARAMETROS con variable CONF2
	if($_GET['conf2']){
		// var_dump($datos_tabla);
		$_GET['conf']=urldecode($_GET['conf2']);
		$confes=explode("&",$_GET['conf']);
		// prin($confes);
		foreach($confes as $confe){
			list($uno,$dos)=explode("=",$confe);
			if(enhay($uno,"|")){
				
				//var_dump($uno);
				list($tres,$cuatro)=explode("|",$uno);
				$objeto_tabla[$_REQUEST['OB']]['campos'][$tres][$cuatro]=$dos;

			} else {

				$objeto_tabla[$_REQUEST['OB']][$uno]=$dos;

			}
		} 
		
		unset($confes); unset($confe); unset($uno); unset($dos); unset($tres); unset($cuatro);

		if(isset($_GET['conf2'])) unset($_GET['conf2']);


		$datos_tabla = procesar_objeto_tabla($objeto_tabla[$_REQUEST['OB']]);

	}

// prin($datos_tabla);

	

	if(0){
		if($datos_tabla['set_fila_fijo']){	

			$_COOKIE[$tb.'_colap']=$datos_tabla['set_fila_fijo']; 
			$ocultar_opciones_filas=1;	

		}

		// $_COOKIE[$tb.'_colap']=(isset($_COOKIE[$tb.'_colap']))?$_COOKIE[$tb.'_colap']:(($datos_tabla['por_linea']>1)?1:(($tblistadosize>6)?4:1));
		
		$_COOKIE[$tb.'_colap']=(isset($_COOKIE[$tb.'_colap']))?$_COOKIE[$tb.'_colap']:(($tblistadosize>6)?4:1);

	}
	$ocultaresquina=($tblistadosize<8)?1:0;


	
	if(!isset($_GET['ran']) or $_GET['ran']==''){


		//EVAL
		if(isset($datos_tabla['script'])){
			
			eval($datos_tabla['script']);

		}


		echo '<input type="hidden" id="resaltar"  />';

	    if($_GET['block']!='form'){

			echo '<div class="div_bloque_cuerpo" '. ( ($datos_tabla['width_listado'])?"style=\"width:".$datos_tabla['width_listado'].";\"":"" ) .' >';

				echo '<div class="refreshing" id="refresh" style="display:none;">cargando lista.....</div>';

				echo '<div class="refreshing2" id="cargando_form" style="display:none;">cargando formulario....</div>';
				//echo "<div>ocho</div>";
				//echo show_parent($_GET,$objeto_tabla,$datos_tabla['me']);

				//////////////////////////////////////////////////////////////////////////////////////////////////////////
				//		formulario inicio 		//////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////////////////////////

				if($Open){ $datos_tabla['crear']='1'; }
				//prin($SERVER);

				include("vista/titulo_bar.php");


		} else {


			$_COOKIE[$tb.'_colap']=($_GET['tipo']=='listado')?4:0;


		}

	?>
	<div id="bloque_content_crear" class="bloque_content_crear">
	<?php 
		if( ($Proceso=='login') or ($_GET['block']=='form') or ($datos_tabla['crear_quick']=='1') ){ 
			include("formulario.php"); 
		?>
		<script>window.addEvent('load',function(){ pre_crear(); });</script>
	<?php 
		} 
	?>
	</div>

	<div id="bloque_content_stat" class="bloque_content_stat"></div>
	<div id="bloque_content_mass" class="bloque_content_mass"></div>
	<div id="bloque_content_repos" class="bloque_content_repos"></div>

	<?php
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	//		formulario fin 		//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////


	if($_GET['i']!=''){
		if($datos_tabla['include_detail_before']!='') 
			include($CUSTOM_VIEWS.$datos_tabla['include_detail_before']);
	} else {
		if($datos_tabla['include_list_before']!='')        
			include($CUSTOM_VIEWS.$datos_tabla['include_list_before']);
	}

	echo '<div class="inner_listado" '.
		 ' id="inner" '.
		 ' style=" width:100%; ';

	if($_GET['block']=='form' and $_GET['tipo']!='listado'){ 
		echo 'width:50%; float:left;'; 
	}

	echo '" >';


		///// ZONA AJAX INICIO  ////

		//////////////////////////////////////////////////////////////////////////////////////////////////////////
		//		listado inicio	//////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////

		}


		if (!$_COOKIE[$MEEE['prefijo'].'_colap']){
			$_COOKIE[$MEEE['prefijo'].'_colap']='modificador_grilla';
		} 

		if($_GET['format']!='excel')
		if($_GET['i']!=''){
			echo "<div>";
		} else {


			echo "<div id='list_".$tb."' class=' ";
			echo " body_".$_COOKIE[$MEEE['prefijo'].'_colap'];
			echo " '>";
			// echo "body_".$_COOKIE[$MEEE['prefijo'].'_colap'];
		}




		$listable_after  = [];
		$listable_end    = [];

		$tblistado_after = [];
		$tblistado_end   = [];


		// !
		// ! GET LOS CAMPOS PARA EL LISTADO
		// !
		foreach($tblistado as $zapati)
			if($zapati['listable']=='1') 
				$tillas[]=$zapati['campo'];
		


		$first_listable=$tillas[0];
		

		$last_listable=end($tillas);




		/*
		######## #### ##       ######## ######## ########   ######
		##        ##  ##          ##    ##       ##     ## ##    ##
		##        ##  ##          ##    ##       ##     ## ##
		######    ##  ##          ##    ######   ########   ######
		##        ##  ##          ##    ##       ##   ##         ##
		##        ##  ##          ##    ##       ##    ##  ##    ##
		##       #### ########    ##    ######## ##     ##  ######
		*/


		include("vista/vista_filters.php");




		foreach($tblistado as $df){
							
			$tblistado2[]=$df;
			if(isset($tblistatado_after[$df['campo']])){
				// prin($tblistatado_after[$df['campo']]);
				foreach($tblistatado_after[$df['campo']] as $ffdd){
					$tblistado2[]=$ffdd[1];
				}
				
			}

		} unset($df);


		$tblistado=$tblistado2;


		$tblistado=array_merge($tblistado,$tblistado_end);

		




		/*prin($tblistadosize);	*/

	    if($tblistadosize!='0'){


			if($_GET['i']!=''){

				//$busqueda_query = " ".$_GET['filter']." ";
				$busqueda_query = " and ".$tbl.".id = '".$_GET['i']."' ";
				$linkPagina = "pagina_file";
				$linkRecPagina = "recargar_file";
				$vvvalos = $_GET['i'];
				$_COOKIE[$tb.'_colap']='2';
				$datos_tabla['order_by']='';

			}elseif($_GET['filter']!=''){

				//$busqueda_query = " ".$_GET['filter']." ";
				$query_filter_parts=query_filter($FiL);
				foreach($query_filter_parts['joins'] as $joi){
					$joinss[$joi]=$joi;
				}
				// $join_query = "\n".implode("\n",);
				$busqueda_query = " and ( ".$query_filter_parts['filter']." ) ";
				$linkPagina = "pagina_filter";
				$linkRecPagina = "recargar_filter";
				$vvvalos = $_GET['filter'];


				// prin($vvvalos);
				
			}elseif($FilTro!=''){

				$busqueda_query = " and ( ".$FilTro." ) ";
				$linkPagina = "pagina_filtro";
				$linkRecPagina = "recargar_filtro";
				$vvvalos = $FilTro_l;

			} elseif($_GET['buscar']!=''){

				if(is_numeric($_GET['buscar'])){
					
					// prin($_GET);
					$numbuscar=contar($tbl,"where ".$tbl.".id = '".$_GET['buscar']."'",1);
					if($numbuscar==1){
						redir("?i=".$_GET['buscar']);
					}
				}

				$busqueda_query = search_query($datos_tabla['fulltext'],$datos_tabla['like'],$datos_tabla['id'],$_GET['buscar']);
				$linkPagina = "pagina_buscar";
				$linkRecPagina = "recargar_buscar";
				$vvvalos = $_GET['buscar'];

			} else {

				$busqueda_query = "";
				$linkPagina = "paginaUrl";
				$linkRecPagina = "recargar";
				$vvvalos = "";

			}

	//		prin($datos_tabla);
			//update_tags($objeto_tabla[$this_me],162);
			/*
			$tbcampos	=	$datos_tabla['form'];
			$tblistado	=	$datos_tabla['list'];
			$tbquery	=   $datos_tabla['query'];
			*/
			
			/*prin($datos_tabla['query']);*/
			
			if($_GET['i']!='' ){

				// $tblistado	=	$datos_tabla['list'] = $datos_tabla['form'];
				$tblistado	=	$datos_tabla['list']=$MEEE['campos'];


				foreach($tblistado as $tblistado_item){
					
					$tblistado3[$tblistado_item['campo']]=$tblistado_item;

				}
								

				foreach($MEEE['campos'] as $tblistado_item){
				
					$tblistado3[$tblistado_item['campo']]=$tblistado_item;

				}	


				
			
				

				// prin($tblistado3);

				$tblistado=$tblistado3;
				


				//$array=$MEEE;
				// prin($datos_tabla['list']);

				
				if(is_array($datos_tabla['list']))
				foreach($datos_tabla['list'] as $tyt=>$camp){
			
					if( $camp['disabled']=='1' ){ continue; }

					if( 
						in_array($camp['tipo'],array('fed','pos','vis','cal')) 
						and $camp['listable']!='1'
					){ continue; }

					if( 
						in_array($camp['tipo'],array('hid')) and !isset($camp['opciones']) and $camp['foreig']!=1
					){ continue; }

					
					if( $camp['campo']!=$array['group'] and $camp['autotags']!='1' ){


						$tblistado[$tyt]['listable']='1';
						$datos_tabla['list'][$tyt]['listable']='1';
						$query[]=$camp['campo'];

					}

				}
				
				$tbquery= $datos_tabla['query']= $query;

			
			}

			


			$tbquery_items=$tbquery;	
			$tbquery=array();
			$join_query_arr=array();
			$join_query_arr2=array();

			foreach($tbquery_items as $tbquery_item)
			{
				list($tbquery_item,$asas)=explode(" as ",$tbquery_item);

				$tbquery_item_parts=explode(";",$tbquery_item);
				if(sizeof($tbquery_item_parts)>1){
					$tbquery_item0="concat(".$tbl.".". str_replace(";",",' ',".$tbl.".",$tbquery_item) .")";
				} else {
					$tbquery_item0=$tbl.".".$tbquery_item;
				}

				$asas=($asas)?$asas:$tbquery_item;
				
				$tbquery[]=$tbquery_item0." as ".$asas;
				
			}
			foreach($listable_end as $campokey => $tblque)
			{
				if($campokey!=''){
					$joinss[$tblque['tabla']]=$tblque['tabla'];
					$tbquery[]=$tblque['tabla'].".".$campokey." as ".$campokey;	
					$tbquery0[]=$campokey;
				}
			}
			$join_query='';
			foreach($joinss as $tttiii=> $joi_)
			{
				$onn=explode(".",$datos_tabla['joins'][$joi_]);
				$jqnext[$tttiii]=$onn[0];
				$join_query_arr[$tttiii]="\n left join ".$joi_." on ".$datos_tabla['joins'][$joi_]." ";
			}

			// prin($jqnext);

			foreach($join_query_arr as $tttiii=>$joi_)
			{
				$join_query_arr2[$jqnext[$tttiii]]=$join_query_arr[$jqnext[$tttiii]];
				$join_query_arr2[$tttiii]=$join_query_arr[$tttiii];
			}

			foreach($join_query_arr2 as $joi_)
			{
				$join_query.=$joi_;
			}
			// prin($join_query);
			/*			
			$joins[$FA0]=" left join ".$FA0." on ".$joi[$FA0]." ";
			prin(sizeof($tbcampos));
			prin(sizeof($tblistado));
			prin(sizeof($query));
			*/
			//prin($SERVER);
			//prin($vars['GENERAL']['mostrar_toolbars']);

			$extra_where='';
			if($datos_tabla['extra_where']){

				$extra_where=$datos_tabla['extra_where'];

				if(
					preg_match_all('/{+(.*?)}/', $extra_where, $matches)
					) {
				   foreach($matches[1] as $match){

				    	$extra_where =str_replace('{'.$match.'}', $_GET[$match], $extra_where);
				   }
				}


			}



			if($_GET['format']=='excel'){		

				/*
				######## ##     ##  ######  ######## ##
				##        ##   ##  ##    ## ##       ##
				##         ## ##   ##       ##       ##
				######      ###    ##       ######   ##
				##         ## ##   ##       ##       ##
				##        ##   ##  ##    ## ##       ##
				######## ##     ##  ######  ######## ########
				*/
				include('excel.php');
			
			// } elseif($_GET['ran']=='1') {
			} else {


				// $_GET['debug']='1';
				// prin(	prin($tbquery);
				// $datos_tabla['where_id']);
				// prin($MEEE);
				
				// prin($datos_tabla['where_id']);

				

				$Inner=($_GET['inner'])?$_GET['inner']:'inner';
				$Mode=($_GET['mode'])?$_GET['mode']:'';
				$M_W=($_GET['mw'])?$_GET['mw']:'';



				if($_GET['middlewarelist']!=''){


					include_once($PATH_CUSTOM."controllers/controller_".$_GET['middlewarelist'].".php");

				} else {
					// prin($datos_tabla);

					$pagina_items=paginacion(
						[
							'separador'    =>''
							,'porpag'      =>($LOCAL and $vars['GENERAL']['mostrar_toolbars'])?20:$datos_tabla['por_pagina']
							// ,'porpag'      =>1
							,'anterior'    =>'&laquo;'
							,'siguiente'   =>'&raquo;'
							,'enlace'      =>"#"
							,'onclick'     =>"ax(\"". $linkPagina ."\",\"". urlencode($vvvalos) ."\",PAG,'".$MEEE['me']."','".$Inner."','".$datos_tabla['get_id']."','".$Mode."','".$M_W."');return false;"
							/*,'onclick':'go_page'*/
							,'tren_limite' =>'5'
							,'tipo'        =>'data',
							'noquery'	   => ( 
								0 ||
								$_GET['nc']==1 || 
								( $_GET['i']=='' && $_GET['ran']!=1 && $datos_tabla['nocharge']==1 )
							),
						],
						$tbquery,
						$tbl,
						$join_query
						. "\n where 1 "
						. "$EXTRA_FILTRO $busqueda_query ".$datos_tabla['where_id']
						. "\n $extra_where"
						
						. ( ($FilTro_o=='')?'':$FilTro_o."," )

						// . ( ($datos_tabla['group'])?' '.$datos_tabla['group'].' desc, ':'' )

						. "\n order by "
						. ( ($datos_tabla['order_by']=='')? (  $tbl.".".$datos_tabla['id']." ". (($datos_tabla['orden']=='1')?"desc":"asc") ):$datos_tabla['order_by'] )
						,
						(0 or ($_GET['debug']=='1') )

					);


				}

				
				if(0 or ($_GET['debug']=='1'))
					prin(array(
						'EXTRA_FILTRO'=>$EXTRA_FILTRO,
						'busqueda_query'=>$busqueda_query,
						'where_id'=>$datos_tabla['where_id']
					));


			}

			

			$lineas          = $pagina_items['filas'];
			// prin($lineas);
			$paginas_linea   = $pagina_items['tren'];
			$anterior_linea  = $pagina_items['anterior'];
			$siguiente_linea = $pagina_items['siguiente'];
			
			$total_linea     = $pagina_items['total'];
			$desde_linea     = $pagina_items['desde'];
			$hasta_linea     = $pagina_items['hasta'];
			
			$lineassize      =sizeof($lineas);
			
			if( $_GET['i']=='' && $_GET['ran']!=1 && $datos_tabla['nocharge']==1)
			{
				$lineas=[];
			}

			if(function_exists("onload_include_after_query")){

				onload_include_after_query();
				
			}

			// prin($oouutt);

			?>
			<input type="hidden" id="nfilter" value="filter='<?=str_replace("&","%26",http_build_query($oouutt))?>'" style="width:100%;">

			<input type="hidden" id="linkopagina" style="width:100%;" value="<?=$linkPagina?>" >

			<input type="hidden" id="linkovals" style="width:100%;" value="<?=urlencode($vvvalos)?>" >

			<input type="hidden" id="ffilter" style="width:100%;" value="<?=urlencode($_GET['filter'])?>" >

			<input type="hidden" id="pagina" style="width:100%;" value="<?=(($_GET['pag']=='')?"1":$_GET['pag'])?>"  />
			<!-- //echo '<input type="hidden" id="tipolista" value="'.$linkRecPagina.'"  />'; -->
			
			<input type="hidden" id="edit_hidd" style="width:100%;"  />

			<div class="cover" id="refresh-cover" style="display:none;"></div>
			
			<?php 
				// prin($_GET);
				if($_GET['i']==''){ ?>
				<input type="hidden" id="get_request"  style="width:100%;" value='<?php 
					echo trim(json_encode(
						array_merge($_GET,['get_id'=>$datos_tabla['get_id']])
					)); 
					?>' />
			<?php } 
				
			?>

		<?php

		// if($_GET['mode']!='sub')
		if($_GET['i']==''){
			

			// prin($html_filter_fecha_A);

			if($_GET['buscar']!='' or $_GET['filter']!='' or (sizeof($html_filter_A)>0) or (sizeof($html_filter_fecha_A)>0) ){

				echo '<div class="controls-rows" id="control_filters">';


				// echo '<div style="'.$display_barra.'">';

				$vars['GENERAL']['controles_listados']=($vars['GENERAL']['controles_listados'])?$vars['GENERAL']['controles_listados']:1;





				/*
				MENU
				######   #######  ##          ###    ########   ######  ######## ########
				##    ## ##     ## ##         ## ##   ##     ## ##    ## ##       ##     ##
				##       ##     ## ##        ##   ##  ##     ## ##       ##       ##     ##
				##       ##     ## ##       ##     ## ########   ######  ######   ##     ##
				##       ##     ## ##       ######### ##              ## ##       ##     ##
				##    ## ##     ## ##       ##     ## ##        ##    ## ##       ##     ##
				######   #######  ######## ##     ## ##         ######  ######## ########
				*/
				/*
				?>
				<span class="mmm">
					<a id="msino"
					title="Ocultar menú" 
					onclick='document.body.classList.add("menu_colapsed");fetch("ajax_change_cookie.php?var=men&val=1&ajax=1");return false;'></a>
					<a id="mnosi"
					title="Mostrar menú"
					onclick='document.body.classList.remove("menu_colapsed");fetch("ajax_change_cookie.php?var=men&val=0&ajax=1");return false;'></a>
				</span>				
				<?php
				*/




				/**
				 * RENDER FILTROS
				 */
				
				// $html_filter="<div class='byother'>".implode("\n",$html_filter_A)."</div>";
				$html_filter=implode("\n",$html_filter_A);

				echo "<div class='filters form-group' id='dfilters' >".
					implode("\n",$html_filter_fecha_A).$html_filter.
				"</div>";


				echo $htmlfil;

				/*
				########  ##     ##  ######   ######     ###    ########
				##     ## ##     ## ##    ## ##    ##   ## ##   ##     ##
				##     ## ##     ## ##       ##        ##   ##  ##     ##
				########  ##     ##  ######  ##       ##     ## ########
				##     ## ##     ##       ## ##       ######### ##   ##
				##     ## ##     ## ##    ## ##    ## ##     ## ##    ##
				########   #######   ######   ######  ##     ## ##     ##
				*/			

				include("vista/vista_buscar.php");

				echo "</div>";

			}


		}

		
		if($datos_tabla['include_list']!='') {

			if($datos_tabla['include_controller']!='') {

				include($PATH_CUSTOM.'controllers/'.$datos_tabla['include_controller']);

			}
			
			include($CUSTOM_VIEWS.$datos_tabla['include_list']);

		} else {

			echo "<div class='controls-rows' >";

				echo "<div id='barra_paginacion'>";

				/* RENDER
				########     ###     ######   #### ##    ##    ###     ######  ####  #######  ##    ##
				##     ##   ## ##   ##    ##   ##  ###   ##   ## ##   ##    ##  ##  ##     ## ###   ##
				##     ##  ##   ##  ##         ##  ####  ##  ##   ##  ##        ##  ##     ## ####  ##
				########  ##     ## ##   ####  ##  ## ## ## ##     ## ##        ##  ##     ## ## ## ##
				##        ######### ##    ##   ##  ##  #### ######### ##        ##  ##     ## ##  ####
				##        ##     ## ##    ##   ##  ##   ### ##     ## ##    ##  ##  ##     ## ##   ###
				##        ##     ##  ######   #### ##    ## ##     ##  ######  ####  #######  ##    ##
				*/	

				include("vista/vista_paginacion.php");

				echo "</div>";

				if($pagina_items['total']!=0 and $_GET['i']==''){

					/*
					##     ## ######## ##    ## ##     ##    ##       ####  ######  ########    ###    ########   #######
					###   ### ##       ###   ## ##     ##    ##        ##  ##    ##    ##      ## ##   ##     ## ##     ##
					#### #### ##       ####  ## ##     ##    ##        ##  ##          ##     ##   ##  ##     ## ##     ##
					## ### ## ######   ## ## ## ##     ##    ##        ##   ######     ##    ##     ## ##     ## ##     ##
					##     ## ##       ##  #### ##     ##    ##        ##        ##    ##    ######### ##     ## ##     ##
					##     ## ##       ##   ### ##     ##    ##        ##  ##    ##    ##    ##     ## ##     ## ##     ##
					##     ## ######## ##    ##  #######     ######## ####  ######     ##    ##     ## ########   #######
					*/
					include("vista/vista_menu_listado.php");   	
					
				}

			echo "</div>";


			$numero_de_campo_en_lista=$tblistadosize-4;

			$needs['html']=0;

			// prin($tblistado);
			?>
			<div class="listado_grilla <?php
			echo ''
			." ".( ($_GET['i']!='')?' detail ':'' )
			.'';
			?>">
				
				<?php 

				echo '<ul '.
				( ( ($_GET['i']=='') or 0)?' id="ordenable" ':'' ).
				'>';

					include("vista/vista_items.php"); 

					if($pagina_items['total']==0){
						echo '<div class="nohay">';
						if($pagina_items['total']!='nc')
							echo '0 '.$datos_tabla['nombre_plural'];
						echo '</div>';
					}		

				echo '</ul>';

				?>
				
			</div>

			<?php

		}

	}

	?>
	<script language="javascript">

		window.addEvent('domready',function(){
			// console.log('uno menos zeta');
			// console.log('a ver');
	        ax('actualizar_total',this.value);
			// console.log('no ver');
			if(document.getElementById('error_creacion')){
				document.getElementById('error_creacion').innerHTML='';
			}
		});

	</script>
    <?php

	echo "</div>";

	/* ?></div><?php */

	// FIN AJAX
	
	

	if(!isset($_GET['ran']) or $_GET['ran']==''){

		echo "</div>";
		
		if($_GET['i']!=''){
			// prin($MEEE);
			// prin($linea);
			if($datos_tabla['include_detail_after']!='') 
				include($CUSTOM_VIEWS.$datos_tabla['include_detail_after']);

		} else {

			if($datos_tabla['include_list_after']!='')        
				include($CUSTOM_VIEWS.$datos_tabla['include_list_after']);
				
		}
		
		echo "<div id='inner_after' class='inner_listado'></div>";

		include("vista/vista_ax.php");

	}

}
//prin(0);

// prin($_GET);
?>
<script language="javascript">

if(window.location.hash=='#create'){ abrir_crear('1','0'); }


<?php if($_GET['i']!=''){ ?>
window.addEvent('load',()=>{
if($('ab_<?php echo $_GET['i']; ?>'))
$('ab_<?php echo $_GET['i']; ?>').fireEvent('mouseover');
// $('ab_<?php echo $_GET['i']; ?>').removeEvents('mouseover');
});
<?php } ?>

<?php if($datos_tabla['nocharge']=='1' && $_GET['i']==''){ ?>
window.addEvent('load',()=>{
ax("pagina","",1);
});
<?php } ?>
<?php if($_GET['filter']!='' or 1){ ?>

window.addEvent('load',()=>{
	// console.log(window.location.hash);
	if(window.location.hash!="#filter=''" && window.location.hash!=""){
		// alert('recargar');
		$('nfilter').value=window.location.hash.substring(1);
		ax('recargar_hash');
	}
});
<?php 
}
// function getQueryVariable(variable) {
//     var query = window.location.hash.substring(1);
//     var vars = query.split('&');
//     for (var i = 0; i < vars.length; i++) {
//         var pair = vars[i].split('=');
//         if (decodeURIComponent(pair[0]) == variable) {
//             return decodeURIComponent(pair[1]);
//         }
//     }
//     console.log('Query variable %s not found', variable);
// }

// console.log(getQueryVariable('filter'));
// ax('recargar_hash');
// // if(window.location.hash=='#filter='){ abrir_crear('1','0'); }
// /*
// var HM = new HashListener();
// //add an event listener to the manager
// HM.addEvent('hashChanged',function(new_hash){
//     console.log(new_hash);
// });
// */

?>
</script>