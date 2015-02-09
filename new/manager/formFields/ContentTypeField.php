<?php
class ContentTypeField extends ItemsField
{
	public function __construct($name, $label = null)
	{
		parent::__construct($name, $label);
		$this->type = "contentType";
	}
}
?>