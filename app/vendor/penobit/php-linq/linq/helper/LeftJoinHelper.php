<?php

namespace Penobit\Linq\Helper;

/**
 * Class LeftJoinHelper.
 */
class LeftJoinHelper extends JoinHelper {
	/** @var bool */
	protected $tryLeftJoin = true;

	/**
	 * @param $condition
	 *
	 * @return array
	 */
	public function join($condition) {
		if (is_callable($condition)) {
			foreach ($this->firstSource as $source) {
				foreach ($this->secondarySource as $secondarySource) {
					$this->tryMergeSources($condition, $source, $secondarySource);
				}

				if ($this->tryLeftJoin) {
					$this->joinedArray[] = $source;
				}
				$this->tryLeftJoin = true;
			}
		}

		return $this->joinedArray;
	}

	/**
	 * @param $source
	 * @param $secondarySource
	 */
	protected function mergeSources($source, $secondarySource) {
		parent::mergeSources($source, $secondarySource);
		$this->tryLeftJoin = false;
	}
}
