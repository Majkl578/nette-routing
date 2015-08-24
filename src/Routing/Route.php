<?php

class Test
{
	public static $foo = [
		self::PATTERN => 'foo',
		self::FILTER_OUT => [__CLASS__, 'foo'],
	];
}
