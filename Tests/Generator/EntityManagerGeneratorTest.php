<?php

namespace Activpik\EntityManagerGeneratorBundle\Tests\Generator;

use Activpik\EntityManagerGeneratorBundle\Generator\EntityManagerGenerator;
class EntityManagerGeneratorTest extends \PHPUnit_Framework_TestCase{

	
	public function testToArray(){
		
		
		$emg = new EntityManagerGenerator();
		$emg->setName("VideoManager");
		$emg->setNamespace("Activpik\TestBundle\Entity");
		$emg->setEntityName("Video");
		
		
		$array = array();
		$array[] = "<?php\n\n";
		$array[] = "namespace Activpik\TestBundle\Entity;\n\n";
		$array[] = "use Doctrine\ORM\EntityManager;\n\n";
		
		$array[] = "class VideoManager {\n\n";
		$array[] = "";
		$array[] = "\tprotected \$em;\n\n";
		$array[] = "";
		$array[] = "";
		$array[] = "\tpublic function __construct(EntityManager \$em) {\n\n";
		$array[] = "\t\t\$this->em = \$em;\n";
		$array[] = "\t}\n\n";
		$array[] = "\n\n";
		$array[] = "\tpublic function save(Video \$entity){\n\n";
		$array[] = "\t\t\$this->em->persist(\$entity);\n";
		$array[] = "\t\t\$this->em->flush();\n";
		$array[] = "\t}\n\n";
		$array[] = "\n\n";
		$array[] = "";
		$array[] = "\tpublic function getRepository(){\n";
		$array[] = "\t\treturn \$this->em->getRepository('ActivpikTestBundle:Video');\n";
		$array[] = "\t}\n\n";
		$array[] = "}";
		
		$this->assertEquals($array, $emg->toArray());
		
	}
	
	
	
}
