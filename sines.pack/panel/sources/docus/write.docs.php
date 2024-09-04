<?php

// echo getcwd();
include("../../../../work-panel/panel/lib/mysql3.php");
include("../../../../work-panel/panel/lib/util2.php");
$PATH_WORK_PANEL_li_tabla_classes="../../../../work-panel/panel/";
include("../../config/tablas.php");
// prin($objeto_tabla);


$directories['controllers']='../../controllers';
$directories['jades']='../../sources/jade';
$directories['babels']='../../sources/babel';


$names['controllers']='CONTROLADORES';
$names['jades']='PLANTILLAS';
$names['babels']='JAVASCRIPT';

$names_flip = array_flip($names);

$tocopy=array_merge([
    'README'
],$names_flip);

// prin($names_flip);

// echo getcwd();
// no activar
if(0)
foreach($directories as $tipo=>$dir){

    $ficheros  = scandir($dir);
    // prin($ficheros);
    foreach($ficheros as $ii=> $file){
        if(
            !in_array($file,[".",".."])
            and !is_dir($file)
            // and $ii==2
            )
        {

            $file_full=$dir."/".$file;
            // prin(file($dir."/".$file));
            $read=implode("",file($file_full));
            
            $autor="Sinesss";
            
            $repla ="";

            if($tipo=='controllers'){

                $repla.="<?php\n";
                $repla.="/**\n";
                $repla.="**** \n";
                $repla.="* Archivo: $file\n";
                $repla.="* Author: $autor\n";
                $repla.="* Tipo: Controlador\n";
                $repla.="* Lenguaje: PHP\n";
                $repla.="* Descripción: Este archivo tiene la finalidad de \n";
                $repla.="**** \n";
                $repla.="*/\n\n";

                $read=str_replace("<?php",$repla,$read);

            }

            elseif($tipo=='jades'){

                $fileT=str_replace(".jade",".php",$file);

                $repla.="//- ****\n";
                $repla.="//- Archivo: $file\n";
                $repla.="//- Archivo Transpilado: panel/views/dist/$fileT\n";
                $repla.="//- Author: $autor\n";
                $repla.="//- Tipo: Plantilla de vista PHP\n";
                $repla.="//- Lenguaje: Pug\n";
                $repla.="//- Descripción: Este archivo tiene la finalidad de \n";
                $repla.="//- ****\n";
                $repla.="//- \n\n";

                $read=$repla.$read;

            }        

            elseif($tipo=='babels'){

                $repla.="// ---- \n";
                $repla.="// Archivo: $file\n";
                $repla.="// Archivo Transpilado: work-panel/public/js/bundle.js\n";
                $repla.="// Autor: $autor\n";
                $repla.="// Tipo: Plantilla de Javascript\n";
                $repla.="// Lenguaje: Javacript Ecmascript 6\n";
                $repla.="// Descripción: Este archivo tiene la finalidad de \n";
                $repla.="// ---- \n";
                $repla.="// \n\n";

                $read=$repla.$read;

            }            




            // echo "<textarea style='width:100%;height:300px;'>".$read."</textarea>";
            
            if(1){

                $fp = fopen($file_full, 'w');
                fwrite($fp,$read);
                fclose($fp);

            }

            
            echo "$file_full<br>";
            
        }
    }

}


$searc=["* ","//- ","// "];

// no activar
if(0){

    $tablitas=[];
    $bdsql=implode("",file("panel_sines.sql"));
    $bdsql_A=explode("CREATE TABLE ",$bdsql);
    foreach($bdsql_A as $eee=> $tab_S){
        if($eee>0){
            $tab_A=explode("\n",$tab_S);
            foreach($tab_A as $iii=>$tab){
                if($iii==0){ $key_A=explode('`',$tab); $key_B=$key_A[1]; }
                elseif(
                    substr(trim($tab),0,1)=="`" and
                    enhay($tab,'COMMENT')
                    ){ 
                    $key_C=explode('COMMENT',$tab);
                    $key_D=explode("`",$key_C[0]);
                    $campitos[$key_D[1]]=$key_C[1];

                }
                elseif(
                    enhay($tab,'ENGINE')
                    ){ 
                    $key_C=explode('COMMENT',$tab);
                    $key_D=explode("`",$key_C[0]);
                    $comment=$key_C[1];

                }            
            }  
            $tablitas[$key_B]['campos']=$campitos; 
            $tablitas[$key_B]['comment']=$comment; 
            unset($campitos);
            unset($comment);
        }
    }
    unset($tablitas['peopleold']);

    $md="# BASE DE DATOS\n";
    foreach($tablitas as $tabla => $datos){

        // $var_array['base_de_datos'][$tabla]=['Archivo'=>$tabla];
        $var_array['base_de_datos'][$tabla]="";
        
        $md.="# ".$tabla."\n";
        $md.=$datos['comments']."\n\n";
        foreach($datos['campos'] as $fil => $var_a){
            $md.="* **$fil** : ".str_replace([",","'"],"",trim($var_a))."\n";
        }
        $md.="\n";


    }

    $fp = fopen("base_de_datos.md", 'w');
    fwrite($fp,$md);
    fclose($fp);

}


