<?php


$queries         = [];
$queries_end     = [];
$queries_after   = [];

// prin($_GET);
if(isset($_GET['format']) and sizeof($objeto_tabla[$this_me]['more'])>0 ){

    foreach($objeto_tabla[$this_me]['campos'] as $campo){

        if($campo['tipo']=='hid' and isset($campo['opciones']) and enhay($campo['opciones'],'||') ){

            list($ouno,$odos)=explode("||",$campo['opciones']);
                        
            list($tablaO)=explode(" ",$tablaO);

            list($otres,$ocuat)=explode("|",$ouno);

            $moremore[$ocuat]=explode(';',$odos);

            unset($ouno); unset($odos); unset($otres); unset($ocuat); 
            
        }

    } unset($campo);

    
    // prin($moremore);
    foreach($moremore as $ore=>$ero){

        $adicionales=explode(",",$objeto_tabla[$this_me]['more'][$ore]);
        
        foreach($adicionales as $uurl){
        
            $diran=parse_url($uurl);
            $ero2=array();
            parse_str($diran['query'], $output);
            foreach($ero as $eero){
                if($eero!=$diran['path']) $ero2[]=$eero."?listable=1&after=".$output['after'];
            }
            $objeto_tabla[$this_me]['more'][$ore]=$objeto_tabla[$this_me]['more'][$ore].",\n".implode(",\n",$ero2);
    
        }
    
    }

} unset($ore); unset($ero);


// prin($objeto_tabla[$this_me]['more']);

foreach($objeto_tabla[$this_me]['more'] as $blata=>$querries){

    $querrie=explode(",",$querries);
    
    foreach($querrie as $querrie1){

        list($querrie1uno,$querrie1dos)=explode('?',trim($querrie1));

        $objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno]['tabla']=$blata;

        $objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno]['legend']='';

        parse_str($querrie1dos,$querrie11);

        foreach($querrie11 as $querrie11uno => $querrie11dos){

            $objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno][$querrie11uno]=$querrie11dos;

        } unset($querrie11uno); unset($querrie11dos);

        if($querrie11['queries']=='1'){
            
            if(isset($objeto_tabla[$this_me]['campos'][$querrie11['after']])){

                $queries_after[$querrie11['after']][]=array($querrie1uno,$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno]);	

            } else {

                $queries_end[$querrie1uno]=$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno];	

            }	

        }

        if($querrie11['listable']=='1' or 1){

            if($querrie11['after']=='start'){ $querrie11['after']=$first_listable; }

            $objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno]['noedit']=1;

            if(isset($objeto_tabla[$this_me]['campos'][$querrie11['after']])){

                $tblistatado_after[$querrie11['after']][]=array($querrie1uno,$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno]);	

            } else {

                $tblistatado_end[$querrie1uno]=$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno];	

            }	

            $listable_end[$querrie1uno]=$objeto_tabla[$file2OBJ[$blata]]['campos'][$querrie1uno];	

        }


    } unset($querrie1);

} unset($querries);



// prin($queries_after);

foreach($objeto_tabla[$this_me]['campos'] as $ddff=>$df){

    if($df['queries']=='1'){
        
        $queries[$ddff]=$df;

    }

    if(isset($queries_after[$ddff])){

        foreach($queries_after[$ddff] as $ffdd){

            $queries[$ffdd[0]]=$ffdd[1];

        } unset($ffdd);

    }

} unset($ddff); unset($df);

$queries=array_merge($queries,$queries_end);


if($_GET[$datos_tabla['foreig']]!='')
unset($queries[$datos_tabla['foreig']]);

// prin($queries);


parse_str($_GET['filter'],$FiL0);


