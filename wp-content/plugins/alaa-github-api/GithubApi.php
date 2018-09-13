<?php

// For security reasons, it’s also a good idea to deny direct access to the file
defined('ABSPATH') or die('No script kiddies please!');
require_once __DIR__ . '/vendor/autoload.php';


class GithubApi extends \Github\Client
{

}
    