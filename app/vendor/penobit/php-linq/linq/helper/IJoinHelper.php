<?php

namespace Penobit\Linq\Helper;

interface IJoinHelper {
	/**
	 * @param $condition
	 *
	 * @return array
	 */
	public function join($condition);

	/**
	 * @param array $firstSource
	 *
	 * @return JoinHelper
	 */
	public function setFirstSource($firstSource);

	/**
	 * @param array $secondarySource
	 *
	 * @return JoinHelper
	 */
	public function setSecondarySource($secondarySource);
}
