<?php
class ToggleField extends Field
{
	public function __construct($name = "active", $label = "Active")
	{
		parent::__construct($name, $label);

		$this->type = "toggle";
		$this->defaultValue = 2;
	}

	public function format($value)
	{
		if ($this->module->flag == "R")
		{
			return ((int)$value == 1) ? "Yes" : "No";
		}

		return (string)$value;
	}

	public function unformat($value)
	{
		return (int)$value;
	}
}
?>