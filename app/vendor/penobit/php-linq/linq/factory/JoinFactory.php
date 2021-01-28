<?php

namespace Penobit\Linq\Factory;

use Penobit\Linq\Helper\IJoinHelper;
use Penobit\Linq\Helper\JoinHelper;
use Penobit\Linq\Helper\LeftJoinHelper;

/**
 * Class JoinFactory.
 */
class JoinFactory {
	/** ENUM */
	const INNER = 'inner';
	const LEFT = 'left';

	/** @var array */
	protected $joinObjects = [];

	/**
	 * JoinFactory constructor.
	 */
	public function __construct() {
		$this->joinObjects = [
			'inner' => new JoinHelper(),
			'left' => new LeftJoinHelper()
		];
	}

	/**
	 * @param $type
	 *
	 * @throws \Exception
	 *
	 * @return IJoinHelper
	 */
	public function getJoinObject($type) {
		if (!in_array($type, array_keys($this->joinObjects), true)) {
			throw new \Exception('Invalid Join Type Parametr');
		}

		return $this->joinObjects[$type];
	}
}
