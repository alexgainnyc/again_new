<?php
class CultureForm extends FormModule
{

	public function __construct()
	{
		parent::__construct();

		$this->tableName = "culture";
		$this->title = "Culture";
		$this->icon = "icon-quote-left";
		$this->orderBy = "order";

		$this->flags = "LOFCRU";
	}

	public function fields()
	{
		$f = new TextField("order", "Order");
		$f->editSize = 1;
		$this->addField($f, "LOCRU");

		$f = new TextField("title", "Title");
		$this->addField($f, "LOFCRU");

		$f = new TextAreaField("text", "Text");
		$this->addField($f, "CRU");

		$f = new TextAreaField("quote", "Quote");
		$this->addField($f, "CRU");

		$f = new TextField("author", "Author");
		$this->addField($f, "FCRU");

		$form = new SubFormField("elements", "Parallax elements", "culture_elements", "cultureID");
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

		$f = new ToggleField();
		$this->addField($f, "LOCRU");
	}
}
?>