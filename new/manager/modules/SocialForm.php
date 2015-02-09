<?php
class SocialForm extends FormModule
{
	public function __construct()
	{
		parent::__construct();

		$this->tableName = "social";
		$this->title = "Social";
		$this->icon = "icon-facebook";

		$this->flags = "LRU";
	}

	public function fields()
	{
		$f = new TextField("network", "Network");
		$this->addField($f, "LR");

		$f = new TextField("url", "URL");
		$this->addField($f, "LRU");

		$f = new ToggleField();
		$this->addField($f, "LRU");
	}
}
?>