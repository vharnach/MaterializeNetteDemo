<?php

namespace App\Repositories;

use App\Entities\Brand;
use Doctrine\ORM\EntityRepository;

/**
 * @method Brand|null find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method Brand|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Brand[] findAll()
 * @method Brand[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends EntityRepository<Brand>
 */
class BrandRepository extends EntityRepository
{

}
