<?php

//namespace LetTxt;

/**
 * @param array|string $url
 * @param null $callback
 * @return false|mixed|string
 *
 * @throws Exception
 */
function let_txt($url, $callback = null)
{
	if (empty($url)) {
		throw new Exception("Url: $url is empty");
	}

	$urls = [];
	if (!is_array($url)) {
		$urls[] = $url;
	} else {
		$urls = $url;
	}

	$txt = '';
	foreach ($urls as $url_item) {
		// check if URL exist
		if (!url_exists($url_item)) {
			throw new Exception("Url: " . $url_item . " not exist ");
		}

		// Check Content
		$file = file_get_contents($url, true);
		if (empty($file)) {
			throw new Exception("Content from Url: $url is empty");
		}

		$txt .= $file;
	}

	if (is_callable($callback)) {
		return $callback($txt);
	}

	return $txt;
}


/**
 * Class LetTxt
 */
class LetTxt
{
	/** @var array|mixed */
	public $json = [];

	/** @var string */
	public $url = '';

	/**
	 * LetTxt constructor.
	 * @param $url
	 */
	function __construct($url)
	{
		$this->url = $url;
		$this->json = let_txt($url);
	}

	/**
	 * @return mixed
	 */
	function first()
	{
		return $this->json[0];
	}

	/**
	 * @param $callback
	 */
	function each($callback)
	{
		foreach ($this->json as $item) {
			$callback($item);
		}
	}
}


/**
 * @param string $url
 * @return bool
 */
function url_exists($url)
{
	if (curl_init($url) === false) {
		return false;
	}

	$headers = @get_headers($url);
	if (strpos($headers[0], '200') === false) {
		return false;
	}

	return true;
}
