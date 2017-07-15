<?php

declare(strict_types=1);

namespace Thunbolt\Doctrine\Traits;

use DateTime;

/**
 * @property-read \DateTime $updated
 */
trait TimestampUpdated {

	/** @var DateTime */
	protected $updated;

	/**
	 * @internal
	 */
	public function updateUpdated(): void {
		$this->updated = new DateTime();
	}

	/////////////////////////////////////////////////////////////////

	/**
	 * @return DateTime
	 */
	public function getUpdated(): DateTime {
		return $this->updated;
	}

}
