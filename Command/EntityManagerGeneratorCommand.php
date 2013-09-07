<?php
namespace Activpik\EntityManagerGeneratorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Activpik\EntityManagerGeneratorBundle\Generator\EntityManagerGenerator;
use Activpik\EntityManagerGeneratorBundle\Generator\EntityManagerGeneratorFactory;
use Activpik\EntityManagerGeneratorBundle\Writer\XmlConfigWriter;
use Activpik\EntityManagerGeneratorBundle\Writer\WriterFactory;


class EntityManagerGeneratorCommand extends ContainerAwareCommand
{
	
	private static $ENTITY_FOLDER = "Entity";
	private static $ENTITY_MANAGER_SUFFIX = "Manager";
	
	
    protected function configure()
    {
        $this
            ->setName('doctrine:generate:entitymanager')
            ->setDescription('Generate an Entity Manager Service for your entity')
            ->addArgument('entity', InputArgument::OPTIONAL, 'Define the entity for whose you want to build Entity Manager Service');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	
    	$writerFactory = WriterFactory::getInstance();
    	
    	$writerFactory->registerWriter(new XmlConfigWriter());
    	
        $entity = $input->getArgument('entity');
        $writerType = "xml";
		
        $arrayResult = explode(":", $entity);
        if (sizeof($arrayResult) == 2){
        	
        	$kernel = $this->getContainer()->get('kernel');
        	$bundle = $kernel->getBundle($arrayResult[0]);
        	$namespace = $bundle->getNamespace();
        	$path = $bundle->getPath();
        	//$output->write($path);
        	//$output->write($arrayResult[0]);
        	//$output->write($arrayResult[1]);
        	
        	$servicePath = $kernel->locateResource("@".$arrayResult[0]."/Resources/config/services.".$writerType);
        	
        	$this->createClass($arrayResult[1], $arrayResult[1].self::$ENTITY_MANAGER_SUFFIX, $namespace."\\".self::$ENTITY_FOLDER, $path."/entity/".$arrayResult[1].self::$ENTITY_MANAGER_SUFFIX.".php");
        	$writerFactory->createWriterFor($writerType)->appendService($namespace."\\".self::$ENTITY_FOLDER."\\".$arrayResult[1].self::$ENTITY_MANAGER_SUFFIX, $this->camelCase($entity.self::$ENTITY_MANAGER_SUFFIX), $servicePath);
        	
        	
        	$output->writeln("Your entity manager is created");
        	
        }
        

		
    
    }
    
    
    private function camelCase($string){
    	$string = preg_replace("/(?<=\\w)(?=[A-Z])/","_$1", $string);
		$string = strtolower($string);
		return $string;
    }
    
    protected function createClass($entity, $manager, $namespace, $file){
    	
    	$entityManagerGenerator = EntityManagerGeneratorFactory::getInstance()->createEntityManagerGenerator();
    	$entityManagerGenerator->setName($manager);
    	$entityManagerGenerator->setEntityName($entity);
    	$entityManagerGenerator->setNamespace($namespace);
    	file_put_contents($file, $entityManagerGenerator->toArray());
    }
    
}