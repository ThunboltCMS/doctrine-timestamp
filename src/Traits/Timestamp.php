<?php

declare(strict_types=1);

namespace Thunbolt\Doctrine\Traits;

use DateTime;

trait Timestamp {

	/** @var DateTime */
	protected $created;

	/** @var DateTime */
	protected $updated;

	/**
	 * @internal
	 */
	public function updateTimestamp(): void {
		if ($this->created === NULL) {
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
	 * @param DateTime $created
	 * @return static
	 */
	public function setCreated(DateTime $created) {
		$this->created = $created;

		return $this;
	}

	/////////////////////////////////////////////////////////////////

	/**
	 * @return DateTime
	 */
	public function getUpdated(): DateTime {
		return $this->updated;
	}

	/**
	 * @param DateTime $updated
	 * @return self
	 */
	public function setUpdated(DateTime $updated) {
		$this->updated = $updated;

		return $this;
	}

}
