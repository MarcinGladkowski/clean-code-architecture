<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Model\Doctor;
use App\Domain\Model\Doctors;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineDoctors implements Doctors
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Doctor $doctor): void
    {
        $this->entityManager->persist($doctor);
        $this->entityManager->flush();
    }

    public function getById(int $id): ?Doctor
    {
        return $this->entityManager->createQueryBuilder()
            ->select('doctor')
            ->from(Doctor::class, 'doctor')
            ->where('doctor.id=:id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
