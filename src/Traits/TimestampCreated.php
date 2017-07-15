<?php

declare(strict_types=1);

namespace Thunbolt\Doctrine\Traits;

use DateTime;

/**
 * @property-read \DateTime $created
 */
trait TimestampCreated {

	/** @var \DateTime */
	protected $created;

	/**
	 * @internal
	 */
	public function updateCreated(): void {
		if ($this->created === null) {
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

}
