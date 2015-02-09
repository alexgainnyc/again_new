<?php
class AssetsForm extends FormModule
{

	public function __construct()
	{
		parent::__construct();

		$this->tableName = "assets";
		$this->title = "Assets";
		$this->titleNoun = "Asset";
		$this->icon = "icon-file";

		$this->flags = "LOFCRUD";
	}

	public function fields()
	{
		$f = new NumberField("order", "Order");
		$this->addField($f, "LOCRU");

		$f = new TextField("name", "Name");
		$this->addField($f, "LOFCRU");

		$f = new ItemsField("tags", "Tags");
		$f->multiple("assets_tags", "assetID", "tagID");
		$f->addItemsFromTable("tags");
		$f->editSize = 1;
		$this->addField($f, "LCRU");

		$f = new ImageUploadField("file", "File", "assets");
		$f->sample("original", Image::RESIZE_METHOD_NONE);
		$f->editSize = 1;
		$this->addField($f, "LCRU");

		$f = new ToggleField("onWork", "Show on Work");
		$this->addField($f, "LOCRU");

	}
}
?>