if(0){

    $md="# MODELOS\n";
    foreach($objeto_tabla as $tabla => $datos){

        // $var_array['base_de_datos'][$tabla]=['Archivo'=>$tabla];
        $var_array['modelos'][$tabla]="";
        
        $md.="# ".$tabla."\n";
        // $md.=$datos['comments']."\n\n";
        foreach($datos['campos'] as $fil => $var_a){
            $md.="* **$fil** : ".$var_a['label']."\n";
        }
        $md.="\n";


    }

    $fp = fopen("modelos.md", 'w');
    fwrite($fp,$md);
    fclose($fp);

}

$names['modelos']="MODELOS";
$names_flip["MODELOS"]='modelos';

// prin($var_array);
$names['base_de_datos']="BASE DE DATOS";
$names_flip["BASE DE DATOS"]='base_de_datos';



if(0){

    foreach($directories as $tipo=>$dir){

        $ficheros  = scandir($dir);
        // prin($ficheros);
        foreach($ficheros as $ii=> $file){
            if(
                !in_array($file,[".",".."])
                and !is_dir($file)
                // and $ii==2
                )
            {

                $file_full=$dir."/".$file;
                // prin(file($dir."/".$file));
                $read=implode("",file($file_full));
                
                $autor="Sinesss";
                
                $repla ="";


                if($tipo=='controllers'){

                    $marks="****";
                    $pre="//- ";

                }

                elseif($tipo=='jades'){

                    $marks="//- ****";
                    $pre="* ";

                }        

                elseif($tipo=='babels'){

                    $marks="// ----";
                    $pre="// ";

                }            

                $parts=explode($marks,$read);
                $vars_str=$parts[1];
                $vars=explode("\n",trim($vars_str));
                foreach($vars as $var){
                    $var_part=explode(":",trim($var));
                    $var_array[$tipo][$file][str_replace($searc,"",$var_part[0])]=$var_part[1];
                }




                // echo "<textarea style='width:100%;height:300px;'>".$read."</textarea>";
                


                
                // echo "$file_full<br>";
                
            }

        }

        // prin($var_array);

        foreach($var_array as $file => $var_arr){

            $md="# ".$names[$file]."\n";
            foreach($var_arr as $fil => $var_a){
                $md.="# $fil\n";
                foreach($var_a as $var_b => $val_b){
                    if($var_b!='Descripción')
                    $md.="* **$var_b** : $val_b\n";
                }
                $md.="### Descripción\n";
                $md.="$val_b\n\n";
            }

            if($file!='base_de_datos')
            if($file!='modelos')
            if(1){

                $fp = fopen($file.".md", 'w');
                fwrite($fp,$md);
                fclose($fp);

            }        

        }




        
        // prin($var_array);

    }


    $readme_file="README.md";

    $readRE=implode("",file($readme_file));

    $readRE_A=explode("-",$readRE);

    foreach($readRE_A as $uu=>$readRE_I){

        $readRE_AA=explode("\n",$readRE_I);

        foreach($readRE_AA as $readRE_II){
            
            $readRE_II_trim=trim($readRE_II);
            if(in_array($readRE_II_trim,$names)){
                // prin($readRE_I);
                // prin(trim(str_replace($readRE_II,"",$readRE_I)));
                if(trim(str_replace($readRE_II,"",$readRE_I))==''){
                    $reppe="";
                    foreach($var_array[$names_flip[$readRE_II_trim]] as $fili=>$fili_arr){
                        $reppe.="\t* $fili\n";
                    }
                    $readRE_A[$uu]=str_replace($readRE_II,$readRE_II."\n".$reppe,$readRE_A[$uu]);
                }
            }

        }        

    }

    $fp = fopen($readme_file, 'w');
    fwrite($fp,implode("-",$readRE_A));
    fclose($fp);

}


if(0)
foreach($tocopy as $fil){

    copy($fil.".md","../../../../".$fil.".md");

}

