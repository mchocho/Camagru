<?php

function ft_presetinput_select($name, $value) {
	if (isset($_POST[$name] && $_POST[$name] == $value))
		echo 'selected="selected"';
}
