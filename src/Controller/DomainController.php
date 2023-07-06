<?php declare(strict_types=1);

namespace App\Controller;

use App\Model\Domain\DomainService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DomainController extends AbstractController
{
    public function __construct(
        private readonly DomainService $domainService,
    ) {
    }

    #[Route(path: '/domeny/neregistrovane', name: 'app_domain_unregistered')]
    public function unregisteredAction(): Response
    {
        $unregisteredDomains = $this->domainService->unregisteredDomains();

        return $this->render('domain/unregistered.html.twig', [
            'unregisteredDomains' => $unregisteredDomains,
        ]);
    }
}
