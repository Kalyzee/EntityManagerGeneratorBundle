<?php

use Activpik\EntityManagerGeneratorBundle\Writer\XmlConfigWriter;
class XmlConfigWriterTest extends \PHPUnit_Framework_TestCase{

	
	public function testAppendService() {
		
		$xmlConfig = new XmlConfigWriter();
		$serviceClass = "ServiceManager";
		$serviceName = "activpik_service_manager";
		$servicePath = "./Tests/Resources/servicesNotEmpty.xml";
		$xmlConfig->appendService($serviceClass, $serviceName, $servicePath);
		
		
		/*$serviceClass = "ServiceManager";
		$serviceName = "activpik_service_manager";
		$servicePath = "./Tests/Resources/services.xml";
		$xmlConfig->appendService($serviceClass, $serviceName, $servicePath);*/
		
		
	}
	
	public function testGetType(){
		$xmlConfig = new XmlConfigWriter();
		$this->assertEquals("xml", $xmlConfig->getType());
		
	}
	
}
