<?php

namespace Thunbolt\Doctrine\DI;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Events;
use Nette\DI\CompilerExtension;
use Thunbolt\Doctrine\Traits\Timestamp;
use Thunbolt\Doctrine\TimestampException;
use Thunbolt\Doctrine\TimestampSubscriber;
use Thunbolt\Doctrine\Traits\TimestampCreated;
use Thunbolt\Doctrine\Traits\TimestampUpdated;

class TimestampExtension extends CompilerExtension {

	/** @var array */
	public $defaults = [
		'subscriber' => TimestampSubscriber::class,
		'fields' => [
			'main' => ['updated', 'created'],
			'created' => ['created'],
			'updated' => ['updated'],
		],
		'traits' => [
			'main' => Timestamp::class,
			'created' => TimestampCreated::class,
			'updated' => TimestampUpdated::class,
		],
		'methods' => [
			'main' => 'updateTimestamp',
			'created' => 'updateCreated',
			'updated' => 'updateUpdated',
		],
		'events' => [
			'main' => [Events::preUpdate, Events::prePersist],
			'created' => [Events::prePersist],
			'updated' => [Events::preUpdate, Events::prePersist],
		]
	];
	
	public function loadConfiguration() {
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);
		foreach ($config['traits'] as $trait) {
			if (!trait_exists($trait)) {
				throw new TimestampException("Trait '$trait' not exists.");
			}
		}

		$builder->addDefinition($this->prefix('subscriber'))
			->setClass($config['subscriber'], [
				$config['fields'],
				$config['traits'],
				$config['methods'],
				$config['events'],
			]);
	}

	public function beforeCompile() {
		$builder = $this->getContainerBuilder();

		$service = $builder->getByType(EntityManager::class);
		if (!$service) {
			throw new TimestampException('Class ' . EntityManager::class . ' not found in DIC.');
		}
		$builder->getDefinition($service)
			->addSetup('?->getEventManager()->addEventListener(?, ?)', ['@self', Events::loadClassMetadata, $this->prefix('@subscriber')]);
	}

}
