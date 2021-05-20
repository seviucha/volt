<?php


namespace App\StatsFetcher;


use RuntimeException;

interface FetcherInterface
{
    /**
     * Fetches repository data.
     *
     * @param string $owner
     * @param string $repo
     *
     * @return StatValues
     * @throws RuntimeException
     */
    public function fetch(string $owner, string $repo): StatValues;
}
