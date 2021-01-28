<?php

namespace Penobit\Linq;

use Penobit\Linq\Factory\JoinFactory;

class LinqFactory {
	/** @var JoinFactory */
	protected static $linqs = [];

	/**
	 * return basic Linq object.
	 *
	 * @return Linq
	 */
	public static function createLinq() {
		if (!isset(self::$linqs['linq'])) {
			self::$linqs['linq'] = new Linq(new JoinFactory());
		}

		return self::$linqs['linq'];
	}

	/**
	 * return JsonLinq object.
	 *
	 * @return JsonLinq
	 */
	public static function createJsonLinq() {
		if (!isset(self::$linqs['jsonLinq'])) {
			self::$linqs['jsonLinq'] = new JsonLinq(new JoinFactory());
		}

		return self::$linqs['jsonLinq'];
	}

	/**
	 * return XmlLinq object.
	 *
	 * @return XmlLinq
	 */
	public static function createXmlLinq() {
		if (!isset(self::$linqs['xmlLinq'])) {
			self::$linqs['xmlLinq'] = new XmlLinq(new JoinFactory());
		}

		return self::$linqs['xmlLinq'];
	}
}
