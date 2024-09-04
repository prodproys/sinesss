<?php

if( $_SESSION['edicionpanel']=='1' or 1){
    ?>
        <script>
    function modificar_dato_valor(me,indice,valor){
    datos = {
        me			: me,
        indice		: indice,
        valor		: valor
    };
    new Request({url:"modificar_objeto.php", method:'post', data:datos, onSuccess: function(eee){
    if(eee.trim()!=''){ alert(eee);
    } else {
    $('idid_'+indice+'_'+me).removeClass('onon');
    $('idid_'+indice+'_'+me).removeClass('offoff');
    $('idid_'+indice+'_'+me).addClass((valor==1)?'onon':'offoff');
    $('idid_'+indice+'_'+me).removeProperty('onclick');
    $('idid_'+indice+'_'+me).setProperty('onclick','javascript:modificar_dato_valor(\''+me+'\',\''+indice+'\',\''+( (valor==1)?'0':'1' )+'\'); return false;');
    
        <?php if($_GET['me']!=''){?>
            racargar_partes();
        <?php } ?>
    }
    } } ).send();
    }
    function procesar_objt(){
    datos = {
        me			: '<?php echo $MEME?>',
        'indice'	: 'json',
        'json'		: $('jjjson').value
    };
    new Request({url:"modificar_objeto.php", method:'post', data:datos, onSuccess: function(eee){
    if(eee.trim()!='')
        alert(eee);
    else
    <?php if($_GET['me']){ ?>
        location.href='?rn=<?php echo rand();?>&me=<?php echo $MEME;?>&save=campo#edicion_indices_sub';
    <?php } else { ?>
        location.href='custom/<?php echo $SERVER['ARCHIVO'];?>?rn=<?php echo rand();?>#eth';
    <?php } ?>
    } } ).send();
    }
    
    </script><?php
    
    }