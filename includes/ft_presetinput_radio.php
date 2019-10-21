<?php

function presetinput_select($name, $value) {
	if (isset($_POST[$name]) && $_POST[$name] == $value)
		echo 'checked="checked"';
}
