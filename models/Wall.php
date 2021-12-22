<?php
namespace app\models;

/**
 * 
 */
class Wall
{

	const TYPE_TOP = 'top';
	const TYPE_BOTTOM = 'bottom';
	const TYPE_LEFT = 'left';
	const TYPE_RIGHT = 'right';

	private $_side;

	function __construct($side)
	{
		//check for types @TODO
		$this->_side = $side; 
	}

	public function getSide()
	{
		return $this->_side;
	}

	public function isTop()
	{
		if ($this->_side == self::TYPE_TOP) {
			return true;
		}

		return false;
	}

	public function isBottom()
	{
		if ($this->_side == self::TYPE_BOTTOM) {
			return true;
		}

		return false;
	}

	public function isLeft()
	{
		if ($this->_side == self::TYPE_LEFT) {
			return true;
		}

		return false;
	}

	public function isRight()
	{
		if ($this->_side == self::TYPE_RIGHT) {
			return true;
		}

		return false;
	}
}