<?php
namespace Tzsk\ShortenUrl;


class GoogleUrlShortener
{
    /**
     * Configurations.
     *
     * @var array
     */
    protected $config = [];

    /**
     * URL Endpoint.
     *
     * @var string
     */
    protected $url = 'https://www.googleapis.com/urlshortener/v1/url?';

    /**
     * Extended Response.
     *
     * @var bool
     */
    protected $extended = false;

    /**
     * Buffer URLs.
     *
     * @var array
     */
    protected static $buffer = [];

    protected $curl;

    /**
     * GoogleUrlShortener constructor.
     *
     * @param $app
     */
    public function __construct($app)
    {
        $this->config = $app->make('config')->get('url');

        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_URL, $this->url());
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * Get the API Url.
     *
     * @return string
     */
    protected function url()
    {
        if ($this->config['key']) {
            return $this->url . "key=" . $this->config['key'] . "&";
        }
    }

    /**
     * Enable Extended Response.
     *
     * @return $this
     */
    public function extended()
    {
        $this->extended = true;

        return $this;
    }

    /**
     * Shorten URL here.
     *
     * @param $longUrl
     * @return mixed
     */
    public function shorten($longUrl)
    {
        $response = $this->getShorternerResponse($longUrl);
        dd($response);
        if (! $this->extended) {
            self::$buffer[$longUrl] = $response->id;
        }

        return $this->extended ? $response : $response->id;
    }

    /**
     * Expand URL here.
     *
     * @param $shortUrl
     * @return mixed
     */
    public function expand($shortUrl)
    {
        curl_setopt($this->curl, CURLOPT_HTTPGET, true);
        curl_setopt($this->curl, CURLOPT_URL, $this->url() . 'shortUrl=' . $shortUrl);
        $response = json_decode(curl_exec($this->curl));

        return $this->extended ? $response : $response->longUrl;
    }

    /**
     * Shortener Request.
     *
     * @param $longUrl
     * @return mixed
     */
    private function getShorternerResponse($longUrl)
    {
        if (!$this->extended && !empty(self::$buffer[$longUrl]) ) {
            return self::$buffer[$longUrl];
        }

        curl_setopt($this->curl, CURLOPT_POST, count(compact('longUrl')));
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode(compact('longUrl')));
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        return json_decode(curl_exec($this->curl));
    }

    /**
     * Destroy Curl.
     */
    function __destruct()
    {
        curl_close($this->curl);
        $this->curl = null;
    }

}