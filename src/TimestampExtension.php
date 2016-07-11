<?php

namespace Thunbolt\Doctrine\DI;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Events;
use Nette\DI\CompilerExtension;
use Thunbolt\Doctrine\Timestamp;
use Thunbolt\Doctrine\TimestampException;
use Thunbolt\Doctrine\TimestampSubscriber;

class TimestampExtension extends CompilerExtension {

	/** @var array */
	public $defaults = [
		'subscriber' => TimestampSubscriber::class,
		'updateField' => 'updated',
		'createField' => 'created',
		'trait' => Timestamp::class,
		'recursive' => FALSE,
		'method' => 'updateTimestamp',
	];
	
	public function loadConfiguration() {
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);
		if (!trait_exists($config['trait'])) {
			throw new TimestampException("Trait $config[trait] not exists.");
		}

		$builder->addDefinition($this->prefix('subscriber'))
			->setClass($config['subscriber'], [
				[$config['updateField'], $config['createField']],
				$config['trait'],
				$config['method'],
				$config['recursive'],
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
