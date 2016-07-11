<?php

namespace Thunbolt\Doctrine;

use DateTime;

trait Timestamp {

	/** @var DateTime */
	protected $created;

	/** @var DateTime */
	protected $updated;

	public function updateTimestamp() {
		if ($this->created === NULL) {
			$this->created = new DateTime();
		}

		$this->updated = new DateTime();
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
	public function setCreated($created) {
		$this->created = $created;

		return $this;
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
	public function setUpdated($updated) {
		$this->updated = $updated;

		return $this;
	}

}
