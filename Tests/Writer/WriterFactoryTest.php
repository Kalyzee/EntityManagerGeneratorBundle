<?php

namespace Activpik\EntityManagerGeneratorBundle\Tests\Writer;

use Activpik\EntityManagerGeneratorBundle\Writer\WriterFactory;
use Activpik\EntityManagerGeneratorBundle\Writer\XmlConfigWriter;
use Activpik\EntityManagerGeneratorBundle\Writer\WriterNotFoundException;

class WriterFactoryTest extends \PHPUnit_Framework_TestCase{
	
	
	public function testCreateAndRegisterWriter() {
		
		WriterFactory::getInstance()->registerWriter(new XmlConfigWriter());
		
		$this->assertTrue(WriterFactory::getInstance()->createWriterFor("xml") instanceof XmlConfigWriter);
		try{
			WriterFactory::getInstance()->createWriterFor("zml");
			$this->assertFail();
		}catch(WriterNotFoundException $e){
			
		}
		
	}
	
	public function testGetInstance() {
		$this->assertEquals(WriterFactory::getInstance(), WriterFactory::getInstance()); 
	}
}
