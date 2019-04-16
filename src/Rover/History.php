<?php

declare(strict_types=1);

namespace MarsRover\Rover;

class History {
	public $registry;

	public function __construct($registry = []) {
		$this->registry = $registry;
	}

	public function push(Position $position, Orientation $orientation) {
		$entry = new \StdClass();

		$entry->position = $position;
		$entry->orientation = $orientation;

		$this->registry[] = $entry;
	}
}