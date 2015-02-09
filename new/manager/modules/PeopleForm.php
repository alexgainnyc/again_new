<?php
class PeopleForm extends FormModule
{

	public function __construct()
	{
		parent::__construct();

		$this->tableName = "people";
		$this->title = "People";
		$this->titleNoun = "Person";
		$this->icon = "icon-user";
		$this->orderBy = "order";

		$this->flags = "LOFCRU";
	}

	public function fields()
	{
		$f = new TextField("order", "Order");
		$f->editSize = 1;
		$this->addField($f, "LOCRU");

		$f = new TextField("name", "Name");
		$this->addField($f, "LOFCRU");

		$f = new TextField("country", "Country");
		$this->addField($f, "FCRU");

		$f = new TextareaField("text", "Text");
		$this->addField($f, "CRU");

		$f = new ImageUploadField("picture", "Picture", "people");
		$f->sample("full", Image::RESIZE_METHOD_FILL, 216, 216);
		$this->addField($f, "LCRU");

		$f = new ToggleField();
		$this->addField($f, "LOCRU");

	}
}
?>