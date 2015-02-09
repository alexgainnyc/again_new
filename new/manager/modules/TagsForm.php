<?php
class TagsForm extends FormModule
{

	public function __construct()
	{
		parent::__construct();

		$this->tableName = "tags";
		$this->title = "Tags";
		$this->titleNoun = "Tag";
		$this->icon = "icon-tags";

		$this->flags = "LOFCRU";
	}

	public function fields()
	{
		$f = new TextField("name", "Name");
		$this->addField($f, "LOFCRU");
	}
}
?>