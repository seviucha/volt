<?php

namespace App\Dto;

use App\StatsFetcher\StatValues;
use JsonSerializable;

class CompareStatsDto implements JsonSerializable
{
    /**
     * CompareStatsDto constructor.
     *
     */
    public function __construct(
        private StatValues $firstRepo,
        private StatValues $secondRepo,
        private array $compare
    ) {
    }

    /**
     * @return StatValues
     */
    public function getFirstRepo(): StatValues
    {
        return $this->firstRepo;
    }

    /**
     * @return StatValues
     */
    public function getSecondRepo(): StatValues
    {
        return $this->secondRepo;
    }

    /**
     * @return array
     */
    public function getCompare(): array
    {
        return $this->compare;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'first_repo' => [
                'name' => $this->getFirstRepo()->getRepository(),
                'latest_release_date' =>
                    $this->getFirstRepo()->getLatestRelease()
                        ? $this->getFirstRepo()->getLatestRelease()->format(DATE_ATOM)
                        : null,
                'fork_count' => $this->getFirstRepo()->getForkCount(),
                'watchers_count' => $this->getFirstRepo()->getWatchersCount(),
                'stargazer_count' => $this->getFirstRepo()->getStargazerCount(),
                'closed_pull_requests_count' => $this->getFirstRepo()->getClosedPullRequestsCount(),
                'open_pull_requests_count' => $this->getFirstRepo()->getOpenPullRequestsCount(),
            ],
            'second_repo' => [
                'name' => $this->getSecondRepo()->getRepository(),
                'latest_release_date' =>
                    $this->getSecondRepo()->getLatestRelease()
                        ? $this->getSecondRepo()->getLatestRelease()->format(DATE_ATOM)
                        : null,
                'fork_count' => $this->getSecondRepo()->getForkCount(),
                'watchers_count' => $this->getSecondRepo()->getWatchersCount(),
                'stargazer_count' => $this->getSecondRepo()->getStargazerCount(),
                'closed_pull_requests_count' => $this->getSecondRepo()->getClosedPullRequestsCount(),
                'open_pull_requests_count' => $this->getSecondRepo()->getOpenPullRequestsCount(),
            ],
            'comparison' => $this->getCompare()
        ];
    }
}
