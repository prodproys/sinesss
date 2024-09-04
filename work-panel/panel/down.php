<?php //á
//echo $_GET['file'];

include("lib/global.php");
include("lib/mysql3.php");
include("lib/util2.php");
include("lib/webutil.php");


//echo getcwd()."<br>";

//echo $_SERVER['DOCUMENT_ROOT']."<br>";

//chdir($_SERVER['DOCUMENT_ROOT'].$vars['REMOTE_FTP']['ftp_files_root']);

//echo getcwd()."<br>";
//echo $_GET['file']."<br>";
$file	=str_replace("../http:","http",str_replace("//","/",str_replace("///","","..//".$_GET['file'])));
if(substr($file,0,3)!='../'){
	$file=str_replace(str_replace("panel/","",$SERVER['BASE']),"../",str_replace("http/","http://",$file));
}
if(substr($file,0,3)!='../' and substr($file,0,2)=='..'){
	$file=str_replace("..","../",$file);
}

//$file	= $_GET['file'];

//echo getcwd()."<br>";
//echo $file."<br>";
//exit();


if(!file_exists($file))
{
	die('Error: File not found.');
}
//exit();


/*
 exit();
else
{*/
//exit();
$parts	=explode(".",$file);
$ext	=strtolower($parts[sizeof($parts)-1]);
//$len	=filesize($file);
$stat = stat($file);
//echo $stat['size'];
//$len=$stat['size'];
//die($stat['size']);
$name = str_replace(" ","_",$_GET['name']) . ".".$ext;
/*
 prin($name);
exit();
*/
$CONTENT['txt']="text/plain";
$CONTENT['pdf']="application/pdf";
$CONTENT['doc']="application/vnd.ms-word";
$CONTENT['xls']="application/vnd.ms-excel";

/*
 header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type: ".$CONTENT[$ext]); //or yours?
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".$stat['size'].";\n");
header("Content-Disposition: attachment; filename=" . $name.";");
*/

header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: ".$CONTENT[$ext]);
header("Content-Disposition: attachment; filename=\"".$name."\";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".$stat['size']);

readfile($file);


//}

