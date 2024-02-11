<?php declare(strict_types=1);

namespace App\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Table(name: 'brand')]
#[Entity(repositoryClass: 'App\Repositories\BrandRepository')]
class Brand
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'brand_id', type: 'integer')]
    private int $id;

    #[Column(type: 'string', length: 250)]
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}