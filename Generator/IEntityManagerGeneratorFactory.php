<?php

namespace Activpik\EntityManagerGeneratorBundle\Generator;


use Activpik\EntityManagerGeneratorBundle\Generator\EntityManagerGenerator;
interface IEntityManagerGeneratorFactory {
	
	/**
	 * Return tool for generating Entity Manager
	 * @Return IEntityManagerGenerator
	 */
	public function createEntityManagerGenerator();
	
	
}
