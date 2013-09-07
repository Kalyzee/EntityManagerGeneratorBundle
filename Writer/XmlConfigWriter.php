<?php

namespace Activpik\EntityManagerGeneratorBundle\Writer;


use Activpik\EntityManagerGeneratorBundle\Writer\IWriter;

class XmlConfigWriter implements IWriter {

	public function appendService($serviceClass, $serviceName, $servicePath) {

		$domDocument = new \DOMDocument();
		$domDocument->load($servicePath);
		$containerElement = $domDocument
				->getElementsByTagNameNS(
						"http://symfony.com/schema/dic/services", "container")
				->item(0);
		$elements = $this
				->getOrCreateParametersElement($domDocument, $containerElement);

		$this
				->createParameterElement($domDocument, $elements, $serviceName,
						$serviceClass);

		$servicesElement = $this
				->getOrCreateServicesElement($domDocument, $containerElement,
						$serviceName);
		$service = $this
				->createServiceElement($domDocument, $servicesElement,
						$serviceName, $serviceClass);
		$this
				->createArgument($domDocument, $service, "service",
						"doctrine.orm.entity_manager");

		$domDocument->formatOutput = true;
		$domDocument->save($servicePath);

	}

	private function getOrCreateBaseNode($domDocument, $containerElement,
			$nodeName) {
		$elements = $domDocument
				->getElementsByTagNameNS(
						"http://symfony.com/schema/dic/services", $nodeName);

		if ($elements->length == 0) {
			//-- In
			$baseNode = $domDocument->createElement($nodeName);
			$containerElement->appendChild($parametersElement);
		} else {
			$baseNode = $elements->item(0);
		}

		return $baseNode;
	}

	protected function createParameterElement($domDocument, $parametersElement,
			$serviceName, $serviceClass) {

		$parameterElement = $domDocument->createElement("parameter");
		$parameterElement->setAttribute("key", $serviceName . ".class");
		$parameterElement
				->appendChild($domDocument->createTextNode($serviceClass));

		$parametersElement->appendChild($parameterElement);
	}

	protected function createServiceElement($domDocument, $servicesElement,
			$serviceName) {

		$parameterElement = $domDocument->createElement("service");
		$parameterElement->setAttribute("id", $serviceName);
		$parameterElement->setAttribute("class", "%" . $serviceName . ".class%");

		$servicesElement->appendChild($parameterElement);

		return $parameterElement;
	}

	protected function createArgument($domDocument, $serviceElement, $type,
			$value) {
		$argument = $domDocument->createElement("argument");
		$argument->setAttribute("type", $type);
		$argument->setAttribute("id", $value);
		$serviceElement->appendChild($argument);

	}

	protected function getOrCreateParametersElement($domDocument,
			$containerElement) {
		return $this
				->getOrCreateBaseNode($domDocument, $containerElement,
						"parameters");
	}

	protected function getOrCreateServicesElement($domDocument,
			$containerElement) {
		return $this
				->getOrCreateBaseNode($domDocument, $containerElement,
						"services");
	}
	public function getType() {
		return "xml";
	}

}
