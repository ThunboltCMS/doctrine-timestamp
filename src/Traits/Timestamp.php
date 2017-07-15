<?php

declare(strict_types=1);

namespace Thunbolt\Doctrine\Traits;

use DateTime;

/**
 * @property-read \DateTime $created
 * @property-read \DateTime $updated
 */
trait Timestamp {

	/** @var DateTime */
	protected $created;

	/** @var DateTime */
	protected $updated;

	/**
	 * @internal
	 */
	public function updateTimestamp(): void {
		if ($this->created === null) {
			$this->created = new DateTime();
		}

		$this->updated = new DateTime();
	}

	/////////////////////////////////////////////////////////////////

	/**
	 * @return DateTime
	 */
	public function getCreated(): DateTime {
		return $this->created;
	}

	/**
	 * @return DateTime
	 */
	public function getUpdated(): DateTime {
		return $this->updated;
	}

}
