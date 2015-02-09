<?php
class ServicesForm extends FormModule
{

	public function __construct()
	{
		parent::__construct();

		$this->tableName = "services";
		$this->title = "Services";
		$this->titleNoun = "Service";
		$this->icon = "icon-wrench";
		$this->orderBy = "order";

		$this->flags = "LOFCRU";
	}

	public function fields()
	{
		$f = new TextField("order", "Order");
		$this->addField($f, "LOCRU");

		$f = new TextField("name", "Name");
		$this->addField($f, "LOFCRU");

		$f = new TextareaField("text", "Text");
		$this->addField($f, "CRU");

		$f = new ItemsField("tags", "Tags");
		$f->multiple("services_tags", "serviceID", "tagID");
		$f->addItemsFromTable("tags");
		$this->addField($f, "LFCRU");

		$f = new ToggleField();
		$this->addField($f, "LOCRU");

	}
}
?>