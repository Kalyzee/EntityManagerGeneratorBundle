<?php

namespace Activpik\EntityManagerGeneratorBundle\Writer;

interface IWriter {

	function appendService($serviceClass, $serviceName, $servicePath);
	
	function getType();
	
}
