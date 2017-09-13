<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class GitHutController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('githut/index.html.twig', [
            'avatar_url' => "https://avatars2.githubusercontent.com/u/12968163?v=5",
            'name' => 'Code Review Videos',
            'login' => 'codereviewvideos',
            'details' => [
                'company' =>  "Code Review Videos",
                'location' => "Preston, Lancs, UK",
                'joined_on' => 'Joined on 3rd Jan 2015'
            ],
            'blog' => "https://codereviewvideos.com/",
            'social_data' => [
                'Public Repos' => 11,
                'Followers' => 0,
                'Following' => 0
            ],
            'repo_count' => 100,
            'most_stars' => 67,
            'repos' => [
                [
                    'name' => 'Some repository',
                    'url' => 'https://asdfasdf.com',
                    'stargazers_count' => 46,
                    'description' => 'learn symfony 3'
                ],
                [
                    'name' => 'Another repository',
                    'url' => 'https://asdfasdf.com',
                    'stargazers_count' => 37,
                    'description' => 'super project'
                ],
                [
                    'name' => 'Secret repository',
                    'url' => 'https://asdfasdf.com',
                    'stargazers_count' => 23,
                    'description' => 'mega secret priject'
                ],
            ]
        ]);
    }

    public function profileAction(Request $request)
    {
        return $this->render('githut/profile.html.twig', [
            'avatar_url' => "https://avatars2.githubusercontent.com/u/12968163?v=5",
            'name' => 'Code Review Videos',
            'login' => 'codereviewvideos',
            'details' => [
                'company' =>  "Code Review Videos",
                'location' => "Preston, Lancs, UK",
                'joined_on' => 'Joined on 3rd Jan 2015'
            ],
            'blog' => "https://codereviewvideos.com/",
            'social_data' => [
                'Public Repos' => 11,
                'Followers' => 0,
                'Following' => 0
            ]
        ]);
    }
}
