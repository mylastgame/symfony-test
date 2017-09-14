<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class GitHutController extends Controller
{
    public function indexAction(Request $request, $username)
    {
        $this->get('gitHubApi')->getRepos($username);

        return $this->render('githut/index.html.twig', [
             //$data['most_stars'],
            'username' => $username,

        ]);
    }

    public function profileAction(Request $request, $username)
    {
        $profile = $this->get('gitHubApi')->getProfile($username);
        return $this->render('githut/profile.html.twig', $profile);
    }

    public function reposAction($username)
    {
        $repos = $this->get('gitHubApi')->getRepos($username);
        return $this->render('githut/repos.html.twig', $repos);
    }
}
