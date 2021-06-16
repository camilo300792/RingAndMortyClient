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
     * Get a single episode
     *
     * @param int $episode
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getEpisode(int $episode)
    {
        return $this->sendRequest('GET', self::API_EPISODES . '/' . $episode);
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
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function sendRequest(string $method, string $uri)
    {
        $response = $this->client->request($method, $uri);
        return json_decode($response->getBody()->getContents(), true);
    }
}