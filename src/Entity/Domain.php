<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Table(name: 'domain')]
#[ORM\Entity]
class Domain
{
    public const FIRST_ORDER_DOMAIN_CZ = 'cz';

    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(name: 'length', type: Types::INTEGER)]
    private int $length;

    #[ORM\Column(name: 'name', type: Types::STRING)]
    private string $name;

    #[ORM\Column(name: 'registered', type: Types::BOOLEAN)]
    private bool $registered;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_IMMUTABLE)]
    #[Gedmo\Timestampable(on: 'create')]
    private \DateTimeImmutable $createdAt;

    public function __construct(int $length, string $name, bool $registered)
    {
        $this->length = $length;
        $this->name = $name;
        $this->registered = $registered;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreated(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getLength(): int
    {
        return $this->length;
    }
}
