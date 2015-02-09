<?php
class About extends Model
{
	public static function entry()
	{
		return static::make()
						->where("id", 1)
						->findFirst();
	}

	public function videoMp4()
	{
		$file = json_decode($this->videoMp4);
		if (is_array($file) && count($file) > 0)
		{
			return URL::to("app/storage/" . $file[0]->path);
		}

		return false;
	}

	public function videoWebm()
	{
		$file = json_decode($this->videoWebm);
		if (is_array($file) && count($file) > 0)
		{
			return URL::to("app/storage/" . $file[0]->path);
		}

		return false;
	}

	public function parallaxElements()
	{
		return Assets::make()
					->select("about_elements.*")
					->select("assets.*")
					->innerJoin("about_elements", array("about_elements.asset", "=", "assets.id"))
					->where("about_elements.aboutID", $this->id)
					->orderByAsc("about_elements.id")
					->find();
	}
}
?>