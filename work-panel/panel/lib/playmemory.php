<?php //á



		

		if(!(file_exists("config/memory.txt"))){

		

			$bufer ="";

			foreach($objeto_tabla as $ot){

				$bufer.="\$saved['".$ot['me']."']=array(";

					$subbufer=array();

					$subbufer[]="'live'=>'1'";

//					$subbufer[]="'crearopen'=>'0'";

				$bufer.=implode(",",$subbufer);

				$bufer.=");";

			}

			eval($bufer);

			$f1=fopen("config/memory.txt","w+");

			fwrite($f1,serialize($saved));		

			fclose($f1); 

			

		}	

				

		@$bu=implode("\n",file("config/memory.txt"));

		$saved=unserialize($bu);

		

		if($_GET['mi']!=''){

		

			$saved[$_GET['mi']][$_GET['cam']]=$_GET['set'];

			$f1=fopen("config/memory.txt","w+");

			fwrite($f1,serialize($saved));		

			fclose($f1); 

			if($_GET['ajax']!='1'){

				redireccionar();

			}

						

		} 		

	

		

?>