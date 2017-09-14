<?php
namespace AppBundle\Service;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13.09.17
 * Time: 23:11
 */
class GitHubApi
{
    protected $_httpClient;

    public function __construct(HttpClientInterface $client)
    {
        $this->_httpClient = $client;
    }

    public function getProfile($username)
    {
        $data = $this->_httpClient->get('https://api.github.com/users/' . $username);

        return [
            'avatar_url' => $data['avatar_url'],
            'name' => $data['name'],
            'login' => $data['login'],
            'details' => [
                'company' => $data['company'],
                'location' => $data['location'],
                'joined_on' => 'Joined on ' . (new \DateTime($data['created_at']))->format('d.m.Y'),
            ],
            'blog' => $data['blog'],
            'social_data' => [
                'Public Repos' => $data['public_repos'],
                'Followers' => $data['followers'],
                'Following' => $data['following'],
            ],
        ];
    }

    public function getRepos($username)
    {
        $data = $this->_httpClient->get('https://api.github.com/users/' . $username . '/repos');

        return [
            'repo_count' => count($data),
            'most_stars' => array_reduce($data, function($mostStars, $repo)
            {
                return $repo['stargazers_count'] > $mostStars ? $repo['stargazers_count'] : $mostStars;
            }, 0),
            'repos' => $data
        ];
    }
}