<?php
class Field
{
	public $name;
	public $label;
	public $flags;
	public $type;

	public $defaultValue;

	public $required;
	public $validationPattern;
	public $validationTitle;
	public $validationLength;

	public $module;

	public $editSize;

	public function __construct($name, $label = null)
	{
		$this->name = $name;
		$this->label = (is_null($label) ? $name : $label);
		$this->flags = "";
		$this->type = "text";
		$this->defaultValue = "";

		$this->required = true;
		$this->validationPattern = ".*";
		$this->validationTitle = "Please fill out the blank '#LABEL#'.";
		$this->validationLength = 255;

		$this->editSize = 2;
	}

	public function init()
	{

	}

	public function hasFlag($flag)
	{
		return (Str::contains($this->flags, $flag));
	}

	public function config()
	{
		$validationTitle = str_replace("#LABEL#", $this->label, $this->validationTitle);

		return array(
			"type" => $this->type,
			"name" => $this->name,
			"nameHidden" => $this->name . "Hidden",
			"label" => $this->label,
			"flags" => $this->flags,
			"editSize" => $this->editSize,
			"validation" => array(
				"required" => $this->required,
				"pattern" => $this->validationPattern,
				"title" => $validationTitle,
				"length" => $this->validationLength
			)
		);
	}

	public function format($value)
	{
		return $value;
	}

	public function unformat($value)
	{
		return $value;
	}

	public function validation($type)
	{

	}

	public function includeOnSQL()
	{
		return true;
	}

	public function save($value)
	{
		if ($this->includeOnSQL())
		{
			if ($this->validationLength > 0)
			{
				$value = substr($value, 0, $this->validationLength);
			}

			$this->module->orm->setField($this->name, $value);
		}
	}

	public function value()
	{
		$value = $this->module->orm->field($this->name);

		return $this->format($value);
	}

	public function afterSave()
	{

	}

	public function filter($search)
	{
		$this->module->orm->whereLike($this->name, "%" . $search . "%");
	}

	public function select()
	{
		if ($this->includeOnSQL())
		{
			$this->module->orm->select($this->name);
		}
	}

	public function extraData()
	{
		return null;
	}
}
?>