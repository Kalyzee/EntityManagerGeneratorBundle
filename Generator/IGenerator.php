<?php

namespace Activpik\EntityManagerGeneratorBundle\Generator;

/**
 * Interface for generating php class
 * @author Ludovic Bouguerra <ludovic.bouguerra@kalyzee.com>
 *
 */
interface IGenerator {
	
	public function setNamespace($namespace);
	public function getNamespace();
	
	public function getName();
	public function setName($name);
	
	/**
	 * Returns the string result
	 */
	public function toArray();
	
}
