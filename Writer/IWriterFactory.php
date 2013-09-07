<?php

namespace Activpik\EntityManagerGeneratorBundle\Writer;

use Activpik\EntityManagerGeneratorBundle\Writer\IWriter;
interface IWriterFactory {
	
	/**
	 * Create a Writer for FileType
	 * @param fileType : Can be xml, yml or other registered fileType
	 */
	public function createWriterFor($fileType);
	
	/**
	 * Register a FileTypeWriter for a class
	 * @param IWriter $class
	 */
	public function registerWriter(IWriter $class);
	
}
