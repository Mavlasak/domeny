<?php declare(strict_types=1);

namespace App\Model\Domain;

use App\Entity\Domain;
use App\Bundle\Parser;
use App\Utils\StringUtils;

final class DomainService
{
    public function __construct(
        private readonly DomainRepository $domainRepository,
    ) {
    }

    public function resolveAndSaveDomainsByLength(int $length): void
    {
        $lastInsertedDomain = $this->getLastInserted($length);
        $letterCombinations = StringUtils::charCombinations(StringUtils::possibleDomainCharacters(), $length);
        if ($lastInsertedDomain !== null) {
            $letterCombinations = array_slice($letterCombinations, array_search($lastInsertedDomain->getName(), $letterCombinations) + 1);
        }

        foreach ($letterCombinations as $letterCombination) {
            $domain = $letterCombination . '.' . Domain::FIRST_ORDER_DOMAIN_CZ;
            $domainRegistered = $this->resolveDomain($domain);
            $this->create($length, $letterCombination, $domainRegistered);
        }
    }

    private function resolveDomain(string $domain): bool
    {
        $parser = new Parser();
        $domainResult = $parser->lookup($domain);

        return $domainResult->toArray()['registered'];
    }

    private function create(int $length, string $name, bool $available): void
    {
        $domain = new Domain($length, $name, $available);
        $this->domainRepository->save($domain);
    }

    private function getLastInserted(int $length): ?Domain
    {
        return $this->domainRepository->findOneBy(['length' => $length], ['id' => 'desc']);
    }

    public function unregisteredDomains(): array
    {
        return $this->domainRepository->findBy([
            'registered' => false,
        ]);
    }
}
