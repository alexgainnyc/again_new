<?php
class Culture extends Model
{
	public static function all()
	{
		$items = static::make()
						->where("active", 1)
						->orderByAsc("order")
						->find();

		$i = 1;
		foreach ($items as $k => $v)
		{
			$items[$k]->index = $i;
			// $items[$k]["index"] = $i;
			// $items[$k]["text"] = nl2br($items[$k]["text"]);
			// $items[$k]["quote"] = nl2br($items[$k]["quote"]);

			$i++;
		}

		return $items;
	}

	public function parallaxElements()
	{
		return Assets::make()
					->select("culture_elements.*")
					->select("assets.*")
					->innerJoin("culture_elements", array("culture_elements.asset", "=", "assets.id"))
					->where("culture_elements.cultureID", $this->id)
					->orderByAsc("culture_elements.id")
					->find();
	}
}
?>