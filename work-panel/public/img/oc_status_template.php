<style>

.pdf {
    width:99%;
    /* padding-left:35%; */
}

.pdf .title {
    width:100%;
    text-align:center;
    margin-bottom:15px;
    margin-top:0px;
    font-size:18px;
}

.pdf .legend {
    width:100%;
    padding-top:30px;
    padding-left:4px;
}
.pdf table.linea {
    width:100%;
    padding-top:5px;
}
.pdf table.lin {
    width:100%;
    /* float:left; */
    border:1px solid #fff;
    /* background-color:#000; */
}
.pdf table label {
    /* font-weight:bold; */
    color:#033;
    padding-right:10px;
    margin:0px;
    /* font-size:10px; */
    /* display:inline-block; */
}

</style>
<?php 

function table($array){

    global $ordenCompra;
    $html="";
    $html.="<table class='linea'><tr>";
    foreach($array as $key=>$item){
        $html.="<td style='width:".$item['w']."%; padding:0;margin:0;background:#f6f3f3;'>";
            $html.="<table class='lin' style='border:none;padding:0;margin:0;' ><tr>";
            $html.="<td bgcolor='#fff'><label>".$item['label']."</label> : </td>";
            $html.="<td>".$ordenCompra[$key]."</td>";
            $html.="</tr></table>";
        $html.="</td>";
    }
    $html.="</tr></table>";
    echo $html;
}

$boletafactura=[
    '1'			=> 'BOLETA',
    '2'			=> 'FACTURA'
];

?>

<div class="pdf">

<table style='width:100%;padding-top:0px;padding-bottom:20px;font-weight:bold;'>
<tr>
    <td valign=bottom style='width:50%;text-align:left;'>
    <?php echo fecha_formato($ordenCompra['orden_fecha'],'10');?>
    </td>
    <td valign=bottom style='width:45%;text-align:right;'>
    <?php echo $boletafactura[$ordenCompra['orden_tipo_recibo']];?>
    </td>
</tr> 
</table>


<div><img src="img/logop.png" width="380px;" /></div>
<div><img src="img/logopdf.png" width="380px;" /></div>

<div class=" li_id title"><strong>ORDEN DE COMPRA N <?php printf('%08d',$ordenCompra['orde_numero']);?></strong></div>





<?php 

table([
    'asesor_nombre'    =>['label'=>'EJECUTIVO DE VENTA','w'=>70],
]);

?>

<div class="legend"><strong>DATOS DEL CLIENTE</strong></div>

<?php 

table([
    'cliente_nombre'    =>['label'=>'SR(A)','w'=>70],
    'cliente_dni'       =>['label'=>'DNI/RUC','w'=>30],
]);

table([
    'cliente_empresa'    =>['label'=>'EMPRESA','w'=>75],
    'cliente_ruc'       =>['label'=>'RUC','w'=>25],
]);

table([
    'cliente_direccion'    =>['label'=>'DIRECCIÓN','w'=>100],
]);

table([
    'cliente_telefono'    =>['label'=>'TELEF','w'=>30],
    'cliente_celular'       =>['label'=>'CELULAR','w'=>35],
    'cliente_pc'       =>['label'=>'P/C','w'=>35],
]);

table([
    'cliente_email'    =>['label'=>'EMAIL','w'=>50],
    'cliente_negocio'       =>['label'=>'GIRO DEL NEGOCIO','w'=>50],
]);

table([
    'cliente_fecha_cliente'    =>['label'=>'F.NAC/ANIV','w'=>40],
    'cliente_profesion'       =>['label'=>'PROFESION','w'=>60],
]);

table([
    'cliente_estado_civil'    =>['label'=>'ESTADO CIVIL','w'=>30],
    'cliente_conyuge'       =>['label'=>'CONYUGE','w'=>70],
]);

table([
    'cliente_facturara'       =>['label'=>'FACTURAR A','w'=>50],
]);

?>

<div class="legend"><strong>DATOS DEL VEHICULO</strong></div>

<?php 
table([
    'producto_marca'    =>['label'=>'MARCA','w'=>25],
    'producto_modelo'   =>['label'=>'MODELO','w'=>25],
    'producto_color'    =>['label'=>'COLOR','w'=>25],
    'producto_anio'     =>['label'=>'AÑO','w'=>25]
]);

table([
    'producto_vin'    =>['label'=>'CHASIS/VIN','w'=>40],
    'producto_separado'   =>['label'=>'SEPARADO','w'=>40],
]);

table([
    'producto_vin'    =>['label'=>'PRECIO DEL VEHICULO','w'=>30],
    'producto_descuento'   =>['label'=>'DSCTO %','w'=>35],
    'producto_tc'   =>['label'=>'T/C (del día)','w'=>35],
]);

table([
    'producto_precio_facturar'    =>['label'=>'PRECIO A FACTURAR','w'=>50],
    'producto_conversion'   =>['label'=>'CONVERSION GLP/GNV','w'=>50],
]);

table([
    'producto_credito_vehicular'    =>['label'=>'CREDITO VEHICULAR<','w'=>25],
    'producto_credito_leasing'   =>['label'=>'REDITO LEASING','w'=>25],
    'producto_contado'    =>['label'=>'CONTADO','w'=>25],
    'producto_otros'     =>['label'=>'OTROS','w'=>25]
]);
?>

<table style='width:100%;margin-top:130px;padding-bottom:30px;'>
<tr>
    <td style='width:7%;'></td>
    <td valign=bottom style='width:20%;border-top:1px solid #000;text-align:center;'>
        CLIENTE
    </td>
    <td style='width:13%;'></td>
    <td valign=bottom style='width:20%;border-top:1px solid #000;text-align:center;'>
        VENDEDOR
    </td>
    <td style='width:13%;'></td>
    <td valign=bottom style='width:20%;border-top:1px solid #000;text-align:center;'>
        JEFE DE TIENDA
    </td>  
</tr> 
</table>
<div class="nota">
Nota: El cliente declara tener el conocimiento de las políticas de garantía del vehículo.
Si por cualquier circunstancia el comprador decide dejar sin efecto la presente orden de compra, que a convenida en
forma irrevocable que asumirá los gastos administrativos que esto represente.
Sírvase tomar nota de las demoras en los tramites de placa y tarjeta de rodaje
</div>

<div class="legend"><strong>DATOS ADICIONALES</strong></div>

<?php 
table([
    'adicional_marketing'    =>['label'=>'CODIGO DE MARKETING','w'=>50],
    'adicional_origen_fondos'   =>['label'=>'ORIGEN DE FONDOS','w'=>50],
]);

table([
    'adicional_observaciones'    =>['label'=>'OBSERVACIONES','w'=>100],
]);
?>

</div>