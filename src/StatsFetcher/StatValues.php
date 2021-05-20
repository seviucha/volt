<?php

namespace App\StatsFetcher;

use DateTimeInterface;

class StatValues
{

    /**
     * StatsResponse constructor.
     *
     */
    public function __construct(
        private string $repository,
        private ?DateTimeInterface $latestRelease,
        private int $forkCount,
        private int $stargazerCount,
        private int $watchersCount,
        private int $closedPullRequestsCount,
        private int $openPullRequestsCount,
    ) {
    }

    /**
     * @return string
     */
    public function getRepository(): string
    {
        return $this->repository;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getLatestRelease(): ?DateTimeInterface
    {
        return $this->latestRelease;
    }

    /**
     * @return int
     */
    public function getForkCount(): int
    {
        return $this->forkCount;
    }

    /**
     * @return int
     */
    public function getStargazerCount(): int
    {
        return $this->stargazerCount;
    }

    /**
     * @return int
     */
    public function getWatchersCount(): int
    {
        return $this->watchersCount;
    }

    /**
     * @return int
     */
    public function getClosedPullRequestsCount(): int
    {
        return $this->closedPullRequestsCount;
    }

    /**
     * @return int
     */
    public function getOpenPullRequestsCount(): int
    {
        return $this->openPullRequestsCount;
    }
}
