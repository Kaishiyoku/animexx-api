<?php

namespace Kaishiyoku\AnimexxApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Kaishiyoku\AnimexxApi\Exception\RequestException;

class HttpFetcher
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * HttpFetcher constructor.
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->httpClient = new Client();
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param string $method
     * @param string $path
     * @return array
     * @throws GuzzleException
     */
    public function fetchResource(string $method, string $path): array
    {
        $response = $this->httpClient->request($method, $this->getUrlFor($path));

        return json_decode($response->getBody(), true);
    }

    /**
     * @param string $path
     * @return string
     */
    private function getUrlFor(string $path) : string
    {
        return $this->baseUrl . $path;
    }
}
