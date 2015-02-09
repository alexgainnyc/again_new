<?php
class HomeForm extends FormModule
{

	public function __construct()
	{
		parent::__construct();

		$this->tableName = "home";
		$this->title = "Home";
		$this->icon = "icon-home";
		$this->uniqueID = 1;

		$this->flags = "RU";
	}

	public function fields()
	{
		$f = new TextAreaField("quote", "Quote");
		$f->editSize = 1;
		$this->addField($f, "CRU");

		$f = new TextField("author", "Author");
		$this->addField($f, "CRU");

		$form = new SubFormField("elements", "Parallax elements", "home_elements", "homeID");
		$form->fields(function () use ($form) {
			$f = new AssetField("asset", "Asset");
			$form->addField($f);

			$f = new ItemsField("z", "Z");
			$f->addItemsFromArray(array(
				1 => "Front",
				2 => "Back"
			));
			$form->addField($f);

			$f = new SliderField("depth", "Depth");
			$f->min = 1;
			$f->defaultValue = 1;
			$f->max = 20;
			$f->step = 0.1;
			$f->editSize = 3;
			$form->addField($f);

			$f = new SliderField("anchorX", "Anchor X");
			$f->min = 0;
			$f->max = 100;
			$f->defaultValue = 50;
			$f->step = 1;
			$f->editSize = 3;
			$form->addField($f);

			$f = new SliderField("anchorY", "Anchor Y");
			$f->min = 0;
			$f->max = 100;
			$f->defaultValue = 50;
			$f->step = 1;
			$f->editSize = 3;
			$form->addField($f);
		});
		$this->addField($form, "CRU");
	}
}
?>