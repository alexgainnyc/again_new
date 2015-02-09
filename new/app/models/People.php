<?php
class People extends Model
{
	public static function all()
	{
		$items = People::make()
						->where("active", 1)
						->orderByAsc("order")
						->find();

		$i = 1;
		foreach ($items as $k => $v)
		{
			$items[$k]->index = $i;
			
			// $items[$k]["picture"] = false;
			// $picture = json_decode($v["picture"]);
			// if (is_array($picture) && count($picture) > 0)
			// {
			// 	$items[$k]["picture"] = URL::to("app/storage/" . $picture[0]->full);
			// }

			$i++;
		}

		return $items;
	}

	public function picture()
	{
		$file = json_decode($this->picture);
		if (is_array($file) && count($file) > 0)
		{
			return URL::to("app/storage/" . $file[0]->full);
		}

		return false;
	}
}
?>