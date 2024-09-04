<?php


if($lineassize==0){
		
    // echo '<div class="nohay">0 '.$datos_tabla['nombre_plural'].'</div>';
    
} else {

    // prin($paginas_linea);
    if($_GET['i']==''){
        
        if( ($tblistadosize!='0') ){
            render_view([
                // 'prev'=>$anterior_linea,
                // 'next'=>$siguiente_linea,
                'current'=>($_GET['pag'])?$_GET['pag']:'1',
                'train'=>$paginas_linea,
                'range'=>($total_linea==$lineassize)?"":"(desde $desde_linea hasta $hasta_linea)",
                'total'=>[
                    'num'=>$total_linea,
                    'item'=>($total_linea==1)?$datos_tabla['nombre_singular']:$datos_tabla['nombre_plural']
                ]
            ],"pager.php");

        }

    } else {

        echo '<span id="barra_paginacion"></span>';

    }


}