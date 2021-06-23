<?php

namespace RAMC;

use Dompdf\Exception;
use GuzzleHttp\Client;

final class RAMClient
{
    const BASE_URI = 'https://rickandmortyapi.com/api/';
    const API_CHARACTERS = 'character';
    const API_LOCATIONS = 'location';
    const API_EPISODES = 'episode';

    /**
     * @var Client;
     */
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'verify' => false
        ]);
    }

    /**
     * Access the list of episodes
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getEpisodes()
    {
        return $this->sendRequest('GET', self::API_EPISODES);
    }

    /**
     * Access the list of locations
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLocations()
    {
        return $this->sendRequest('GET', self::API_LOCATIONS);
    }

    /**
     * Get a single episode
     *
     * @param int $episode
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getEpisode(int $episode, bool $decode = false)
    {
        return $this->sendRequest('GET', self::API_EPISODES . '/' . $episode, $decode);
    }

    /**
     * Access the list of character
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCharacter(int $character)
    {
        return $this->sendRequest('GET', self::API_CHARACTERS . '/' . $character);
    }

    /**
     * Send API request
     *
     * @param string $method
     * @param string $uri
     * @param bool $decode
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function sendRequest(string $method, string $uri, bool $decode = false)
    {
        $response = $this->client->request($method, $uri);
        if ($decode) {
            return json_decode($response->getBody()->getContents(), true);
        }
        return $response->getBody()->getContents();
    }
}