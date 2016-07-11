<?php

namespace Thunbolt\Doctrine;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;

class TimestampSubscriber {

	/** @var array */
	private $fields;

	/** @var string */
	private $trait;

	/** @var bool */
	private $recursive;

	/** @var string */
	private $method;

	/**
	 * @param array $fields
	 * @param string $trait
	 * @param string $method
	 * @param bool $recursive
	 */
	public function __construct(array $fields, $trait, $method, $recursive = FALSE) {
		$this->fields = $fields;
		$this->trait = $trait;
		$this->recursive = $recursive;
		$this->method = $method;
	}

	/**
	 * @param LoadClassMetadataEventArgs $args
	 */
	public function loadClassMetadata(LoadClassMetadataEventArgs $args) {
		$metadata = $args->getClassMetadata();

		if ($this->hasTrait($metadata->getName())) {
			$metadata->addLifecycleCallback($this->method, Events::prePersist);
			$metadata->addLifecycleCallback($this->method, Events::preUpdate);

			foreach ($this->fields as $field) {
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

	/**
	 * @param string $class
	 * @return bool
	 */
	protected function hasTrait($class) {
		$traits = class_uses($class);
		if (!isset($traits[$this->trait])) {
			if ($this->recursive) {
				foreach ($traits as $trait) {
					return $this->hasTrait($trait);
				}
			}

			return FALSE;
		}

		return TRUE;
	}

}