foreach($FiL0 as $tre=>$FiL0tbl){

    foreach($FiL0tbl as $Fili){

        if($Fili=='undefined') continue;
        list($un,$do)=explode(".",$Fili);
        list($un,$do)=explode("=",$do);
        if(substr_count($Fili, '|')==2){

            $pa_rts=explode("|",$Fili);

            $FiL[$tre][$pa_rts[0]]=$tre.".".$Fili;

        } else {

            $FiL[$tre][$un]=$Fili;

        } unset($un); unset($do); unset($pa_rts);

    } unset($Fili);

} unset($tre); unset($FiL0tbl);
// prin($FiL);


$html_filter_fecha_A=[];
$html_filter_A=[];


$html_filter_fecha='';
$html_filter='';

// prin($objeto_tabla[$this_me]['joins']);

// prin($objeto_tabla[$this_me]['queries']);

// prin($queries);

// prin($FiL);





$parenthood  = [];
$parenthood2 = [];
$getparent   = [];


foreach($queries as $blatacampo=>$querie){

    $blata=($querie['tabla']!='')?$querie['tabla']:$tbl;

    if($querie['disabled']=='1'){ continue; }

    list($unon,$doos)=explode("|",$querie['opciones']);
                        
    list($doos)=explode(" ",$doos);

    //prin($doos."=".$tabla_sesion_datos);
    if($doos!='' and $doos==$tabla_sesion_datos){ continue; }

    if(in_array($querie['tipo'],array('hid','user')) and ($querie['opciones'])){
        

        if($querie['select_multiple']=='1'){


        } elseif($querie['dlquery']=='1'){

            
        } else {
            
            // prin($querie['campo']);
            // prin($querie['load']);
            if(!empty($querie['load']))
                $parenthood[$querie['campo']]=$querie['load'];
            

        }

    }

} unset($blatacampo); unset($querie);
// prin($parenthood);

parse_str($_GET['filter'],$FiL00);

foreach($FiL00 as $fgfg){
    
    foreach($fgfg as $fgfgf){

        list($unofg,$dosfg)=explode('.',$fgfgf);
        list($tresfg,$cuatrofg)=explode('=',$dosfg);
        $getparent[$tresfg]=$dosfg;

        unset($unofg); unset($dosfg); unset($tresfg); unset($cuatrofg); 

    } unset($fgfgf);

} unset($fgfg); unset($$FiL00);
// prin($getparent);


foreach($parenthood as $hdd=>$ph){
    
    list($unofg,$dosfg)=explode('||',$ph);
    if(!empty($getparent[$hdd])){
        $parenthood2[$unofg]=$getparent[$hdd];
    } unset($unofg); unset($dosfg);

} unset($hdd); unset($ph);
// prin($parenthood2);

