<?php
class CasesForm extends FormModule
{

	public function __construct()
	{
		parent::__construct();

		$this->tableName = "cases";
		$this->title = "Cases";
		$this->titleNoun = "Case";
		$this->icon = "icon-suitcase";
		$this->orderBy = "order";

		// $this->flags = "LOFCRU";
	}

	public function fields()
	{
		$f = new NumberField("order", "Order");
		$this->addField($f, "LOCRU");

		$f = new TextField("client", "Client");
		$this->addField($f, "LOFCRU");

		$f = new TextField("name", "Name");
		$this->addField($f, "LOFCRU");

		$f = new AssetField("coverAsset", "Cover");
		$this->addField($f, "CRU");

		$form = new SubFormField("content", "Content", "cases_content", "caseID");
		$form->fields(function () use ($form) {
			$f = new ContentTypeField("type", "Type");
			$f->addItemsFromArray(array(
				1 => "1 - Text and Tags",
				2 => "2 - Images",
				3 => "3 - Image with left caption",
				4 => "4 - Image with right caption",
				5 => "5 - Full image",
				6 => "6 - Paragraph",
				7 => "7 - Video",
				8 => "8 - Gallery"
			));
			$f->required = false;
			$f->editSize = 1;
			$form->addField($f);

			$f = new TextAreaField("text", "Text");
			$f->required = false;
			$form->addField($f);

			$f = new TextAreaField("tags", "Tags");
			$f->required = false;
			$form->addField($f);

			$f = new AssetField("assetLeft", "Asset Left");
			$f->required = false;
			$form->addField($f);

			$f = new TextAreaField("caption", "Caption");
			$f->required = false;
			$form->addField($f);

			$f = new AssetField("assetRight", "Asset Right");
			$f->required = false;
			$form->addField($f);

			$f = new SliderField("fontSize", "Font Size");
			$f->min = 10;
			$f->max = 100;
			$f->defaultValue = 30;
			$f->step = 1;
			$f->required = false;
			$form->addField($f);

			$f = new UploadField("videoMp4", "Video (mp4)", "cases");
			$f->accepts("video/mp4");
			$f->required = false;
			$form->addField($f);

			$f = new UploadField("videoWebm", "Video (webm)", "cases");
			$f->accepts("video/webm");
			$f->required = false;
			$form->addField($f);

			$f = new SliderField("size", "Size");
			$f->min = 1;
			$f->max = 100;
			$f->defaultValue = 100;
			$f->step = 1;
			$f->required = false;
			$form->addField($f);
		});
		$form->order = "order";
		$this->addField($form, "CRU");

		$f = new AssetField("gallery", "Gallery");
		$f->multiple("cases_assets", "caseID");
		$this->addField($f, "CRU");

		$f = new ToggleField("featured", "Featured");
		$this->addField($f, "LOCRU");

		$f = new ToggleField("home", "Home");
		$this->addField($f, "LOCRU");

		$f = new ToggleField();
		$this->addField($f, "LOCRU");
	}
}
?>