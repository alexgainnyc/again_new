<?php
class SiteMenu
{
	public static function link($uri, $return = "[link]")
	{
		if (URI::is($uri) || static::uriIs($uri))
		{
			if ($return == "[link]")
			{
				// if (trim($uri, "/") != "")
				// {
				// 	return "href=\"" . URL::to($uri) . "\"";
				// }
				// else
				// {
					return "";
				// }
			}
			else
			{
				return $return;
			}
		}

		if ($return == "[link]")
		{
			return "href=\"" . URL::to($uri) . "\"";
		}
		else
		{
			return "";
		}
	}

	private static function uriIs($test)
	{
		$pieces = explode("?", $test);
		$pass = false;

		if (count($pieces) > 0)
		{
			$pieces[0] = trim($pieces[0], "/");

			if (URI::current() == "" && strlen($pieces[0]) == 0)
			{
				$pass = true;
			}
			else if (strlen($pieces[0]) > 0)
			{
				if (URI::is($pieces[0]) || strpos(URI::current(), $pieces[0]) !== false)
				{
					$pass = true;
				}
			}

			if (count($pieces) > 1)
			{
				$params = explode("&", $pieces[1]);
				$uriPieces = explode("?", URI::full());
				if (count($uriPieces) > 1)
				{
					$uriParams = explode("&", $uriPieces[1]);
					$toPass = count($params);

					foreach ($uriParams as $uriParam)
					{
						foreach ($params as $param)
						{
							if ($param == $uriParam)
							{
								$toPass--;
								break;
							}
						}
					}

					if ($toPass > 0)
					{
						$pass = false;
					}
				}
			}
		}

		return $pass;
	}
}
?>