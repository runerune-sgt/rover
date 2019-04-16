<?php

declare(strict_types=1);

namespace MarsRover\Rover;

class Orientation {
	public $vector;

	private static $orientation_vector = [1, 0, -1, 0, 1];

	const TURN_LEFT = 1;
	const TURN_RIGHT = 0;

	//------------------------------------------

	public function __construct($orient_x = 1, $orient_y = 0) {
		if($orient_x > 1 || $orient_x < -1) {
			throw new \InvalidArgumentException('invalid orient_x', 202);
		}

		if($orient_y > 1 || $orient_y < -1) {
			throw new \InvalidArgumentException('invalid orient_y', 203);
		}

		$this->vector = [$orient_x, $orient_y];
	}

	public function determine_orientation() {
		$ov = static::$orientation_vector;
		$ov_size = sizeof(static::$orientation_vector);

		for($i = 0; $i < $ov_size; ++$i) {
			if($ov[$i] === $this->vector[0] && $ov[$i + 1] === $this->vector[1]) {
				return $i;
			}
		}

		throw new \OutOfBoundsException('Unknown turn command', 201);
	}

	public function orient($index) {
		$ov_size_limit = sizeof(static::$orientation_vector) - 1;

		if($index > $ov_size_limit) {
			$index %= $ov_size_limit;
		}

		if($index < 0) {
			$index = $ov_size_limit - 1;
		}

		return array_slice(static::$orientation_vector, $index, 2);
	}

	public function turn($direction) {
		$orientation = $this->determine_orientation();

		switch($direction) {
			case self::TURN_LEFT:
				$orientation--;
			break;
			case self::TURN_RIGHT:
				$orientation++;
			break;
			default:
				throw new \InvalidArgumentException('Unknown turn command', 201);
		}

		$new_orientation = $this->orient($orientation);

		return new self(...$new_orientation);
	}
}