<?php

namespace Activpik\EntityManagerGeneratorBundle\Writer;


class WriterNotFoundException extends \Exception{

	public function __construct($message){
		parent::__construct($message);
	}
	
}
