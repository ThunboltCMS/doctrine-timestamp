<?php

namespace Thunbolt\Doctrine;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

class TimestampSubscriber {

	/** @var array */
	private $fields = [];

	/** @var array */
	private $traits = [];

	/** @var array */
	private $methods = [];

	/** @var array */
	private $events;

	/**
	 * @param array $fields
	 * @param array $traits
	 * @param array $methods
	 * @param array $events
	 */
	public function __construct(array $fields, array $traits, array $methods, array $events) {
		$this->fields = $fields;
		$this->traits = $traits;
		$this->methods = $methods;
		$this->events = $events;
	}

	/**
	 * @param LoadClassMetadataEventArgs $args
	 */
	public function loadClassMetadata(LoadClassMetadataEventArgs $args) {
		$metadata = $args->getClassMetadata();
		$metadataTraits = class_uses($metadata->getName());

		foreach ($this->traits as $category => $trait) {
			if (isset($metadataTraits[$trait])) {
				foreach ($this->events[$category] as $event) {
					$metadata->addLifecycleCallback($this->methods[$category], $event);
				}
				foreach ($this->fields[$category] as $field) {
					if (!$metadata->hasField($field)) {
						$metadata->mapField(array(
							'fieldName' => $field,
							'type' => 'datetime',
							'nullable' => TRUE,
						));
					}
				}
			}
		}
	}

}
