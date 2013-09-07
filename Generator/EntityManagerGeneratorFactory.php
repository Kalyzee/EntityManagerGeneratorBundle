<?php

namespace Activpik\EntityManagerGeneratorBundle\Generator;


use Activpik\EntityManagerGeneratorBundle\Generator\IEntityManagerGeneratorFactory;
use Activpik\EntityManagerGeneratorBundle\Generator\EntityManagerGenerator;

class EntityManagerGeneratorFactory implements IEntityManagerGeneratorFactory{

	private static $instance;
	
	private function __construct(){
		
	}
	
	public function createEntityManagerGenerator(){
		return new EntityManagerGenerator();
	}
	
	
	public static function getInstance(){
		if( self::$instance == null){
			self::$instance = new EntityManagerGeneratorFactory();
		}
		
		return self::$instance; 
	}
	
	
}
