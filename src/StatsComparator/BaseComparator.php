<?php

namespace App\StatsComparator;

use App\StatsFetcher\StatValues;

class BaseComparator implements ComparatorInterface
{
    public function compare(StatValues $stats1, StatValues $stats2): array
    {
        return [
            'latest_release' => $stats1->getLatestRelease() <=> $stats2->getLatestRelease(),
            'fork_count' => $stats1->getForkCount() <=> $stats2->getForkCount(),
            'stargazer_count' => $stats1->getStargazerCount() <=> $stats2->getStargazerCount(),
            'watchers_count' => $stats1->getWatchersCount() <=> $stats2->getWatchersCount(),
            'closed_pull_requests' => $stats1->getClosedPullRequestsCount() <=> $stats2->getClosedPullRequestsCount(),
            'open_pull_requests' => $stats1->getOpenPullRequestsCount() <=> $stats2->getOpenPullRequestsCount(),
        ];
    }
}
