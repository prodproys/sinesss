<?php //á
if($JAVASCRIPT_FRAMEWORK=="jquery"){
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
<!-- <script src="js/plugins.js"></script>-->
<script src="js/vendor/bootstrap.min.js"></script>
<script src="config/main.js?r=032"></script>

<?php } else { 

if($_GET['block']!='form'){
?>
<div class="foot bloque">
	<div>
		<span id='pagespan'></span>
		<script>window.addEvent('domready',function(){ loadinfopage(); });</script>
		
		<?php if($Local){ ?>
		<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/sistemapanel/panel" target="_blank"><?php echo $vars['GENERAL']['factory'];?></a> |
		<?php } ?>

		<a href="<?php echo $vars['GENERAL']['by_url'];?>" target="_blank"><?php echo $vars['GENERAL']['by_label'];?></a>
		
		<?php if($Local){ ?>
		| <a href="maquina.php">Master</a>
		<?php } else { ?>
		<a href="maquina.php" style="text-decoration: none; color: #DDDDFF; cursor: text;">&nbsp;&nbsp;</a>
		<?php } ?>
		
	</div>
</div>
<?php }
if($needs['img'] or 1){
?>
<script>
var initMultiBox;
function charge_multibox(MB=null){
	// console.log('recargar charge_multibox:'+MB);
	/*if(MB=='.mbb'){ alert(MB); }*/
	$$(".ToolTips").empty();
	$$(".ToolTips").dispose();
	//call multiBox
	beforemulti();
	initMultiBox = new multiBox({
		mbClass               : (MB)?MB                                                       : '.mb',//class you need to add links that you want to trigger multiBox with (remember and update CSS files)
		container             : $(document.body),//where to inject multiBox
		descClassName         : 'multiBoxDesc',//the class name of the description divs
		path                  : './swf/',//path to mp3 and flv players
		useOverlay            : false,//use a semi-transparent background. default            : false;
		maxSize               : <?php if($_GET['block']== 'form'){ ?>{w: 600, h: 300}<?php }else{ ?>{w: 1400, h: 1000}<?php } ?>,//max dimensions (width,height) - set to null to disable resizing
		addDownload           : false,//do you want the files to be downloadable?
		//pathToDownloadScript: './Scripts/ForceDownload.asp',//if above is true, specify path to download script (classicASP and ASP.NET versions included)
		addRollover           : false,//add rollover fade to each multibox link
		//addOverlayIcon      : true,//adds overlay icons to images within multibox links
		addChain              : false,//cycle through all images fading them out then in
		recalcTop             : true//subtract the height of controls panel from top position
		//addTips             : true//adds MooTools built in 'Tips' class to each element (see: http: //mootools.net/docs/Plugins/Tips)
	});

	$$('.MultiBoxClose').addEvent('click',function(){
		if($$('.MultiBoxContainer #MultiBoxContentContainer iframe').getProperty('src').length!=0){
			if($('edit_hidd').value!=''){
				ax("recargar");
				$('edit_hidd').value='';
			}
		}
	});

	<?php if($_GET['justlist']=='1' and $_GET['id']!='') { ?>
		parent.document.getElementById('edit_hidd').value='<?php echo $_GET['id']; ?>';
	<?php } ?>


}
</script>
<?php } ?>
<?php if($needs['mootooltips']){ ?>
<script>
function charge_tooltips(){
	//alert(0); return;
	new MooTooltips({
		hovered:'.tipper',		// the element that when hovered shows the tip
		ToolTipClass:'ToolTips',	// tooltip display class
		toolTipPosition:-1, // -1 top; 1: bottom - set this as a default position value if none is set on the element
		fromTop:5,		// distance from mouse or object
		fromLeft: -30,	// distance from left
		duration: 500,		// fade effect transition duration
		fadeDistance: 10,    // the distance the tooltip starts the morph
		sticky:false,
		ajax_message: 'cargando...'
	});
}
</script>
<?php } ?>
<script>
<?php echo $objeto_tabla[$datos_tabla['me']]['javascript']; ?>
</script>
<?php } ?>