<?php

function presetinput_text($name) {
	if (isset($_POST[$name]))
		echo $_POST[$name];
}

?>
