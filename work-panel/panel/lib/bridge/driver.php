<?php //á
//echo '<div class="div_fila">';
$tet=0;
foreach($EsquemaT as $iidd=>$Esquema){

	$tet++;
	if($tet==1){ echo HTML_ALL_INICIO; echo HTML_MAIN_INICIO; }
	if($iidd=='canvas'){ echo "<div class='div_fila div_canvas'>\n"; }

	foreach($Esquema as $Linea){ //$Linea es fila
	
		if(!is_array($Linea)){ 
		echo '<div class="div_fila"><div class="div_columna div_col_1d1">'; 
		include(incluget($Linea)); 
		echo '</div></div>'; 
		} else {
			$numCols=sizeof($Linea);
			//$deepcol=(isset($Linea[0][0][0][0]))?1:0;
			$deepcol=0;
			echo '<div class="div_fila">';
			$Iii=0;
			foreach($Linea as $ii=>$Line){ //$Line es columna
					if((($numCols>1) or ($iidd=='canvas')) and !$deepcol){ 
					$width=($ii>100)?$ii:'';
					$Iii++;
					echo '<div class="div_columna div_col_'.($Iii).'d'.$numCols.'" '.( ($width)?'style="width:'.$width.'px;"':'' ).' >'; 
					}
					if(!is_array($Line)){ //echo '<div class="div_fila">'; 
					include(incluget($Line)); //echo '</div>';
					} else {
						foreach($Line as $ii1=>$Lin){ //echo '<div class="div_fila">';  //$Lin es fila
							if(!is_array($Lin)){ //echo '<div class="div_fila">'; 							
							include(incluget($Lin)); //echo '</div>';
							} else {
								$numCols2=sizeof($Lin);
								echo '<div class="div_fila">';
								$Iii2=0;								
								foreach($Lin as $ii2=>$Lin2){ //echo '<div class="div_fila">'; //$Lin2 es columna				
									if((($numCols2>1) or ($iidd=='canvas')) and $width==''){ 
									$width2=($ii2>100)?$ii2:'';
									$Iii2++;
									echo '<div class="div_columna div_col_'.($Iii2).'d'.$numCols2.'" '.( ($width2)?'style="width:'.$width2.'px;"':'' ).' >'; 
									}								
									if(!is_array($Lin2)){ //echo '<div class="div_fila">'; 									
										include(incluget($Lin2)); //echo '</div>';
									} else {
										//echo '<div class="div_columna div_col_'.($Iii2).'d'.$numCols2.'" '.( ($width2)?'style="width:'.$width2.'px;"':'' ).' >'; 
										foreach($Lin2 as $ii3=>$Lin3){ 
											echo '<div class="div_fila">'; 
											include(incluget($Lin3));
											echo '</div>';
										}
										//echo '</div>';
									}
									echo ((($numCols2>1) or ($iidd=='canvas'))and $width=='')?'</div>':'';					
								}
								echo '</div>';
							}
						} 
					}
					echo ((($numCols>1) or ($iidd=='canvas'))and !$deepcol)?'</div>':'';						
			}
			echo '</div>';
		}
	}
	
	if($iidd=='canvas'){ echo '</div>'; }
	if($tet==sizeof($EsquemaT)){ echo HTML_MAIN_FIN; echo HTML_ALL_FIN; }

}
