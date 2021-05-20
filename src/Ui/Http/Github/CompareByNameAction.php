<?php

namespace App\Ui\Http\Github;

use App\CompareStats\CompareStatsService;
use App\Ui\Http\BaseAction;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;

#[Route('/github-repos/compare-by-name', name: 'github_repos_compare_by_name', methods: ['GET'])]
class CompareByNameAction extends BaseAction
{
    /**
     * Return stats 2 given github repository names and compare them.
     *
     * @Rest\QueryParam(
     *     name="first_repository",
     *     requirements={
     *          @Assert\Regex(
     *              pattern="/^[A-Za-z0-9_.-]+\/[A-Za-z0-9_.-]+$/",
     *              message="Invalid github repository name. Valid name should have owner and repository name eg. symfony/symfony")
     *     },
     *     strict=true,
     *     description="First repository name eg. symfony/symfony"
     * )
     *
     * @Rest\QueryParam(
     *     name="second_repository",
     *     requirements={
     *          @Assert\Regex(
     *              pattern="/^[A-Za-z0-9_.-]+\/[A-Za-z0-9_.-]+$/",
     *              message="Invalid github repository name. Valid name should have owner and repository name eg. symfony/symfony")
     *     },
     *     strict=true,
     *     description="Second repository name eg. facebook/react"
     * )
     *
     * @param ParamFetcher $fetcher
     * @param CompareStatsService $compareStatsService
     *
     * @return View
     */
    public function __invoke(ParamFetcher $fetcher, CompareStatsService $compareStatsService): View
    {
        $firstRepository = $fetcher->get('first_repository');
        $secondRepository = $fetcher->get('second_repository');

        return $this->view(
            $compareStatsService->compare($firstRepository, $secondRepository)
        );
    }
}
