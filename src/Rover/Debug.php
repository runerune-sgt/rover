<?php

/*declare(strict_types=1);

namespace MarsRover\Rover;

class Debug {
	private $orientation;
	private $position;

	public static $orientation_cheatsheet = [
		'1|0' => '^',
		'0|1' => '>',
		'-1|0' => 'v',
		'0|-1' => '<',
		'1|1' => '7',
		'1|-1' => 'J',
		'-1|-1' => 'L',
		'-1|1' => 'F',
	];

	public static $template_header = ' - - - - - ';
	public static $template_line = '|         |';
	public static $template_footer = ' - - - - - ';

	public function __construct(Position $position, Orientation $orientation) {
		$this->orientation = $orientation;
		$this->position = $position;

		$this->debug_draw();
	}

	protected function debug_draw() {
		if(!DEBUG) return;

		echo "\n";
		echo static::$template_header."\n";

		for($print_x = 4; $print_x >= 0; --$print_x) {
			if($print_x === $this->position->x) {
				$formatted_line = static::$template_line;
				$position = 1 + (2 * $this->position->y);

				$orientation_debug_id = $this->orientation->vector[1].'|'.$this->orientation->vector[0];
				$orientation_char = static::$orientation_cheatsheet[$orientation_debug_id];

				$formatted_line[$position] = $orientation_char;
				echo $formatted_line."\n";
			} else {
				echo static::$template_line."\n";
			}
		}

		echo static::$template_footer."\n";
	}
}*/