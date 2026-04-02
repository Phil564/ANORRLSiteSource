<?php

	class Splasher {

		public array $splashes;

		function __construct(string $filename) {
			$this->splashes = file($_SERVER["DOCUMENT_ROOT"]."/core/splashes/$filename.txt");
		}

		function getRandomSplash() {
			return $this->splashes[array_rand($this->splashes)];
		}
	}