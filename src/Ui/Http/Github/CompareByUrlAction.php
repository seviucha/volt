<?php

namespace App\Ui\Http\Github;

use App\CompareStats\CompareStatsService;
use App\Ui\Http\BaseAction;
use App\Utils\GithubUrlHelper;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;

#[Route('/github-repos/compare-by-url', name: 'github_repos_compare_by_url', methods: ['GET'])]
class CompareByUrlAction extends BaseAction
{
    /**
     * Return stats 2 given github repository urls and compare them.
     *
     * @Rest\QueryParam(
     *     name="first_repository",
     *     requirements={
     *          @Assert\Regex(pattern="/^http(s)?:\/\/github\.com([\w\.@\:\/\-~]+)\.git$/", message="Invalid github repository URL.")
     *     },
     *     strict=true,
     *     description="First repository name eg. https://github.com/symfony/symfony.git"
     * )
     *
     * @Rest\QueryParam(
     *     name="second_repository",
     *     requirements={
     *          @Assert\Regex(pattern="/^http(s)?:\/\/github\.com([\w\.@\:\/\-~]+)\.git$/", message="Invalid github repository URL.")
     *     },
     *     strict=true,
     *     description="Second repository name eg. https://github.com/facebook/react.git"
     * )
     *
     * @param ParamFetcher $fetcher
     * @param CompareStatsService $compareStatsService
     *
     * @return View
     */
    public function __invoke(ParamFetcher $fetcher, CompareStatsService $compareStatsService): View
    {
        $firstRepoUrl = $fetcher->get('first_repository');
        $secondRepoUrl = $fetcher->get('second_repository');

        return $this->view(
            $compareStatsService->compare(
                GithubUrlHelper::getRepoFromUrl($firstRepoUrl),
                GithubUrlHelper::getRepoFromUrl($secondRepoUrl)
            )
        );
    }
}
