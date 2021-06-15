<?php

//namespace LetTxt;

/**
 * @param array|string $url
 * @param null $callback
 * @param false $associative
 * @return false|mixed|string
 *
 * @throws Exception
 */
function let_txt($url, $callback = null, $associative = false)
{
    if (empty($url)){
        throw new Exception("Url: $url is empty");
    }

    $urls = [];
    if (!is_array($url)){
        $urls[] = $url;
    } else {
        $urls = $url;
    }

    $txt = '';
    foreach($urls as $url_item){
        if (!file_exists($url_item)) {
            throw new Exception("Url: $url_item not exist");
        }
        $file = file_get_contents($url, true);
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

    /** @var string  */
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
