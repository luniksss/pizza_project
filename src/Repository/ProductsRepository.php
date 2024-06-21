<?php
declare(strict_types=1);

namespace App\Repository;
use App\Entity\Pizza;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ProductsRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Pizza::class);
    }

    public function findById($id): ?Pizza
    {
        return $this->repository->findOneBy(['id' => (string)
         $id]);
    }

    public function listAll(): array
    {
        return $this->repository->findAll();
    }

    public function store(Pizza $pizza): void
    {
        $this->em->persist($pizza);
        $this->em->flush();
    }


    public function delete(Pizza $pizza): void
    {
        $this->em->remove($pizza);
        $this->em->flush();
    }
}
?>