<?php

namespace Thunbolt\Doctrine\Traits;

use DateTime;

trait TimestampUpdated {

	/** @var DateTime */
	protected $updated;

	/**
	 * @internal
	 */
	public function updateUpdated() {
		$this->updated = new DateTime();
	}

	/////////////////////////////////////////////////////////////////

	/**
	 * @return DateTime
	 */
	public function getUpdated() {
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