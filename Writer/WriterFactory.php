<?php

namespace Activpik\EntityManagerGeneratorBundle\Writer;


class WriterFactory implements IWriterFactory {

	private static $instance;

	private $fileTypeManager = array();
	
	private function __construct(){
		
	}

	public function createWriterFor($fileType) {
		
		if (isset($this->fileTypeManager[$fileType])){
			return $this->fileTypeManager[$fileType];
		}else{
			throw new WriterNotFoundException("Writer not found for fileType ".$fileType);
		}
		
	}
	public function registerWriter(IWriter $object) {
		$this->fileTypeManager[$object->getType()] = $object;
	}
	
	public static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new WriterFactory();
		}
		return self::$instance;
	}

}
