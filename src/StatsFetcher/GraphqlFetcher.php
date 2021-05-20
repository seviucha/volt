<?php

namespace App\StatsFetcher;

use DateTimeImmutable;
use Github\Client;
use Github\Exception\RuntimeException;
use Psr\Log\LoggerInterface;

class GraphqlFetcher implements FetcherInterface
{
    /**
     * GraphqlFetcher constructor.
     *
     * @param Client $client
     * @param LoggerInterface $logger
     */
    public function __construct(
        private Client $client,
        private LoggerInterface $logger
    ) {
    }

    public function fetch(string $owner, string $repo): StatValues
    {
        try {
            $result = $this
                ->client
                ->api('graphql')
                ->execute($this->getQuery(), ['owner' => $owner, 'name' => $repo]);
        } catch (RuntimeException $exception) {
            $this->logger->error($exception->getMessage());

            throw new RuntimeException($exception->getMessage());
        }

        return new StatValues(
            $result['data']['repository']['nameWithOwner'],
            null !== $result['data']['repository']['latestRelease']
                ? new DateTimeImmutable($result['data']['repository']['latestRelease']['publishedAt'])
                : null,
            $result['data']['repository']['forkCount'],
            $result['data']['repository']['stargazerCount'],
            $result['data']['repository']['watchersCount']['totalCount'],
            $result['data']['repository']['closedPullRequests']['totalCount'],
            $result['data']['repository']['openPullRequests']['totalCount'],
        );
    }

    private function getQuery(): string
    {
        return <<<'QUERY'
query ($owner: String!, $name: String!) {
  repository(owner: $owner, name: $name) {
    nameWithOwner
    latestRelease {
      publishedAt
    }
    forkCount
    stargazerCount
    watchersCount: watchers {
      totalCount
    }
    closedPullRequests: pullRequests(states: CLOSED) {
      totalCount
    }
    openPullRequests: pullRequests(states: OPEN) {
      totalCount
    }
  }
}
QUERY;
    }
}
