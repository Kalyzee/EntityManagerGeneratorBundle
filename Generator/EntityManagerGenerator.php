<?php

namespace Activpik\EntityManagerGeneratorBundle\Generator;


class EntityManagerGenerator implements IEntityManagerGenerator {

	private $name;
	private $namespace;
	private $entityName;

	public function __construct(){
		
	}
	
	public function setNamespace($namespace) {
		$this->namespace = $namespace;
	}

	public function getNamespace() {
		return $this->namespace;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the Array result
	 */
	public function toArray() {
		
		$array = array();		
		$array[] = "<?php\n\n";
		$array[] = "namespace ".$this->namespace.";\n\n";
		$array[] = "use Doctrine\ORM\EntityManager;\n\n";
		
		$array[] = "class ".$this->name." {\n\n";
		$array[] = "";
		$array[] = "\tprotected \$em;\n\n";
		$array[] = "";
		$array[] = "";
		$array[] = "\tpublic function __construct(EntityManager \$em) {\n\n";
		$array[] = "\t\t\$this->em = \$em;\n";
		$array[] = "\t}\n\n";
		$array[] = "\n\n";		
		$array[] = "\tpublic function save(".$this->entityName." \$entity){\n\n";
		$array[] = "\t\t\$this->em->persist(\$entity);\n";
		$array[] = "\t\t\$this->em->flush();\n";
		$array[] = "\t}\n\n";
		$array[] = "\n\n";
		$array[] = "";
		$array[] = "\tpublic function getRepository(){\n";
		$array[] = "\t\treturn \$this->em->getRepository('".$this->getRepository()."');\n";
		$array[] = "\t}\n\n";		
		$array[] = "}";
		
		return $array;
	}
	
	/**
	 *  
	 * @param unknown $namespace
	 */
	private function getRepository(){
		$namespace = str_replace("\\", "", $this->namespace.":".$this->entityName);
		$namespace = str_replace("Entity", "", $namespace);
		return $namespace;
	}
	public function getEntityName() {
		return $this->entityName;
	}
	public function setEntityName($entityName) {
		$this->entityName = $entityName;

	}

}
