<?php

echo '<ul id="ldd_'.$linea[$datos_tabla['id']].'" class="ldd ';


if($datos_tabla['vis']!=''){ echo ($linea[$datos_tabla['vis']]=='0')?"oc":""; }

echo '" >';

// echo '<div class="truc"></div>';
// prin($linea);
$tbid=0;
$pdto=array();


// prin($tblistado[''])
foreach($tblistado as $tbli){
    $pdto[]=$linea[$tbli['campo']];
}

$fefe=1;
// var_dump($tblistado);


$controles_bufer=[];
$controles_crud=[];



foreach($tblistado as $tbli){



    if($tbli['listable']=='1'){

        $tbid++;
        //prin($linea);
        if($urd==1){
            if($tbli['controles']!=''){
                list($tbli['controles'],$controles)=getControles($tbli['controles'],$objeto_tabla);
                // prin($controles);
                $controlEs[$tbli['campo']]=$tbli['controles'];
                $load_foto[$tbli['campo']]=$controles['foto'][0]['obj'];
                if($controles['exists']){ 	$load_exists[$tbli['campo']]=$controles['exists']; }
                if($controles['file']){ 	$load_file[$tbli['campo']]=$controles['file']; }
                if($controles['subs']){ 	$load_subs[$tbli['campo']]=$controles['subs']; }
                if($controles['mensajes']){ $load_mensajes[$tbli['campo']]=$controles['mensajes']; }
            }
        }
        // prin($controles);
        $SuprimirLabel=(
                        (
                            strtolower($tbli['label'])=='nombre'
                            or strtolower($tbli['label'])==strtolower($datos_tabla['nombre_singular'])
                            or $tbli['label']=='Título'
                            or strtolower($tbli['label'])=='foto'
                            or strtolower($tbli['label'])=='fecha'
                            or strtolower($tbli['label'])=='vista'
                            or strtolower($tbli['label'])=='email'
                            or strtolower($tbli['label'])=='estado'
                            or strtolower($tbli['label'])=='web'
                            or strtolower($tbli['label'])=='categoría'
                            or strtolower($tbli['label'])=='tipo'
                            or strtolower($tbli['listhtml'])=='1'
                            or strtolower($tbli['campo'])==strtolower($datos_tabla['group'])
                        )
                        and 
                            $tbli['listable']=='1'											
                        )?1:0;

        $nuevoDad='';

        if(strtolower($tbli['campo'])==strtolower($datos_tabla['group'])){
            $nuevoDad='od';
            if($groupvalue!=$linea[$datos_tabla['group']]){
                $groupvalue=$linea[$datos_tabla['group']];
                $nuevoDad='nd';
            }
        }

        if($fefe==1){

            $Firstmain=(
                            strtolower($tbli['label'])=='fecha'
                            or enhay(strtolower($tbli['label']),'nombre')
                            or strtolower($tbli['label'])==strtolower($datos_tabla['nombre_singular'])
                            or $tbli['label']=='Título'

                            or strtolower($tbli['label'])=='código'
                            or strtolower($tbli['label'])=='código'
                            or strtolower($tbli['campo'])=='code'
                            
                            or strtolower($tbli['label'])=='numero'
                            or strtolower($tbli['label'])=='número'
                            or strtolower($tbli['campo'])=='nombre'
                            or strtolower($tbli['campo'])=='name'
                            or $tbli['campo']=='fecha_creacion'
                            )?1:0;
            if($Firstmain) $fefe=0;

        } else $Firstmain=0;

        

        $nomodificar=(
                        //strtolower($tbli['label'])=='fecha' or
                        strtolower($tbli['label'])=='email'
                        )?1:0;

        $poner_title=(
                        (
                        $tbli['tipo']!='com'
                        and $SuprimirLabel
                        and !$nomodificar
                        )
                     or ($tbid==1)
                     or $tbli['tipo']=='pas'
                    )?1:0;
        
        $tbli['controles']=($tbli['control']=='0')?'':procesar_controles_html($controlEs[$tbli['campo']]);

        $tbli['width']=($tbli['width']=='' or $tbli['width']=='0px')?"":"width:".$tbli['width'].";";

        echo ($tbli['legend']!='' and $_GET['i']!='')?'<li class="bld legend">'.$tbli['legend'].'</li>':'';


        echo '<li '.
         ' style="'. $tbli['width'].'" '.
         ' class="bld '.
         ( ($_GET['i']!='')?$DeRecha[$tbli['derecha']]:'' ).' '.
         (($Firstmain and !$nomodificar and $tbli['listhtml']!='1')?'lifmf':'').' '.
         (($tbli['tipo']=='check')?'lchk':'').' '.
         (($tbli['tipo']=='id')?'lid':'').' '.
         ((in_array($tbli['tipo'],array('txt','html')))?'ltxt':'').' '.
         (($tbli['listclass'])?$tbli['listclass']:'').' '.
         $nuevoDad.'" >';

            if($tbli['tipo']=='inp' and $load_foto[$tbli['campo']]!=''){

                $obj=$load_foto[$tbli['campo']];
                $hayfotoexterna=render_foreig_foto($objeto_tabla[$obj],$linea[$datos_tabla['id']]);
                
            }

            //CHECK
            if($tbli['tipo']=='check')
            {
                ?><b class="nc sp"><?php
                if($urd=='1'){
                    ?><input type=checkbox onchange="var s=(this.checked)?true:false; s2=(this.checked)?'add':'remove'; $$('.chk').each(function(cc){ $(cc).checked=s; if(s){ $('i_'+$(cc).getAttribute('data-chk')).addClass('selectd'); } else { $('i_'+$(cc).getAttribute('data-chk')).removeClass('selectd'); } });" ><?php
                } else {
                    ?>&nbsp;<?php
                }
                ?></b><div class="bd" style="width:auto;"><input class="chk" data-chk="<?php echo $linea[$datos_tabla['id']]; ?>" type="checkbox"
                onchange="var ee='i_'+this.getAttribute('data-chk'); if(this.checked){ $(ee).addClass('selectd'); } else { $(ee).removeClass('selectd'); }"></div><?php
            }

            //IMG
            if($tbli['tipo']=='img'){
                /*prin($linea);*/
                echo '<div class="nc '.(($SuprimirLabel)?'sp':'').'" '.( ($urd=='1')?' title="'.$tbli['label'].'" ':'').' >'.$tbli['label'].'';
                echo '</div>';

                echo '<span class="bd" ';
                echo 'style="'.($tbli['style']=='')?"":str_replace(",",";",$tbli['style']).'"';
                echo ' id="i_'.$tbli['campo'].'_'.$linea[$datos_tabla['id']].'">';

                if($linea[$tbli['campo']]!=''){
                    $cec=0; 
                    if(($tbli['enlace']=='lightbox') or !($tbli['enlace']) ){ 
                        $cec=1;
                        ?><a style="float:none;margin:0;text-align:center;" href="<?php echo get_imagen($datos_tabla[$tbli['campo']]['carpeta'], $linea[$datos_tabla['fcr']],$linea[$tbli['campo']]);?>" rel="[images],noDesc" class="mb" ><?php 
                    } elseif($tbli['enlace']) { 
                        $cec=1;
                        echo '<a href="'.str_replace(array("[id]","[enlace]"),array($linea[$datos_tabla['id']],$linea[$tbli['campo']]),$tbli['enlace']).'" >'; 
                    }
                    ?><img  id="<?php echo $tb?>_file_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" <?php echo dimensionar_imagen($datos_tabla[$tbli['campo']]['carpeta'], $linea[$datos_tabla['fcr']],$linea[$tbli['campo']],$tbli['tamano_listado']);?> /><?php 
                    if($cec){
                        ?></a><?php 
                    }
                } else {
                    ?><img id="<?php echo $tb?>_file_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" <?php
                    ?>class='img_default' src="<?php echo $USU_IMG_DEFAULT;?>" /><?php
                }

                echo '</span>';

                ?><div class="pt" id="p_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" ></div><?php

                if($tbli['controles']){

                    $dts=str_replace(
                        $pdfrom,
                        $pdto,
                        //"[id]",
                        //$linea[$datos_tabla['id']],
                        procesar_dato($tbli['controles'],$linea[$datos_tabla['id']])
                    );

                    if($urd==1){ 
                        $sizeE[$tbli['campo']]='style="width:'.( str_control($dts) ).'px;"'; 
                    }
                    echo "<div class='cd' ".$sizeE[$tbli['campo']].">";
                    echo $dts;
                    echo "</div>";

                }

            }

            //STO
            if($tbli['tipo']=='sto'){

                list($uuno,$extens)=explode(".",$linea[$tbli['campo']]);

                echo '<div class="nc '.(($SuprimirLabel)?'sp':'').'"
                '.( ($urd=='1')?' title="'.$tbli['label'].'" ':'').'
                >'.$tbli['label'];
                echo '</div>';
                ;?><span class="bd" style=' padding-left:10px;' id="i_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" ><?php
                if($linea[$tbli['campo']]!=''){
                $cec=0;
                if(($tbli['enlace']=='lightbox') or !($tbli['enlace']) and in_array($extens,array('gif','jpg','png','swf')) ){
                $cec=1;
                echo '<a style="float:none;margin:0;text-align:left;" href="'.get_imagen($datos_tabla[$tbli['campo']]['carpeta'], $linea[$datos_tabla['fcr']],$linea[$tbli['campo']]).'" rel="[images],noDesc" class="mb" >';
                } elseif($tbli['enlace']) {
                $cec=1;
                echo "<a href=\"";

                if($tbli['enlace']=='down'){
                        echo "down.php?name=".urlencode($linea[($tbli['name'])?$tbli['name']:'nombre'])."&file=".urlencode(str_replace($vars['REMOTE']['httpfiles'],'',get_imagen($datos_tabla[$tbli['campo']]['carpeta'], $linea[$datos_tabla['fcr']],$linea[$tbli['campo']])))."\" title=\"Descargar ".$linea[($tbli['name'])?$tbli['name']:'nombre'];
                } else {
                        echo str_replace(array("[id]","[enlace]"),array($linea[$datos_tabla['id']],$linea[$tbli['campo']]),$tbli['enlace']);
                }
                echo "\">";

                }

                if(($tbli['enlace']=='down') and in_array($extens,array('txt','doc','xls','pdf')) ){
                    echo "Descargar <img src='img/ico_".$extens.".png' align=center border=0 >";
                }else{
                    echo $linea[$tbli['campo']];
                }

                if($cec){ echo "</a>"; }

                } else { ?>---<?php }
                ?></span><?php

                

                ?><div class="pt" id="p_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" style=' <?php echo ($tbli['style']=='')?"":str_replace(",",";",$tbli['style'])?>'></div><?php
                if($tbli['controles']){
                    $dts=str_replace($pdfrom,$pdto,procesar_dato($tbli['controles'],$linea[$datos_tabla['id']]));
                    if($urd==1){ $sizeE[$tbli['campo']]='style="width:'.( str_control($dts) ).'px;"'; }
                    echo "<div class='cd' ".$sizeE[$tbli['campo']].">";
                    echo $dts;
                    echo "</div>";
                }

            }

            //PAS
            if($tbli['tipo']=='pas'){

                ?><div class="nc"><?php echo $tbli['label']?>:</div><?php
                ?><span class="bd" style=' <?php echo $tbli['width']; ?>' <?php
                ?>id="i_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" <?php
                if($_COOKIE['admin']=='1') echo "title=\"".addslashes($linea[$tbli['campo']])."\"";
                ?>><?php

                $passs='';
                for($iu=0;$iu<strlen($linea[$tbli['campo']]);$iu++){
                    $passs.="*";
                }
                echo ($_COOKIE['admin']=='1')?$linea[$tbli['campo']]:$passs;

                ?></span>
                <div class="pt" id="p_<?php echo $tbli['campo']?>_<?php echo $linea[$datos_tabla['id']]?>" style=" <?php echo $tbli['width']; ?>">
                </div>
                <?php
            
            }


            if($tbli['controles']){
                
                $dts=str_replace($pdfrom,$pdto,procesar_dato($tbli['controles'],$linea[$datos_tabla['id']],$tbli['controles_noquery']));

                $ddttss=explode("<a",$dts);

                foreach($ddttss as $ddttss2){
                    if($ddttss2)
                    $ddttss3[]="<a ".trim($ddttss2);
                }
                $controles_bufer=array_merge($controles_bufer,$ddttss3);

                unset($ddttss3);

                if($urd==1){

                    $sizeE[$tbli['campo']]='style="width:'.( str_control($dts) ).'px;"';
                    
                    if($load_foto[$tbli['campo']]!=''){
                        $sizeF[$tbli['campo']]='style="width:'.( str_control($dts) ).'px;margin-left:52px;"';
                    }else{
                        $sizeF[$tbli['campo']]='style="width:'.( str_control($dts) ).'px;"';
                    }

                }
            }

            //OTROS
            if(
            in_array($tbli['tipo'],array('txt','inp','com','yot','fch','fcr','html','bit','id'))
            or
            ($tbli['tipo']=='hid' and ($tbli['combo']=='1' or $tbli['listable']=='1') )
            )
            {

                $tbli['tip_foreig']=( ($tbli['tipo']=='hid') and ($tbli['opciones']!=''))?$tbli['tip_foreig']:$tbli['tip_foreig'];
                

                //echo ($SuprimirLabel)?"":'<b class="nc">'.$tbli['label'].':</b>';
                echo '<div class="nc '.(($tbli['label']=='' or $SuprimirLabel)?'sp':'').'" '.( ($urd=='1')?' title="'.$tbli['label'].'" ':'').' >'.
                str_replace(array('(',')'),array('<span style="display:none;">','</span>'),$tbli['label']).
                '';
                echo '</div>';


                if($tbli['extra']!='')
                    echo "<span style='float:left;margin:0 3px; font-size:11px; '>".procesar_dato($tbli['extra'],$linea[$datos_tabla['id']])."</span>";


                $adiv0='';

      
                if(
                    !($tbli['nolink']=='1') and
                    ( $tbli['enlace'] or $tbli['tip_foreig']=='1' or $Firstmain or ( $tbli['tipo']=='yot' and trim($linea[$tbli['campo']])!='' ) )
                    ){ 
                        $adiv0.='<a class=" '; 
                    } else { 
                    $adiv0.='<div class=" '; 
                }
                
                if( !( $tbli['tipo']=='hid' and !isset($tbli['opciones']) ) ){

                    $adiv0.=' bd '; 
                    
                }

                if($tbli['format']=='currency'){ $adiv0.='currency '; } else { $adiv0.=''; }

                if(0)
                if($tbli['tip_foreig']=='1'){ $adiv0.='tipper '; } else { $adiv0.=''; }

                $adiv0.= ($tbli['tipo']=='yot' and trim($linea[$tbli['campo']])!='' )?"mb ico_play ":"";
                // $adiv0.= ($SuprimirLabel and !$nomodificar)?"mn ":"";
                $adiv0.= ($Firstmain and !$nomodificar and $tbli['listhtml']!='1' and !($tbli['nolink']==1) )?"fm ":"";
                $adiv0.= ($Firstmain and !$nomodificar and $tbli['listhtml']!='1')?"fmf ":"";
                $adiv0.= '"';
 
                $adiv0.= ' target="_top"';

                if($tbli['tip_foreig']=='1'){
                    if($tbli['tipo']=='hid'){

                        list($primO,$tablaO)=explode("|",$tbli['opciones']);
                        
                        list($tablaO)=explode(" ",$tablaO);

                        list($idO,$camposO)=explode(",",$primO);
                        list($tablaO,$notablaO)=explode(",",$tablaO);
                        $lllink='custom/'.$tablaO.'.php?i='.$linea[$tbli['campo']].( ($tbli['link-params'])?$tbli['link-params']:'' );
                        $adiv0.='rel="{ajax:\'ajax_sql.php?v_t='.$tablaO.'&v_d='.$idO.'%3D'.$linea[$tbli['campo']].'&exc='.$camposO.'&f=get_quick\'}"';
                    } else {
                        $lllink='custom/'.$datos_tabla['archivo'].'.php?i='.$linea[$datos_tabla['id']];
                    }
                } elseif($tbli['tipo']=='yot') {
                    if( trim($linea[$tbli['campo']])!='' ){
                        $lllink="http://www.youtube.com/embed/".$linea[$tbli['campo']];
                        $adiv0.='rel="allowfullscreen,width:960,height:720"';
                    } else {
                        $lllink="";
                        $adiv0.='';	
                    }
                } else { 
                    $adiv0.=''; 
                }

                
                $adiv0.= "style='".$tbli['width'].";";
                $adiv0.= ($tbli['tipo']=='txt')?'max-height:95px;overflow:hidden;':'';
                $adiv0.= "' ";
                $adiv0.= "id=\"i_".$tbli['campo']."_".$linea[$datos_tabla['id']]."\" ";


                if($tbli['enlace'] or $tbli['tip_foreig']=='1' or $tbli['tipo']=='yot' ){
                    if($tbli['tip_foreig']=='1'){
                    $adiv0.= "href=\"$lllink\" ";
                    } elseif($tbli['tipo']=='yot'){
                    $adiv0.= "href=\"$lllink\" title=\"ver video\" ";
                    } else {
                    $adiv0.= "href=\"".str_replace(array("[id]","[enlace]"),array($linea[$datos_tabla['id']],$linea[$tbli['campo']]),$tbli['enlace'])."\" ";
                    }
                } else {
                    if($Firstmain)
                    $adiv0.= "href=\"custom/".$datos_tabla['archivo'].".php?i=".$linea[$datos_tabla['id']].( ($tbli['link-params'])?$tbli['link-params']:'' )."\" ";																				
                    /*$adiv0.= "onclick=\"ax('vc','".$linea[$datos_tabla['id']]."');return false;\" href=\"custom/".$datos_tabla['archivo'].".php?i=".$linea[$datos_tabla['id']]."\" ";										*/
                }
                
                $adiv1= '';

                switch($tbli['tipo']){
                    
                    case "fch":case "fcr":
                    $adiv1.= fecha_formato($linea[$tbli['campo']],($tbli['formato'])?$tbli['formato']:'0b');
                    break;
                    case "html":
                    if($tbli['listhtml']=='1' or $_GET['i']!=''){	$adiv1.= "<div class='htmlenlista'>".stripslashes($linea[$tbli['campo']])."</div>"; } else {
                    $adiv1.= substr(strip_tags($linea[$tbli['campo']]),0,3000);
                    }
                    break;
                    case "hid":
                        if($tbli['multi']=='1'){
                            list($primO,$tablaO)=explode("|",$tbli['opciones']);
                            list($tablaO)=explode(" ",$tablaO);
                            list($idO,$camposO)=explode(",",$primO);
                            // prin([$idO,$camposO]);
                            $rel_tabla=get_rel_tabla($datos_tabla['tabla'],$tablaO);
                            $relos=select($primO,$tablaO,"left join ".$rel_tabla."
                            on ".$rel_tabla.".id_".$tablaO." = ".$tablaO.".".$idO."
                            where ".$rel_tabla.".id_".$datos_tabla['tabla']."=".$linea['id'],0);
                            foreach($relos as $relo){
                                $relo_a[]="<li>".$relo[$camposO]."</li>";
                            }
                            $adiv1.='<ul class="multilist">'.implode("",$relo_a).'</ul>';
                            unset($relo_a);

                        } else {

                            list($primO,$tablaO)=explode("|",$tbli['opciones']);
                            list($tablaO)=explode(" ",$tablaO);
                            list($idO,$camposO)=explode(",",$primO);
                            $camposOA=array();
                            $camposOA=explode(";",$camposO);
                            $color0='';
                            $valuores=explode(",",$linea[$tbli['campo']]);
                            foreach($valuores as $lov){
                                $bufy='';
                                $ddattfila= fila($camposOA,$tablaO,"where ".$idO."='".$lov."'",0);
                                foreach($ddattfila as $COA=>$ddatt){
                                if($COA=='color' and trim($ddatt)!=''){ $color0=$ddatt; $use_color=1; }
                                else $bufy.=$ddatt." ";
                                }
                                $adiv1.= '<div>';
                                $adiv1.= ($color0!='')?"<span class='badge' style='background:$color0;color:white;' >".$bufy."</span>":$bufy;
                                $adiv1.= '</div>';
                                $adiv0.= ( $poner_title )?"title=\"".addslashes($bufy)."\"":"";
                            }

                        }
                    break;
                    case "bit":
                    switch($linea[$tbli['campo']]){
                        case "1":$adiv1.= "&nbsp;<a title='si' class='ico_yes z ico_list'></a>"; break;
                        case "0":$adiv1.= "&nbsp;<a title='no' class='ico_no z ico_list'></a>"; break;
                    }
                    break;
                    
                    case "com":
                    if(is_array($tbli['opciones'])){
                    list($opppp,$color)=explode("|",$tbli['opciones'][$linea[$tbli['campo']]]);
                    switch(str_replace(
                        array('á','é','í','ó','ú'),
                        array('a','e','i','o','u'),
                        strtolower($opppp))){
                    case "comentario":							$adiv1.= "<a title='enviado' class='ico_tack z ico_list'></a>"; break;
                    case "soporte":								$adiv1.= "<a title='soporte' class='ico_clip z ico_list'></a>"; break;
                    case "enviado":								$adiv1.= "<a title='enviado' class='ico_yes z ico_list'></a>"; break;
                    case "recibido":							$adiv1.= "<a title='recibido' class='ico_yes z ico_list'></a>"; break;
                    case "si":case "sí":						$adiv1.= "<a title='si' class='ico_yes z ico_list'></a>"; break;
                    case "no":									$adiv1.= "<a title='no' class='ico_no z ico_list'></a>"; break;
                    case "nuevos soles":case "soles": 			$adiv1.= "S/."; break;
                    case "dolares":case "dolares americanos": 	$adiv1.= "\$US"; break;
                    default : 								
                        list($color_1,$color_2)=explode(";",$color);
                        $color_2=($color_2)?$color_2:'white';
                        $adiv1.= "<span ". ( ($color!='')?" class='badge' style='background:$color_1;color:$color_2;' ":"" ) . ">".$opppp."</span>";	
                    break;
                        }
                    } else {
                    $adiv0.= ( $poner_title )?"title=\"".addslashes($linea[$tbli['campo']])."\"":"";

                    $adiv1.= $linea[$tbli['campo']];

                    }
                    break;

                    default:
                    $adiv0.= ( $poner_title )?"title=\"".addslashes($linea[$tbli['campo']])."\"":"";

                    if($tbli['inlist']){
                        $inlist=explode(';',$tbli['inlist']);
                        foreach($inlist as $inlis){
                            $adiv1.= $linea[$inlis]." ";												
                        }
                    } else {
                        switch($tbli['format']){
                            case "currency":
                            $adiv1.= ($linea[$tbli['campo']])?number_format($linea[$tbli['campo']], 2, '.', ','):'';
                            break;
                            default:
                            $adiv1.= $linea[$tbli['campo']];
                            break;
                        }
                    }
                    break;
                }

                if(
                    !($tbli['nolink']==1) and
                    ( $tbli['enlace'] or $tbli['tip_foreig']=='1' or $Firstmain or ( $tbli['tipo']=='yot' and trim($linea[$tbli['campo']])!=''  )
                ) 
                ){ 
                    $adiv2= '</a>';
                } else { 
                    $adiv2= '</div>'; 
                }

                $adiv0.= " >";

                echo $adiv0.$adiv1.$adiv2;
                //echo ($tbli['foreig'])?"�":"";

                if(0)
                if($tbli['controles']){
                
                    
                    echo '<div class="cd menudown">
                    <a rel="sm_'.$tbli['campo'].'_'.$linea[$datos_tabla['id']].'" id="ab_'.$tbli['campo'].'_'.$linea[$datos_tabla['id']].'" '
                    // .' onclick="ax(\'b\',\''.$linea[$datos_tabla['id']].'\');return false;" '
                    .' class=" bl1 itr i_b z" ></a>';

                    echo '<ul class="li_cabecera">';
                    echo $dts;
                    echo '</ul>';
                    echo '</div>';
                
                }

            }
        
        echo '</li>';

    }

}

echo '</ul>';