/*
 #######  ##     ## ######## ########  #### ########  ######
##     ## ##     ## ##       ##     ##  ##  ##       ##    ##
##     ## ##     ## ##       ##     ##  ##  ##       ##
##     ## ##     ## ######   ########   ##  ######    ######
##  ## ## ##     ## ##       ##   ##    ##  ##             ##
##    ##  ##     ## ##       ##    ##   ##  ##       ##    ##
 ##### ##  #######  ######## ##     ## #### ########  ######
*/
// prin($queries);
foreach($queries as $blatacampo=>$querie){

    $blata=($querie['tabla']!='')?$querie['tabla']:$tbl;

    if($querie['disabled']=='1'){ continue; }

    list($unon,$doos)=explode("|",$querie['opciones']);
                        
    list($doos)=explode(" ",$doos);

    //prin($doos."=".$tabla_sesion_datos);
    if($doos!='' and $doos==$tabla_sesion_datos){ continue; }

    if(in_array($querie['tipo'],array('inp')) ){

        $html_filter='';
        $html_filter.="<span class='filfchspan'>".$querie['label']."</span>";
        $html_filter.="<input type='text' style='width:200px;' ".
        " placeholder='".$querie['dl_placeholder']."' ".
        " id='filtr_".$querie['campo']."_dl' ".
        " class='form-control form-control-sm ".
        (($FiL[$blata][$querie['campo']]!='')?" inuse ":"").
        "'".
        " value='".str_replace($blata.".".$querie['campo']."%3D","",urlencode($FiL[$blata][$querie['campo']]))."' ".
        // " onchange=\"render_filder();\" ".
        " >";
        $html_filter.="<input type='hidden' style='width:300px;' ".
                    " id='filtr_".$querie['campo']."' ".
                    " data-table='".$blata."' ".
                    " data-field='".$querie['campo']."' ".
                    " value='".urlencode($FiL[$blata][$querie['campo']])."' >";
        $html_filter.="<input type='hidden' style='width:300px;' ".
                    // " id='filtr_".$querie['campo']."' ".
                    " value=\"load_directlink_filtro_inp('".$querie['campo']."','".$querie['campos_search']."','".$blata."','".$this_me."','".( ($querie['extra_where'])?$querie['extra_where']:'' )."');\" class='jsloads' >";

        //$html_filter.="<script>load_directlink_filtro_inp('".$querie['campo']."','".$objeto_tabla[$this_me]['tabla']."');</script>";
        $terfil[$blata][]=$querie['campo'];

        $html_filter_A[$querie['campo']]=$html_filter;

    } elseif(in_array($querie['tipo'],array('hid','user')) and ($querie['opciones'])){
        

        /*
        ##     ## ##     ## ##       ######## #### ########  ##       ########
        ###   ### ##     ## ##          ##     ##  ##     ## ##       ##
        #### #### ##     ## ##          ##     ##  ##     ## ##       ##
        ## ### ## ##     ## ##          ##     ##  ########  ##       ######
        ##     ## ##     ## ##          ##     ##  ##        ##       ##
        ##     ## ##     ## ##          ##     ##  ##        ##       ##
        ##     ##  #######  ########    ##    #### ##        ######## ########
        */
        if($querie['select_multiple']=='1'){

            $html_filter='';

            list($uno,$slex)=explode("=",$FiL[$blata][$querie['campo']]);
            $selex=explode(",",$slex);


            list($primO,$tablaO,$whereO)=explode("|",$querie['opciones']);
                        

            list($tabla0)=explode(" ",$tabla0);

            $whereO=str_replace("where 0","where 1",$whereO);

            list($where01,$where02)=explode("order by",$whereO);

            $where02=($where02)?" order by ".$where02:'';

            //echo "$primO,$tablaO,$whereO";
            list($idO,$camposO)=explode(",",$primO);
            $oopciones=select(array($idO,"CONCAT_WS(' ',". str_replace(";",",",$camposO) .") as value"),$tablaO,(($whereO1)?$whereO1:"where 1 ").get_extra_filtro_0($tablaO).$where02);

            $html_filter.="<ul class=qsm>";
            $html_filter.="<input type='hidden' value='".urlencode($FiL[$blata][$querie['campo']])."' id='filtr_".$querie['campo']."'>";
            //$html_filter.="<li ".(($FiL[$blata][$querie['campo']]!='')?"class='qsml inuse'":"qsml")." id='filtr_".$querie['campo']."' onchange=\"render_filder();\">";
            $html_filter.="<li class='qsml ".(($FiL[$blata][$querie['campo']]!='')?"inuse":"")."' >".$querie['label']."</li>";
            //$html_filter.="<label value='' class='empty'>".$querie['label']."</label>";
            $html_filter.="<div class='con'>";
            foreach($oopciones as $pppooo){
            $quer=urlencode($tbl.".".$querie['campo']."=".$pppooo[$idO]);
            $html_filter.="<li class='qsml ".((in_array($pppooo[$idO],$selex))?"smcheck":"")."'>";
            $html_filter.="<input class='filtr_".$querie['campo']."' value=\"".$pppooo[$idO]."\" type='checkbox' id='filtr_".$querie['campo']."__".$pppooo[$idO]."' onchange=\"rf('".$querie['campo']."');\" ".((in_array($pppooo[$idO],$selex))?"checked":"").">";
            $html_filter.="<label for='filtr_".$querie['campo']."__".$pppooo[$idO]."' ".(($quer==urlencode($FiL[$blata][$querie['campo']]))?'selected':'')." >".$pppooo['value']."</label>";
            $html_filter.="</li>";
            }
            $html_filter.="</div>";
            $html_filter.="</ul>";

            //$html_filter.="</select>";
            $terfil[$blata][]=$querie['campo'];

            $html_filter_A[$querie['campo']]=$html_filter;

        } 
        /*
        ########  #### ########  ########  ######  ######## ##       #### ##    ## ##    ##
        ##     ##  ##  ##     ## ##       ##    ##    ##    ##        ##  ###   ## ##   ##
        ##     ##  ##  ##     ## ##       ##          ##    ##        ##  ####  ## ##  ##
        ##     ##  ##  ########  ######   ##          ##    ##        ##  ## ## ## #####
        ##     ##  ##  ##   ##   ##       ##          ##    ##        ##  ##  #### ##  ##
        ##     ##  ##  ##    ##  ##       ##    ##    ##    ##        ##  ##   ### ##   ##
        ########  #### ##     ## ########  ######     ##    ######## #### ##    ## ##    ##
        */
        elseif($querie['dlquery']=='1'){
            $html_filter='';

            list($primO,$tabla1,$whereO)=explode("|",$querie['opciones']);

            $whereO=str_replace("where 0","where 1",$whereO);

            list($where01,$where02)=explode("order by",$whereO);

            list($tabla0,$join0)=explode("left join",$tabla1);
            if(!empty($join0)){
            
                $join0='left join '.$join0;

            } else {

                list($tabla0,$join0)=explode("right join",str_replace('  ',' ',$tabla1));

                if(!empty($join0)){

                    $join0='right join '.$join0;

                }
                
            }
            // prin($tabla0);
            // prin($join0);

            $where02=($where02)?" order by ".$where02:'';

            list($prim0id,$prim0nombre)=explode(",",$primO);

            // prin($FiL[$blata][$querie['campo']]);

            $html_filter.="<span class='filfchspan'>".$querie['label']."</span>";
            $html_filter.="<input type='text' id='filtr_".$querie['campo']."_dl' ".(($FiL[$blata][$querie['campo']]!='')?"class='inuse"."'":"")." value='";

            $fila=fila(array("CONCAT_WS(' ',". str_replace(";",",",$prim0nombre) .") as v"),$tabla0,"where id='".str_replace($blata.".".$querie['campo']."%3D","",urlencode($FiL[$blata][$querie['campo']]))."'",0);

            $html_filter.=$fila['v'];
            $html_filter.="' ";
            // $html_filter.=" onchange=\"render_filder();\" ";
            $html_filter.=" >";-
            // prin($EXTRA_FILTRO);
            $direclink_include=($querie['directlink_include'])?$querie['directlink_include']:'';
            
            $_SESSION['xt']=$EXTRA_FILTRO;
            $html_filter.="<input type='hidden' id='filtr_".$querie['campo']."' value='".urlencode($FiL[$blata][$querie['campo']])."' >";
            $html_filter.="<input type='hidden' id='filtr_".$querie['campo']."' value=\"load_directlink_filtro_com('".$querie['campo']."','".$prim0id."','".$prim0nombre."','".$tabla0."','".$whereO1."','".$blata."','".$join0."','','".$direclink_include."');\" class='jsloads' >";

            //$html_filter.="<script>load_directlink_filtro_inp('".$querie['campo']."','".$objeto_tabla[$this_me]['tabla']."');</script>";
            $terfil[$blata][]=$querie['campo'];

            $html_filter_A[$querie['campo']]=$html_filter;

        } 
        /*
        ########  #### ##    ##    ###    ##     ## ##    ##  ######
        ##     ##  ##  ###   ##   ## ##   ###   ###  ##  ##  ##    ##
        ##     ##  ##  ####  ##  ##   ##  #### ####   ####   ##
        ##     ##  ##  ## ## ## ##     ## ## ### ##    ##    ##
        ##     ##  ##  ##  #### ######### ##     ##    ##    ##
        ##     ##  ##  ##   ### ##     ## ##     ##    ##    ##    ##
        ########  #### ##    ## ##     ## ##     ##    ##     ######
        */
        else {

            // prin($querie['campo']);

            $html_filter='';

            list($primO,$tablaO,$whereO)=explode("|",$querie['opciones']);

            if($parenthood2[$querie['campo']]){

                // list($antesrm,$despuesrm)=explode("order",$whereO);



                $whereO=' and '.$parenthood2[$querie['campo']] .' '. $whereO;

                if(!enhay($whereO,"where")){
                    $whereO="where visibilidad=1 ".$whereO;
                }

            }

            // prin($whereO);

            $whereO=str_replace("where 0","where 1",$whereO);





            list($tablaO)=explode(" ",$tablaO);

            // echo "$primO | $tablaO | $whereO <br>";

            list($where01,$where02)=explode("order by",$whereO);

            // echo "$where01 | $where02 <br> <br>";




            $where02=($where02)?" order by ".$where02:'';

            list($idO,$camposO)=explode(",",$primO);

            $camposO=str_replace(";color", "", $camposO);

            // echo "$where01 <br>";
            $where01 = ($where01!='')?$where01:"where 1 ";


            list($unra,$raun)=explode("where",$where01);
            $where01="where ".$raun." ".$unra;


            $oopciones=select(array($idO,"CONCAT_WS(' ',". str_replace(";",",",$camposO) .") as value"),$tablaO,( $where01 ).get_extra_filtro_0($tablaO).$where02,0);

            $html_filter.="<select 
            data-table='".$blata."' 
            data-field='".$querie['campo']."'
            style='width:".(($querie['width'])?$querie['width']:'100px').";' ".            
            " class='form-control form-control-sm ".
             (($FiL[$blata][$querie['campo']]!='')?"inuse":"").
            "' ".
            
            " id='filtr_".$querie['campo']."' 
            onchange=\"render_filder('".$datos_tabla['inner']."','".$datos_tabla['me']."','".$datos_tabla['get_id']."');\"
            >";
            $html_filter.="<option value='' class='empty'>".$querie['label']."</option>";
            foreach($oopciones as $pppooo){
            $quer=urlencode($blata.".".$querie['campo']."=".$pppooo[$idO]);

            $html_filter.="<option ".(($quer==urlencode($FiL[$blata][$querie['campo']]))?'selected':'')." value=\"".$quer."\">".$pppooo['value']."</option>";

            }
            $html_filter.="</select>";
            $terfil[$blata][]=$querie['campo'];

            $html_filter_A[$querie['campo']]=$html_filter;						

        }

    /*
     ######  ########    ###    ######## ####  ######
    ##    ##    ##      ## ##      ##     ##  ##    ##
    ##          ##     ##   ##     ##     ##  ##
     ######     ##    ##     ##    ##     ##  ##
          ##    ##    #########    ##     ##  ##
    ##    ##    ##    ##     ##    ##     ##  ##    ##
     ######     ##    ##     ##    ##    ####  ######
    */
    } elseif(in_array($querie['tipo'],array('com')) and ($querie['opciones'] or $querie['rango'])){
                        

        $html_filter='';

        if($querie['rango']!=''){
            list($uuno,$ddos)=explode(",",$querie['rango']);
            $FromYear = date("Y",strtotime($uuno));
            $ToYear = date("Y",strtotime($ddos));
            for($i=$FromYear;$i<$ToYear;$i++){
                $querie['opciones'][$i]=$i;
                    
            }
        }
        $oopciones=$querie['opciones'];
                        
        $html_filter.="<select 
        data-table='".$blata."'
        data-field='".$querie['campo']."'        
        class=' form-control form-control-sm ".
        (($FiL[$blata][$querie['campo']]!='')?" inuse ":"").
        " '".
        " id='filtr_".$querie['campo']."' 
        onchange=\"render_filder('".$datos_tabla['inner']."','".$datos_tabla['me']."','".$datos_tabla['get_id']."');\"
        >";
        $html_filter.="<option value='' class='empty'>".$querie['label']."</option>";
        foreach($oopciones as $ipppooo=>$pppooo){
        $quer=urlencode($blata.".".$querie['campo']."=".$ipppooo);
        list($laex,$lanueva)=explode("|",$pppooo);
        $html_filter.="<option ".(($quer==urlencode($FiL[$blata][$querie['campo']]))?'selected':'')." value=\"".$quer."\">".$laex."</option>";
        }
        $html_filter.="</select>";
        $terfil[$blata][]=$querie['campo'];

        $html_filter_A[$querie['campo']]=$html_filter;


    } 
    /*
    ########     ###    ######## ########  ######
    ##     ##   ## ##      ##    ##       ##    ##
    ##     ##  ##   ##     ##    ##       ##
    ##     ## ##     ##    ##    ######    ######
    ##     ## #########    ##    ##             ##
    ##     ## ##     ##    ##    ##       ##    ##
    ########  ##     ##    ##    ########  ######
    */
    elseif(in_array($querie['tipo'],array('fch','fcr'))){

        $html_filter_fecha='';

        $first=dato('min('.$querie['campo'].')',$blata,"where ".$querie['campo']."!=0",0);
        $first=(!$first)?date("Y-m-d"):$first;
        //$last =dato($querie['campo'],$tbl,"where 1 order by ".$querie['campo']." desc limit 0,1");
        $last=dato('max('.$querie['campo'].')',$blata,"where ".$querie['campo']."!=0",0);
        $last=(!$last)?date("Y-m-d"):$last;
        //prin($first);
        //prin($last);

        $FromYear = substr($first,0,4);
        $FromMonth = substr($first,5,2);

        $ToYear2 = substr($last,0,4);
        //$ToYear = substr($last,0,4);
        $ToYear = date("Y");

        $ToYear= ($ToYear<$ToYear2)?$ToYear2:$ToYear;


        $fftt=explode("|",$FiL[$blata][$querie['campo']]);
        $fftt=$fftt['1']."|".$fftt['2'];

        //prin($fftt);
        $html_filter_fecha.="<div          
                    class='control-filter-date ".( ($querie['query-options']['no-specific'])?'format_no-specific':'' )."' 
                    style='clear:left;'>";

        $html_filter_fecha.="<span class='filfchspan'>FECHA</span>";
        $html_filter_fecha.="<select 
                                data-table='".$blata."' 
                                data-field='".$querie['campo']."'
                                ".(($FiL[$blata][$querie['campo']]!='')?"class='inuse"."'":"")." 
                                 onchange=\"between('".$querie['campo']."',this.value);";
        $html_filter_fecha.="fechaChangeFilter('".$querie['campo']."','".$datos_tabla['inner']."','".$datos_tabla['me']."','".$datos_tabla['get_id']."');";
        $html_filter_fecha.="\">";
        
        $opciones_fechas=opciones_fechas($querie);

        foreach($opciones_fechas as $of){

        $html_filter_fecha.="<option value='".$of['value']."' ".(($of['value']==$fftt)?'selected':'')." ".(($of['class']!='')?"class='".$of['class']."'":'').">".$of['label']."</option>";

        }

        $html_filter_fecha.="</select>";

        $html_filter_fecha.='<div class="range">';
            $html_filter_fecha.=input_date_filtro($querie['campo'],$FromYear,$ToYear,
            ($FiL[$blata][$querie['campo']])?$FiL[$blata][$querie['campo']]:"fecha_consulta|".substr($first,0,10)."|".substr($last,0,10),
            (($FiL[$blata][$querie['campo']]!='')?"inuse":"")
            );
        $html_filter_fecha.="</div>";
        
        $html_filter_fecha.="</div>";

        $terfil[$blata][]=$querie['campo'];

        $html_filter_fecha_A[$querie['campo']]=$html_filter_fecha;


    }

}


