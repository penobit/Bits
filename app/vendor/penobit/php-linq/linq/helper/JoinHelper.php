<?php

namespace Penobit\Linq\Helper;

/**
 * Class JoinHelper.
 */
class JoinHelper implements IJoinHelper {
	/** @var array */
	protected $firstSource;

	/** @var array */
	protected $secondarySource;

	/** @var array */
	protected $joinedArray;

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
				/*
				if($this->joinType == "left join" && $useLeftJoin){
					$joinedArray[] = $source;
				}*/
				//$useLeftJoin = true;
			}
		}

		return $this->joinedArray;
	}

	/**
	 * @param array $firstSource
	 *
	 * @return JoinHelper
	 */
	public function setFirstSource($firstSource) {
		$this->firstSource = $firstSource;

		return $this;
	}

	/**
	 * @param array $secondarySource
	 *
	 * @return JoinHelper
	 */
	public function setSecondarySource($secondarySource) {
		$this->secondarySource = $secondarySource;

		return $this;
	}

	/**
	 * @param $condition
	 * @param $source
	 * @param $secondarySource
	 */
	protected function tryMergeSources($condition, $source, $secondarySource) {
		if (call_user_func_array($condition, [$source, $secondarySource])) {
			$this->mergeSources($source, $secondarySource);
		}
	}

	/**
	 * @param $source
	 * @param $secondarySource
	 */
	protected function mergeSources($source, $secondarySource) {
		if (is_array($source) and is_array($secondarySource)) {
			$this->joinedArray[] = array_merge_recursive($source, $secondarySource);
		} else {
			$this->joinedArray[] = (object) array_merge_recursive((array) $source, (array) $secondarySource);
		}
	}
}
