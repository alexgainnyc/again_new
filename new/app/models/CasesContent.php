<?php
class CasesContent extends Model
{
	public static function allForID($id)
	{
		$items = CasesContent::make()
						->where("caseID", $id)
						->orderByAsc("order")
						->find();

		return $items;
	}

	public function leftAsset()
	{
		return Assets::pathForID($this->assetLeft);
	}

	public function rightAsset()
	{
		return Assets::pathForID($this->assetRight);
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

	public function size()
	{
		if (isset($this->size) && (int)$this->size > 0)
		{
			return $this->size;
		}

		return 100;
	}
}
?>