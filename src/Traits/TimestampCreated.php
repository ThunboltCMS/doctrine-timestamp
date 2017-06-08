<?php

declare(strict_types=1);

namespace Thunbolt\Doctrine\Traits;

use DateTime;

trait TimestampCreated {

	/** @var \DateTime */
	protected $created;

	/**
	 * @internal
	 */
	public function updateCreated(): void {
		if ($this->created === NULL) {
			$this->created = new \DateTime();
		}
	}

	/////////////////////////////////////////////////////////////////

	/**
	 * @return DateTime
	 */
	public function getCreated(): DateTime {
		return $this->created;
	}

	/**
	 * @param DateTime $created
	 * @return self
	 */
	public function setCreated(DateTime $created) {
		$this->created = $created;

		return $this;
	}

}
