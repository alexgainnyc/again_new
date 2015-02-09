<?php
class Home extends Model
{
	public static function entry()
	{
		return static::make()
						->where("id", 1)
						->findFirst();
	}

	public function parallaxElements()
	{
		return Assets::make()
					->select("home_elements.*")
					->select("assets.*")
					->innerJoin("home_elements", array("home_elements.asset", "=", "assets.id"))
					->where("home_elements.homeID", $this->id)
					->orderByAsc("home_elements.id")
					->find();
	}
}
?>