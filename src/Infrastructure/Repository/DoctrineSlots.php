<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Model\Slot;
use App\Model\Slots;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineSlots implements Slots
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Slot $slotEntity): void
    {
        $this->entityManager->persist($slotEntity);
        $this->entityManager->flush();
    }
}
