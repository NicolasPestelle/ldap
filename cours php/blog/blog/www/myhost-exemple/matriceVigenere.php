<?php
	$a = 65;
	$b = 65;
	for($x = 0; $x < 26; $x++){
		for($y = 0; $y < 26; $y++){
			echo chr($a);
			$a++;
		}
		echo chr($b);
		$b++;
	}
?>