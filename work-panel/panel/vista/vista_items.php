<?php



foreach($tblistado as $tbli){

    if($tbli['tipo']=='html'){ $needs['html']=1; }
    if($tbli['cuantity']=='1'){ $hascuantity=1; $cuantities[]=$tbli['campo']; }

}

if($hascuantity==1 and $lineassize>1){

    echo "<table class='tblcalculo'>";
    echo "<tr><td></td><td class=nombre>m�nimo</td><td class=nombre>m�ximo</td><td class=nombre>media</td></tr>";
    foreach($cuantities as $cutt){

        echo "<tr><td class=nombre>$cutt</td>";
        echo "<td class=valor>";
        $valor = dato("min($cutt)",$tbl,"where 1 $EXTRA_FILTRO $busqueda_query ".$datos_tabla['where_id'],0);
        echo intval($valor*100)/100;
        echo "</td>";
        echo "<td class=valor>";
        $valor = dato("max($cutt)",$tbl,"where 1 $EXTRA_FILTRO $busqueda_query ".$datos_tabla['where_id'],0);
        echo intval($valor*100)/100;
        echo "</td>";
        echo "<td class=valor>";
        $valor = dato("avg($cutt)",$tbl,"where 1 $EXTRA_FILTRO $busqueda_query ".$datos_tabla['where_id'],0);
        echo intval($valor*100)/100;
        echo "</td>";
        echo "</tr>";
        //echo "<div>nunca jamas quiere decir tal vez</div>";
        
    }
    echo "</table>";

}


$datos_tabla['edicion_completa']=($datos_tabla['edicion_completa']!='')?$datos_tabla['edicion_completa']:( (($needs['html']) or($numero_de_campo_en_lista>$limite_campos_en_lista))?1:0 );





$urd=0;

$groupvalue='';

//PRE
if($datos_tabla['mass_actions']!='')
{
    $tblistado=array_merge(array(array('listable'=>'1','campo'=>'check','tipo'=>'check')), $tblistado);
}

foreach($tblistado as $tbli)
{
    $pdfrom[]="[".$tbli['campo']."]";
}
foreach($tblistado as $tbli)
{
    if(isset($tbli['options-row-style'])){ 
        $rowOptionsStyles[$tbli['campo']]=$tbli['options-row-style']; 
    }
}


$controles_bufer=[];
foreach($lineas as $tete=>$linea)
{

    /*prin($linea);	*/
    $ct=[];
    $ConF=[];
    

    $ct=procesproces($datos_tabla,$linea['conf']);


    $urd++;

    $datos_tabla['edicion_completa']=($_GET['block']=='form' and $_GET['tipo']=='listado')?0:$datos_tabla['edicion_completa'];

    if($_GET['i']=='')
    if(in_array($_COOKIE[$tb.'_colap'],['modificador','modificador_grilla'])){
        $modicolap=$_COOKIE[$tb.'_colap'];
    } else {
        $modicolap = 'modificador_grilla';
    }

        

    echo '<li id="i_'.$linea[$datos_tabla['id']].'" ';
 
    echo ' alt="'.$linea[$datos_tabla['id']].'" class="bl ';

    if(sizeof($rowOptionsStyles)>0){
        foreach($rowOptionsStyles as $campo=>$rowOptionsStylesItem){
            echo " ".$rowOptionsStylesItem[$linea[$campo]]."  ";
        }
    }


    echo $modicolap;

    echo '" >';




        /*
        #### ######## ######## ##     ##  ######
        ##     ##    ##       ###   ### ##    ##
        ##     ##    ##       #### #### ##
        ##     ##    ######   ## ### ##  ######
        ##     ##    ##       ##     ##       ##
        ##     ##    ##       ##     ## ##    ##
        ####    ##    ######## ##     ##  ######
        */

        if($_GET['i']!='' and $datos_tabla['include_detail']!=''){ 
            
           include($datos_tabla['include_detail']);

        } else { 
            
            include("vista/vista_item.php");

        } 
        
        echo '<div id="lc_'.$linea[$datos_tabla['id']].'" '.
        ' class="lc '. ( ($urd=='1')?"lc1 ":" " ) .
        ( ($datos_tabla['vis']!='')?(($linea[$datos_tabla['vis']]=='0')?"oc":""):'' ).'" >';
                
        
            echo '<a class=" open_modificador_grilla" '.
            ' onclick="ax(\'set_fila_2\',\''.$linea[$datos_tabla['id']].'\'); return false;" '.
            ' ></a>';

            echo '<a class=" open_modificador" '.
            ' onclick="ax(\'set_fila_4\',\''.$linea[$datos_tabla['id']].'\'); return false;" '.
            ' ></a>';


            /*
             ######   #######  ##    ## ######## ########   #######  ##       ##       ######## ########   ######
            ##    ## ##     ## ###   ##    ##    ##     ## ##     ## ##       ##       ##       ##     ## ##    ##
            ##       ##     ## ####  ##    ##    ##     ## ##     ## ##       ##       ##       ##     ## ##
            ##       ##     ## ## ## ##    ##    ########  ##     ## ##       ##       ######   ########   ######
            ##       ##     ## ##  ####    ##    ##   ##   ##     ## ##       ##       ##       ##   ##         ##
            ##    ## ##     ## ##   ###    ##    ##    ##  ##     ## ##       ##       ##       ##    ##  ##    ##
             ######   #######  ##    ##    ##    ##     ##  #######  ######## ######## ######## ##     ##  ######
            */
            // if($_GET['mode']!='sub'){
                include("vista/vista_item_controles.php");
            // }
        
            
        echo "</div>";

        
        /*
         ######  ##     ## ########     #### ######## ######## ##     ##  ######
        ##    ## ##     ## ##     ##     ##     ##    ##       ###   ### ##    ##
        ##       ##     ## ##     ##     ##     ##    ##       #### #### ##
         ######  ##     ## ########      ##     ##    ######   ## ### ##  ######
              ## ##     ## ##     ##     ##     ##    ##       ##     ##       ##
        ##    ## ##     ## ##     ##     ##     ##    ##       ##     ## ##    ##
         ######   #######  ########     ####    ##    ######## ##     ##  ######
        */
        
        if($urd==1){
            
            // prin($load_subs);
            $load_subs_render=(sizeof($load_subs)>0)?1:0;
        
            $load_file_render=(sizeof($load_file)>0)?1:0;
        
            $load_exists_render=(sizeof($load_exists)>0)?1:0;
            
        }

        if($load_exists_render){

            render_foreig_exists($load_exists,$linea,$urd);

        }

        if($load_subs_render){

            // prin($load_subs,"load_subs");
            render_foreig_subs($load_subs,$linea[$datos_tabla['id']],$linea,$urd,$datos_tabla['sub_procesos']);
            // render_foreig_subs($load_subs,$linea,$urd,$datos_tabla['sub_procesos']);
        }

        if($load_file_render){

            render_foreig_file($load_file,$linea,$urd);
        
        }


        if(isset($_GET['i'])!=''){

            echo '<div class="more_detail itms_cont">';

            include($datos_tabla['detail_include']);

            echo '</div>';

        }
     
    
    echo "</li>";

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//		listado fin 	//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
}