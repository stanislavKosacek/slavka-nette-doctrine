<?php

namespace App\Model\Facade;

use App\Model\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ProductFacade
{
    protected EntityRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(Product::class);
    }

    /**
     * @return Product[]
     */
    public function findAllProducts(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): ?Product
    {
        return $this->repository->find($id);
    }

}
