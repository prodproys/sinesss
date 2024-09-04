<?php

$tablas_creadas=$TABLAS_CREADAS;

$script_name=($MEEE['menu_forced'])?$objeto_tabla[$MEEE['menu_forced']]['archivo'].'.php':$SERVER["ARCHIVO"];
// $script_name=$SERVER["ARCHIVO"];

if($mostrar_menu)
{

	$menus   = [];

	foreach($objeto_tabla as $item)
	{
		if(isset($item['alias_grupo']) and ($item['alias_grupo']!='') ){	
			
			$ALIAS_GRUPO[$item['grupo']]=$item['alias_grupo'];
		}

	}

	
	foreach($objeto_tabla as $meit=>$item)
	{
		// prin($item);
		$mmm = '';

		if($item['menu_label']=='')
		{	
			$item['menu_label']=$item['archivo'];
		}

		if( 
			$item['menu']=='1' 
			or 
			($Open=='1' and $item['menu_label']!='' ) 
			or ($script_name=="maquina.php") 
		)
		{


			if(
				(
					// file_exists($DIR_CUSTOM.$item['archivo'].".php") and 
					in_array($item['tabla'],$tablas_creadas)
					and (!($item['disabled']=='1'))
				)
				or
				(
					!in_array($item['tabla'],$tablas_creadas) and $Open
				)
			)
			{

				

				$grupe=($item['grupo'])?$item['grupo']:'general';

				if($item['seccion'])
				{

					$mmmA[$grupe][]=[
						'class'=>"seccion_link_".$item['seccion'].' seccion',
						'text'=>$item['seccion'],
					];

				}
				
				// prin(  $item['archivo'].".php" .'=='.$item['archivo']);

				$bitselected=( 
					enhay( $script_name ,  $item['archivo'].".php" ) 
					or ($script_name==$item['archivo_hijo'].".php") 
				);

				if($bitselected)
					$grupo_will_selected[]=$grupe;
				
				$mmmA[$grupe][]=[
					'class'=>"".
						"menu_link_".$item['archivo']." ".
						(($bitselected) ? 'selected': '').
						"",
					'href'=>$DIR_CUSTOM.$item['archivo'].'.php',
					'text'=>$item['menu_label'].$item['archivo_padre'],
				];	
					

			}

			if(!in_array($item['grupo'],$grupi))
			{

				$grupi[]=$item['grupo'];

				if(trim($item['grupo'])!='')
				{
				
					$paddre=($ALIAS_GRUPO[$item['grupo']])?$ALIAS_GRUPO[$item['grupo']]:$item['grupo'];
					$paddre2=str_replace(
						array(" ",'á','é','í','ó',''), 
						array("_",'a','e','i','o','u'), 
						strtolower($paddre)
					);

					$GrupLiA[$item['grupo']]=[
						'ite'=>$item['titulo'],
						'item'=>$item['grupo'],
						'class'=>"group_link_".$item['grupo'],
						'text'=>$paddre,						
						];
						

				}
			}			

		}

		// apps
		if($item['app']!='')
		{
			$item['app']=str_replace("'","\"",$item['app']);

			$aps=explode("href=\"",$item['app']);

			foreach($aps as $ap)
			{ 
				list($ap,$ap2)=explode("\"",$ap);
				list($ap2,$ap3)=explode("<",$ap2);
				$ap2=str_replace(">","",$ap2);

				if(
					trim($ap)!='' 
					and trim($ap2)!=''
				)
				{
					$bitselected=(enhay($ap,$script_name)); 	

					$grupe=($item['grupo'])?$item['grupo']:'general';
					
					if($bitselected)
						$grupo_will_selected[]=$grupe;

					$mmmA[$grupe][]=[
						'class'=>($bitselected) ? 'selected': '',
						'href'=>$ap,
						'text'=>$ap2
					];	

				} 
			}	
		}			
		
	}

	
	foreach($grupo_will_selected as $one){

		$GrupLiA[$one]['checked']=true;

	}

	foreach($GrupLiA as $oo=>$rupo){

		if(sizeof($mmmA[$oo])>0)
			$GrupLiA[$oo]['items']=$mmmA[$oo];
		else
			unset($GrupLiA[$oo]);

	}

	// prin($GrupLiA);exit();

	// prin($GrupLiA,'GrupLiA');	exit();
	if(function_exists('middleware_menu')){
		$GrupLiA=middleware_menu($GrupLiA);
	}
	// prin($mmmA['ventas']);
	render_view(['grupos'=>$GrupLiA],'menu_left.php');

}
