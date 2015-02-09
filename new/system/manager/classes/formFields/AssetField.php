<?php
class AssetField extends Field
{
	private static $routes = false;

	private $multiple;
	private $multipleTable;
	private $multipleFieldKey;

	private $tmpValue;

	public static function routes()
	{
		if (static::$routes)
		{
			return;
		}

		static::$routes = true;

		Router::register("GET", "manager/api/fields/assets/", function () {
			if (($token = User::validateToken()) !== true)
			{
				return $token;
			}

			$results = ORM::make("assets")
						->orderByAsc("name")
						->find()
						->asArray();

			$list = array();

			foreach ($results as $item)
			{
				$file = @json_decode($item["file"], true);
				$file = current($file);

				$list[] = array(
					"id" => $item["id"],
					"thumb" => URL::thumb("app/storage/" . $file["original"], 100, 75, Image::RESIZE_METHOD_FIT_NO_MARGING),
					"name" => $item["name"]
				);
			}

			return Response::json(array( "files" => $list ));
		});

		Router::register("GET", "manager/api/fields/assets/thumb/(:num)/", function ($id) {
			if (($token = User::validateToken()) !== true)
			{
				return $token;
			}

			$result = ORM::make("assets")
						->where("id", $id)
						->select("file")
						->findFirst();

			if ($result)
			{
				$file = @json_decode($result["file"], true);
				$file = current($file);

				Response::redirect(URL::thumb("app/storage/" . $file["original"], 100, 75, Image::RESIZE_METHOD_FIT_NO_MARGING), false);
			}
		});
	}

	public function __construct($name, $label = null)
	{
		parent::__construct($name, $label);

		$this->type = "asset";
		$this->multiple = false;
		$this->tmpValue = null;

		static::routes();
	}

	public function config()
	{
		$arr = parent::config();

		return array_merge(array(
			"files_url" => "api/fields/assets/",
			"thumbs_url" => "api/fields/assets/thumb/",
			"thumb" => "",
			"multiple" => $this->multiple

		), $arr);
	}

	public function multiple($tableName, $fieldKey)
	{
		$this->multiple = true;
		$this->multipleTable = $tableName;
		$this->multipleFieldKey = $fieldKey;
		$this->defaultValue = array();
		$this->editSize = 1;
	}

	public function init()
	{

	}

	public function includeOnSQL()
	{
		return !$this->multiple;
	}

	public function save($value)
	{
		if (!$this->multiple)
		{
			$this->module->orm->setField($this->name, (int)$value);
		}
		else
		{
			$this->tmpValue = $value;
		}
	}

	public function afterSave()
	{
		if ($this->multiple)
		{
			$value = $this->tmpValue;

			if (is_array($value))
			{
				$id = $this->module->orm->field("id");
				$ormRel = ORM::make($this->multipleTable);

				$entries = $ormRel
								->where($this->multipleFieldKey, "=", $id)
								->find();

				foreach ($entries as $entry)
				{
					$to = $entry->field("asset");
					$found = false;

					foreach ($value as $k => $v)
					{
						if ((int)$to == (int)$v)
						{
							$found = true;
							unset($value[$k]);

							break;
						}
					}

					if (!$found)
					{
						$entry->delete();
					}
				}

				foreach ($value as $v)
				{
					$ormRel->reset();
					$ormRel->setField($this->multipleFieldKey, $id);
					$ormRel->setField("asset", $v);
					$ormRel->insert();
				}
			}
		}
	}

	public function value()
	{
		if (!$this->multiple)
		{
			$value = $this->module->orm->field($this->name);

			return $this->format($value);
		}
		else
		{
			$id = $this->module->orm->field("id");
			$ormRel = ORM::make($this->multipleTable);
			$values = array();

			$entries = $ormRel
							->where($this->multipleFieldKey, "=", $id)
							->find();

			foreach ($entries as $entry)
			{
				$values[] = (int)$entry->field("asset");
			}

			return $values;
		}
	}
}
?>