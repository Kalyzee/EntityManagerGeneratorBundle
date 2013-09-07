<?php

namespace Activpik\EntityManagerGeneratorBundle\Generator;

interface IEntityManagerGenerator extends IGenerator{
	function getEntityName();
	function setEntityName($entityName);	
}
