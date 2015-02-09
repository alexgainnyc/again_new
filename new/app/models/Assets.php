<?php
class Assets extends Model
{
	public static function pathForID($id)
	{
		if ($id > 0)
		{
			$item = Assets::make()
							->where("id", $id)
							->findFirst();

			if ($item)
			{
				return $item->path();
			}
		}

		return false;
	}

	public function path()
	{
		$file = json_decode($this->file);
		if (is_array($file) && count($file) > 0)
		{
			return URL::to("app/storage/" . $file[0]->original);
		}
		
		return false;
	}

	public function tags()
	{
		return Tags::make()
					->select("tags.*")
					->innerJoin("assets_tags", array("assets_tags.tagID", "=", "tags.id"))
					->whereRaw("assetID = " . $this->id)
					->find();
	}

	public static function publicAssets()
	{
		$response = array(
			"assets" => array(),
			"tags" => array()
		);

		$items = Assets::make()
						->where("onWork", 1)
						->orderByAsc("order")
						->find();

		$ids = array();

		foreach ($items as $item)
		{
			$ids[] = $item->id;
			/*$assetsIDs = array();

			$contents = CasesContent::allForID($item->id);
			foreach ($contents as $content) {
				if ($content->assetLeft)
				{
					// echo "left: " . $content->assetLeft . "\n";
					$assetsIDs[] = $content->assetLeft;
				}

				if ($content->assetRight)
				{
					// echo "right: " . $content->assetRight . "\n";
					$assetsIDs[] = $content->assetRight;
				}
			}

			$gallery = $item->gallery();
			foreach ($gallery as $asset)
			{
				// echo "gallery: " . $asset->id . "\n";
				$assetsIDs[] = $asset->id;
			}

			foreach ($assetsIDs as $id)
			{
				$ids[] = $id;

				if (!isset($response["cases"][$id]))
				{
					$response["cases"][$id] = $item;
				}
			}*/
		}

		$ids = array_merge(array_unique($ids));

		$assets = Assets::make()
					->whereRaw("id in (" . implode(",", $ids) . ")")
					->orderByExpr("FIELD(id, " . implode(",", $ids) . ")")
					->find();

		$response["assets"] = $assets;

		$tags = Tags::make()
					->select("tags.*")
					->innerJoin("assets_tags", array("assets_tags.tagID", "=", "tags.id"))
					->whereRaw("assetID in (" . implode(",", $ids) . ")")
					->find();

		foreach ($tags as $tag)
		{
			$response["tags"][] = $tag->name . "####" . $tag->id;
		}

		$response["tags"] = array_merge(array_unique($response["tags"]));
		array_multisort($response["tags"]);

		foreach ($response["tags"] as $k => $v)
		{
			$info = explode("####", $v);
			$response["tags"][$k] = array(
				"id" => $info[1],
				"name" => $info[0]
			);
		}

		return $response;
	}
}
?>