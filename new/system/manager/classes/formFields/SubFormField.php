<?php
class SubFormField extends Field
{
	private $keyField;
	private $fieldsFunc;

	private $tableName;
	private $fields = array();
	public $orm = null;
	public $flag = "";

	public $order;

	private $saveValue;

	public function __construct($name, $label, $tableName, $keyField)
	{
		parent::__construct($name, $label);

		$this->type = "subform";
		$this->tableName = $tableName;
		$this->keyField = $keyField;
		$this->editSize = 1;
		$this->order = false;
		// $this->defaultValue = array(
		// 	"data" => [],
		// 	"extraData" => [],
		// 	"deleted" => array()
		// );
	}

	public function fields($cb)
	{
		$this->fieldsFunc = $cb;
	}

	public function init()
	{
		parent::init();

		$this->flag = $this->module->flag;

		$extra = array();

		foreach ($this->fields as $field)
		{
			// if ($field->hasFlag(array("L", "F")))
			// {
				$field->init();
				// $field->select();

				if ($field->hasFlag("L") && $extraData = $field->extraData())
				{
					$extra[$field->name] = $field->extraData();
				}
			// }
		}

		$this->defaultValue = array(
			"data" => array(),
			"extraData" => $extra,
			"deleted" => array()
		);
	}

	public function config()
	{
		$arr = parent::config();

		call_user_func_array($this->fieldsFunc, array());

		$fieldsConfig = array();
		$defaults = array();
		foreach ($this->fields as $field)
		{
			$fieldsConfig[] = $field->config();
			$defaults[$field->name] = $field->format($field->defaultValue);
		}

		return array_merge(array(
			"fields" => $fieldsConfig,
			"defaults" => $defaults,
			"order" => $this->order
		), $arr);
	}

	public function includeOnSQL()
	{
		return false;
	}

	public function addField($field, $flags = "LOFCRU")
	{
		$field->module = $this;
		$field->flags = $flags;

		$this->fields[] = $field;
	}

	public function value()
	{
		$this->flag = $this->module->flag;

		$results = array();
		$fields = array();
		$this->orm = ORM::make($this->tableName)
						->select("id")
						->where($this->keyField, $this->module->orm->id);
		$extra = array();

		foreach ($this->fields as $field)
		{
			if ($field->hasFlag(array("L", "F")))
			{
				$fields[] = $field;

				$field->init();
				$field->select();

				if ($field->hasFlag("L") && $extraData = $field->extraData())
				{
					$extra[$field->name] = $field->extraData();
				}
			}
		}

		if ($this->order)
		{
			$this->orm->orderByAsc($this->order);
		}

		$entries = $this->orm;

		foreach ($entries->find() as $entry)
		{
			$this->orm = $entry;

			$values = array();
			$values["id"] = (int)$entry->id;

			foreach ($fields as $field)
			{
				$values[$field->name] = $field->value();
			}

			$results[] = $values;
		}

		$response = array(
			"data" => $results,
			"extraData" => $extra,
			"deleted" => array()
		);

		return $response;
	}

	public function save($value)
	{
		$this->saveValue = $value;
	}

	public function afterSave()
	{
		$this->orm = ORM::make($this->tableName);

		if (isset($this->saveValue["deleted"]))
		{
			$this->orm->delete($this->saveValue["deleted"]);
		}

		if (isset($this->saveValue["data"]))
		{


			foreach ($this->saveValue["data"] as $entry)
			{
				if (isset($entry["id"]) && (int)$entry["id"] > 0)
				{
					$this->orm = $this->orm
										->where($this->keyField, $this->module->orm->id)
										->where("id", $entry["id"])
										->findFirst();
				}
				else
				{
					$this->orm->reset();
					$this->orm[$this->keyField] = $this->module->orm->id;
				}

				foreach ($this->fields as $field)
				{
					if ($field->hasFlag("C"))
					{
						$field->init();

						$value = $field->defaultValue;
						if (isset($entry[$field->name]) && $entry[$field->name] != "")
						{
							$value = $entry[$field->name];
						}

						if ($return = $field->save($value))
						{
							return $return;
						}
					}
				}

				if ($this->order && isset($entry[$this->order]))
				{
					$this->orm[$this->order] = $entry[$this->order];
				}

				$this->orm->save();

				foreach ($this->fields as $field)
				{
					if ($field->hasFlag("C"))
					{
						if ($return = $field->afterSave())
						{
							return $return;
						}
					}
				}
			}
		}
	}

}
?>