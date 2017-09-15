<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14.09.17
 * Time: 18:54
 */

namespace AppBundle\Service;



class GuzzleHttpClient implements HttpClientInterface
{
    protected $_client;

    //public function __construct(\GuzzleHttp\Client $client)
    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->_client = $client;
    }

    public function get($url)
    {
        //$response = $client->request('GET', 'https://api.github.com/users/' . $username);
        $response = $this->_client->get($url);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function post($url, $data)
    {
        // TODO: Implement post() method.
    }
}