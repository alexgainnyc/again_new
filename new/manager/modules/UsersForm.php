<?php
class UsersForm extends FormModule
{

	public function __construct()
	{
		parent::__construct();

		$this->tableName = "manager_users";
		$this->title = "Users";
		$this->titleNoun = "User";
		$this->icon = "icon-group";
	}

	public function fields()
	{
		$f = new TextField("name", "Name");
		$this->addField($f, "LOFCRU");

		$f = new TextField("email", "E-mail");
		$f->validation("email");
		$this->addField($f, "LOFCRU");

		$f = new TextField("username", "User");
		$this->addField($f, "LOFCRU");

		$f = new PasswordField("password", "Password");
		$this->addField($f, "CRU");

		$f = new ToggleField();
		$this->addField($f, "LOFCRU");
	}
}
?>