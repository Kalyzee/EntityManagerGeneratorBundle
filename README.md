EntityManagerGeneratorBundle
============================

[![Build Status](https://travis-ci.org/Kalyzee/EntityManagerGeneratorBundle.png?branch=master)](http://travis-ci.org/#!/Kalyzee/EntityManagerGeneratorBundle)

Entity Manager Generator for Symfony 2 

Works only with bundles with a services.xml config file. Next release will support the other format. 

Installation :

Add this line on your composer.json require

```
        "activpik/entity-manager-generator-bundle": "dev-master"
```

Update your deps with composer

```
	php composer.phar update
```

Update your AppKernel File :

```
$bundles = array(
...
new Activpik\EntityManagerGeneratorBundle\ActivpikEntityManagerGeneratorBundle(),
...
);
```

Usage

```
php app/console doctrine:generate:entitymanager ActivpikManagerBundle:Video
```

This command generates an VideoManager class in the same directory of your Video Entity.


Calling the entity manager in a controller :
```
$this->get("activpik_manager.video_manager");
```

Get the Doctrine Entity Repository
```
$this->get("activpik_manager.video_manager")->getRepository();
```

What is generated by this tool : 
A Basic Entity Manager in the Entity Directory

For our previous sample the result is :
In src/Activpik/ManagerBundle/Entity/VideoManager.php
```
<?php

namespace Activpik\ManagerBundle\Entity;

use Doctrine\ORM\EntityManager;

class VideoManager {

	protected $em;

	public function __construct(EntityManager $em) {

		$this->em = $em;
	}



	public function save(Video $entity){

		$this->em->persist($entity);
		$this->em->flush();
	}



	public function getRepository(){
		return $this->em->getRepository('ActivpikManagerBundle:Video');
	}

}
```

In service.xml we add theses line
```
<parameters>
...
<parameter key="activpik_manager.video_manager.class">Activpik\ManagerBundle\Entity\VideoManager</parameter>
...
</parameters>

<services>
...
	<service id="activpik_manager.video_manager" class="%activpik_manager.video_manager.class%"><argument type="service" id="doctrine.orm.entity_manager"/></service>
...
</services>
```
