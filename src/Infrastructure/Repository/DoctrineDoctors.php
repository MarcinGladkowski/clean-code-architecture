<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Controller\DoctorEntity;
use App\Model\Doctors;
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

    public function add(DoctorEntity $doctor): void
    {
        $this->entityManager->persist($doctor);
        $this->entityManager->flush();
    }

    public function getById($id): DoctorEntity
    {
        return $this->entityManager->createQueryBuilder()
            ->select('doctor')
            ->from(DoctorEntity::class, 'doctor')
            ->where('doctor.id=:id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
