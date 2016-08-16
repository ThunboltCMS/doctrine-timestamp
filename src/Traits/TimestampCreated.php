<?php

namespace Thunbolt\Doctrine\Traits;

use DateTime;

trait TimestampCreated {

	/** @var \DateTime */
	protected $created;

	/**
	 * @internal
	 */
	public function updateCreated() {
		if ($this->created === NULL) {
			$this->created = new \DateTime();
		}
	}

	/////////////////////////////////////////////////////////////////

	/**
	 * @return DateTime
	 */
	public function getCreated() {
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
