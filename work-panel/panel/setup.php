<?php //á

foreach($datos_tabla['form'] as $xamps){
	$u0=0;
	if($xamps['setup']!='' and $u0==0){ $u0=1;
		$uu0=explode(",",$xamps['setup']);
		foreach($uu0 as $uuu0){
			if(!hay($tbl,"where ".$xamps['campo']."='".$uuu0."'",0)){
				insert(array(
					$xamps['campo']=>$uuu0,
					'fecha_creacion'=>'now()',
					'visibilidad'=>'1'
				),$tbl,0);
			}
		}
	}
} unset($xamps); unset($u0);
