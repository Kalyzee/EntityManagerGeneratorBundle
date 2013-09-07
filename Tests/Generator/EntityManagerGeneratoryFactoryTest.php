<?php

namespace Activpik\EntityManagerGeneratorBundle\Tests\Generator;

use Activpik\EntityManagerGeneratorBundle\Generator\EntityManagerGeneratorFactory;
use Activpik\EntityManagerGeneratorBundle\Generator\IEntityManagerGenerator;


class EntityManagerGeneratorFactoryTest extends \PHPUnit_Framework_TestCase{
	
	
	public function testCreateEntityManagerGenerator() {
		
		$emg = EntityManagerGeneratorFactory::getInstance()->createEntityManagerGenerator();
		$this->assertTrue($emg instanceof IEntityManagerGenerator);
	}
	
	public function testGetInstance() {
		$emgf = EntityManagerGeneratorFactory::getInstance();
		$this->assertNotNull($emgf);
		$this->assertEquals($emgf, EntityManagerGeneratorFactory::getInstance()); 
	}
}
