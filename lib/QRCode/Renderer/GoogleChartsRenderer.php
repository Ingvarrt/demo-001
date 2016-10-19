<?php

namespace Ing\QRCode\Renderer;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Ing\QRCode\Exception\RuntimeException;

class GoogleChartsRenderer implements RendererInterface
{
    /**
     * Google Chart API URI.
     * @var string
     */
    protected $uri = 'https://chart.googleapis.com/chart?chs=%dx%d&cht=qr&chl=%s&choe=UTF-8';

    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @return string
     * @throws RuntimeException
     */
    public function render()
    {
        $uri = sprintf($this->uri, $this->width, $this->height, $this->text);

        try {
            $res = $this->getHttpClient()->request('GET', $uri);

        } catch (GuzzleException $e) {
            throw new RuntimeException('Request failed', 0, $e);
        }

        if ($res->getStatusCode() != 200) {
            throw new RuntimeException('Request failed, status code is not OK');
        }

        return $res->getBody();
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param int $width
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Sets HTTP Client for calling the API.
     * @param ClientInterface $client
     * @return $this
     */
    public function setHttpClient(ClientInterface $client)
    {
        $this->httpClient = $client;
        return $this;
    }

    /**
     * Returns HTTP Client. If not set, use GuzzleHttpClient by default.
     * @return ClientInterface
     */
    protected function getHttpClient()
    {
        if (empty($this->httpClient)) {
            $this->httpClient = new Client();
        }

        return $this->httpClient;
    }
}
