<?php
class Services extends Model
{
	public static function all()
	{
		$items = static::make()
						->where("active", 1)
						->orderByAsc("order")
						->find();

		return $items;
	}

	public function tags()
	{
		$items = Tags::make()
					->innerJoin("services_tags", array("services_tags.tagID", "=", "tags.id"))
					->where("services_tags.serviceID", $this->id)
					->find();

		return $items;
	}

	public function tagsAsArray()
	{
		$items = $this->tags();
		$tags = array();
		foreach ($items as $item)
		{
			$tags[] = $item->name;
		}
		return $tags;
	}
}
?>