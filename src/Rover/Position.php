<?php

declare(strict_types=1);

namespace MarsRover\Rover;

class Position {
	public $x;
	public $y;

	private static $min_x = 0;
	private static $max_x = 5;
	private static $min_y = 0;
	private static $max_y = 5;

	public function __construct(int $x, int $y) {
		$this->x = $x;
		$this->y = $y;

		if($this->x >= static::$max_x) $this->x %= static::$max_x;
		if($this->y >= static::$max_y) $this->y %= static::$max_y;

		if($this->x < static::$min_x) {
			$this->x %= static::$max_y;
			$this->x += static::$max_x;
		}

		if($this->y < static::$min_y) {
			$this->y %= static::$max_y;
			$this->y += static::$max_y;
		}
	}

	public function forward(Orientation $orientation) {
		$new_x = $this->x + $orientation->vector[1];
		$new_y = $this->y + $orientation->vector[0];

		return new self($new_x, $new_y);
	}

	public function back(Orientation $orientation) {
		$new_x = $this->x + (-1 * $orientation->vector[1]);
		$new_y = $this->y + (-1 * $orientation->vector[0]);

		return new self($new_x, $new_y);
	}
}