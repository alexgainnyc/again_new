<?php
class Cases extends Model
{
	public static function allForHome()
	{
		$items = Cases::make()
						->where("active", 1)
						->where("home", 1)
						->orderByAsc("featured")
						->orderByAsc("order")
						->find();

		return $items;
	}

	public static function detail()
	{
		$id = (int)URI::segment(2);

		return Cases::make()
						->where("id", $id)
						->where("active", 1)
						->findFirst();
	}

	// public static function publicAssets()
	// {
	// 	$response = array(
	// 		"assets" => array(),
	// 		"tags" => array(),
	// 		"cases" => array()
	// 	);

	// 	$items = Cases::make()
	// 					->where("active", 1)
	// 					// ->where("assetsOnWork", 1)
	// 					->orderByAsc("featured")
	// 					->orderByAsc("order")
	// 					->find();

	// 	$ids = array();

	// 	foreach ($items as $item)
	// 	{
	// 		$assetsIDs = array();

	// 		$contents = CasesContent::allForID($item->id);
	// 		foreach ($contents as $content) {
	// 			if ($content->assetLeft)
	// 			{
	// 				// echo "left: " . $content->assetLeft . "\n";
	// 				$assetsIDs[] = $content->assetLeft;
	// 			}

	// 			if ($content->assetRight)
	// 			{
	// 				// echo "right: " . $content->assetRight . "\n";
	// 				$assetsIDs[] = $content->assetRight;
	// 			}
	// 		}

	// 		$gallery = $item->gallery();
	// 		foreach ($gallery as $asset)
	// 		{
	// 			// echo "gallery: " . $asset->id . "\n";
	// 			$assetsIDs[] = $asset->id;
	// 		}

	// 		foreach ($assetsIDs as $id)
	// 		{
	// 			$ids[] = $id;

	// 			if (!isset($response["cases"][$id]))
	// 			{
	// 				$response["cases"][$id] = $item;
	// 			}
	// 		}
	// 	}

	// 	$ids = array_merge(array_unique($ids));

	// 	$assets = Assets::make()
	// 				->whereRaw("id in (" . implode(",", $ids) . ")")
	// 				->orderByExpr("FIELD(id, " . implode(",", $ids) . ")")
	// 				->find();

	// 	$response["assets"] = $assets;

	// 	$tags = Tags::make()
	// 				->select("tags.*")
	// 				->innerJoin("assets_tags", array("assets_tags.tagID", "=", "tags.id"))
	// 				->whereRaw("assetID in (" . implode(",", $ids) . ")")
	// 				->find();

	// 	foreach ($tags as $tag)
	// 	{
	// 		$response["tags"][] = $tag->id . "####" . $tag->name;
	// 	}

	// 	$response["tags"] = array_merge(array_unique($response["tags"]));
	// 	array_multisort($response["tags"]);

	// 	foreach ($response["tags"] as $k => $v)
	// 	{
	// 		$info = explode("####", $v);
	// 		$response["tags"][$k] = array(
	// 			"id" => $info[0],
	// 			"name" => $info[1]
	// 		);
	// 	}

	// 	return $response;
	// }

	public function cover()
	{
		return Assets::pathForID($this->coverAsset);
	}

	public function url()
	{
		return URL::to("case/" . $this->id . "/");
	}

	public function contents()
	{
		return CasesContent::allForID($this->id);
	}

	public function gallery()
	{
		$items = Assets::make()
					->select("assets.*")
					->innerJoin("cases_assets", array("cases_assets.asset", "=", "assets.id"))
					->where("cases_assets.caseID", $this->id)
					->find();

		return $items;
	}

	public function previous()
	{
		return Cases::make()
						->where("active", 1)
						->where("home", 1)
						->where("order", "<", $this->order)
						->orderByDesc("featured")
						->orderByDesc("order")
						->findFirst();
	}

	public function next()
	{
		return Cases::make()
						->where("active", 1)
						->where("home", 1)
						->where("order", ">", $this->order)
						->orderByDesc("featured")
						->orderByAsc("order")
						->findFirst();
	}
}
?>