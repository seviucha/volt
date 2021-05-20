<?php

namespace App\CompareStats;

use App\Dto\CompareStatsDto;
use App\StatsComparator\ComparatorInterface;
use App\StatsFetcher\FetcherInterface;
use RuntimeException;

class CompareStatsService
{
    /**
     * CompareStatsService constructor.
     */
    public function __construct(
        private ComparatorInterface $comparator,
        private FetcherInterface $fetcher,
    ) {
    }

    /**
     * Fetches and compares 2 github repositories.
     *
     * @param string $firstRepo
     * @param string $secondRepo
     *
     * @return CompareStatsDto
     * @throws RuntimeException
     */
    public function compare(string $firstRepo, string $secondRepo): CompareStatsDto
    {
        [$owner1, $repo1] = explode('/', $firstRepo);
        [$owner2, $repo2] = explode('/', $secondRepo);

        $firstRepoStats = $this->fetcher->fetch($owner1, $repo1);
        $secondRepoStats = $this->fetcher->fetch($owner2, $repo2);
        $compare = $this->comparator->compare($firstRepoStats, $secondRepoStats);

        return new CompareStatsDto(
            $firstRepoStats,
            $secondRepoStats,
            $compare
        );
    }
}
