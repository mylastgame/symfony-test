<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14.09.17
 * Time: 18:53
 */
namespace AppBundle\Service;

interface HttpClientInterface
{
    public function get($url);
    public function post($url, $data);
}