if($_GET['format']!='excel'){
    
    // prin($terfil);

    ?>
    <script>
    function rf(filter){
        var j=0;
        var eles = new Array();
        $$('.filtr_'+filter).each(function(ele) {
            if(ele.checked){
                eles[j]=ele.value;
                j++;
            }
        });
        $('filtr_'+filter).value=(j==0)?'':encodeURIComponent(filter+'='+eles.join(','));
        render_filder();
    }
    function render_filder(dataWhere,dataObj,dataGetid){
        // console.log({dataWhere,dataObj,dataGetid});
        var url='';
        // let queryfields='#'+dataWhere+' .filters#dfilters select[data-field]';
        let queryfields='#'+dataWhere+' [data-field]';
        // console.log(queryfields);
        let $dataFields=document.querySelectorAll(queryfields);
        $dataFields.forEach((ele)=>{
            // console.log(ele);
            if($('filtr_'+ele.dataset.field).value!=''){ 
                part_url=encodeURIComponent(ele.dataset.table+'[]='+$('filtr_'+ele.dataset.field).value+'&'); 
                // console.log('filtr_'+ele.dataset.field);
                // console.log($('filtr_'+ele.dataset.field));
                // console.log($('filtr_'+ele.dataset.field).value);
                url+=part_url;
            }
        });

        // console.log('en vista filter linea 583, url:'+url);

        $('ffilter').value=url;
        // url=url+'&conf=<?php echo urlencode($_GET['conf'])?>';
        // return;
        // console.log(dataObj);
        ax("pagina_filter",url,1,dataObj,dataWhere,dataGetid);
    }
    </script>
    <input type="hidden" id="get_request_filters"  style="width:100%;" value='<?php 
					echo trim(json_encode(
						array_merge($_GET,['get_id'=>$datos_tabla['get_id']])
					)); 
					?>' />    
    <?php


}//FIN DE NO EXCEL



