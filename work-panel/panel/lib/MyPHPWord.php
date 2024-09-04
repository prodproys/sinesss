<?php

class MyPHPWord_Template extends PHPWord_Template {

	public $dok;

	public function __construct($strFilename) {
		$path = dirname($strFilename);
		$this->_tempFileName = $path.DIRECTORY_SEPARATOR.time().'.docx';

		copy($strFilename, $this->_tempFileName); // Copy the source File to the temp File

		$this->_objZip = new ZipArchive();
		$this->_objZip->open($this->_tempFileName);

		$this->dok = $this->_documentXML = $this->_objZip->getFromName('word/document.xml');
	}

   public function setValue($search, $replace) {

			if(substr($search, 0, 2) !== '{' && substr($search, -1) !== '}') {
				$search = '{'.$search.'}';
			}
		  
			if(!is_array($replace)) {
		   	$replace = utf8_encode($replace);
			}
			$this->_documentXML = str_replace($search, $replace, $this->_documentXML);

    }

    public function save($strFilename) {
        if(file_exists($strFilename)) {
            unlink($strFilename);
        }
        
        $this->_objZip->addFromString('word/document.xml', $this->_documentXML);
        
        // Close zip file
        if($this->_objZip->close() === false) {
            throw new Exception('Could not close zip file.');
        }
        
        rename($this->_tempFileName, $strFilename);
    }    

}

class MyPHPWord extends PHPWord {

	public $dok;

    public function MyloadTemplate($strFilename) {
        if(file_exists($strFilename)) {
            $template = new MyPHPWord_Template($strFilename);
            $this->dok=$template->dok;
            return $template;
        } else {
            trigger_error('Template file '.$strFilename.' not found.', E_ERROR);
        }
    }

}