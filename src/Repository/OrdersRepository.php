<?php
declare(strict_types=1);

namespace App\Repository;
use App\Entity\Basket;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class OrdersRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Basket::class);
    }

    public function store(Basket $order): int
    {
        $this->em->persist($order);
        $this->em->flush();
        return $order->getUserId();
    }
}