if($datos_tabla['filtros']!=''){
    $fils=explode(";",$datos_tabla['filtros']);
    foreach($fils as $fil){
        list($label,$filt,$ordf,$txtx)=explode("|",trim($fil));
        $Filtross[$label]=array($filt,$ordf,$txtx);
    }

    if($Filtross[$datos_tabla['filtro_default']][0]!='' and $_GET['filtro']==''){	$_GET['filtro']=$datos_tabla['filtro_default']; }
    if($Filtross[$datos_tabla['filtro_default']][0]!='' ){ $no_mostrar_todos=1;	}

    $htmlfil = '<div class="blo_filtros">';
    if(!$no_mostrar_todos){
    $htmlfil.= "<a $selesele href='".$DIR_CUSTOM.$datos_tabla['archivo'].".php'>".$datos_tabla['nombre_plural']."</a><b>:</b>";
    }
    foreach($fils as $fil){
        list($label,$filt,$ordf,$txtx)=explode("|",trim($fil));
        $Filtross[$label]=array($filt,$ordf,$txtx);
        $selesele='';
        if($label==$_GET['filtro']){
            $FilTro=$filt;
            $FilTro_l=$label;
            $FilTro_o=$ordf;
            $selesele='class="selected"';
            if($txtx!=''){
            $BarFiltro=$txtx;
            }
        }
        if(!in_array(trim($label),array("","\n","\r","\t"))){
            $htmlfil.= "<a $selesele href='".$DIR_CUSTOM.$datos_tabla['archivo'].".php?filtro=".$label."'>".$label."</a>";
        }
    }
    $htmlfil.= '</div>';
}


//if($BarFiltro!=''){
//}

if($BarFiltro!=''){
    echo "<div class='barfiltro'>$BarFiltro</div>";
}
