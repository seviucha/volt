<?php

namespace App\Utils;

class GithubUrlHelper
{
    /**
     * @param string $url
     *
     * @return string
     */
    public static function getRepoFromUrl(string $url): string
    {
        $repo = ltrim(parse_url($url, PHP_URL_PATH), '/');

        return str_replace('.git', '', $repo);
    }
}
