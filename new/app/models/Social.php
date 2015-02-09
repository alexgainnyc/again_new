<?php
class Social extends Model
{
	public static function all()
	{
		$items = Social::make()
						->where("active", 1)
						->orderByAsc("id")
						->find();

		return $items;
	}
}
?>