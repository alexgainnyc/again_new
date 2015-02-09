<?php
class SliderField extends Field
{
	public $min = 0;
	public $max = 1;
	public $step = 0.01;

	public function __construct($name, $label = null)
	{
		parent::__construct($name, $label);

		$this->type = "slider";
	}

	public function config()
	{
		$arr = parent::config();

		if ($this->defaultValue == "")
		{
			$this->defaultValue = $this->min;
		}

		return array_merge(array(
			"min" => $this->min,
			"max" => $this->max,
			"step" => $this->step
		), $arr);
	}

	// public function validation($type)
	// {
	// 	switch ($type)
	// 	{
	// 		case "email":
	// 			$this->validationPattern = "^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$";
	// 			$this->validationLength = 255;

	// 			break;
	// 		case "textarea":
	// 			$this->validationLength = 65535;

	// 			break;
	// 	}
	// }

	// public function format($value)
	// {
	// 	if ($this->module->flag == "L")
	// 	{
	// 		return Str::limit($value, $this->listLimit);
	// 	}

	// 	return $value;
	// }
}
?>