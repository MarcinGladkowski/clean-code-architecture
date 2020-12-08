<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\DoctorEntity;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{

    public function index()
    {
        return new JsonResponse('ReallyDirty API v1.0');
    }

    public function doctor(Request $request)
    {
        if ($request->getMethod() === 'GET') {
            $doctor =$this->getDoctor($request->get('id'));

            if ($doctor) {

                return new JsonResponse([
                    'id' => $doctor->getId(),
                    'firstName' => $doctor->getFirstName(),
                    'lastName' => $doctor->getLastName(),
                    'specialization' => $doctor->getSpecialization(),
                ]);

            } else {
                return new JsonResponse([], 404);
            }
        } elseif ($request->getMethod() === 'POST') {

            $doctor = $this->createDoctor(
                $request->get('firstName'),
                $request->get('lastName'),
                $request->get('specialization')
            );

            $this->save($doctor);

            return new JsonResponse(['id' => $doctor->getId()]);
        }
    }

    /**
     * @Route("/slots/{doctorId}", methods={"GET"})
     * @param int $doctorId
     * @param Request $request
     * @return JsonResponse
     */
    public function showSlots(int $doctorId, Request $request)
    {
        $doctor = $this->getDoctor($doctorId);

        if ($doctor) {
            if ($request->getMethod() === 'GET') {
                /** @var SlotEntity[] $slots */
                $slots = $this->extractDoctorSlots($doctor);

                return new JsonResponse(count($slots) ? $slots : []);
            }
        }

    }

    /**
     * @Route("/slots/{doctorId}", methods={"POST"})
     * @param int $doctorId
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function saveSlots(int $doctorId, Request $request)
    {
        $doctor = $this->getDoctor($doctorId);

        $slot = $this->createSlot(
            $doctor,
            new \DateTime($request->get('day')),
            (int)$request->get('duration'),
            $request->get('from_hour')
        );

        $this->save($slot);

        return new JsonResponse(['id' => $slot->getId()]);
    }

    /**
     * @return ObjectManager|EntityManagerInterface
     */
    private function getObjectManager()
    {
        return $this->getDoctrine()->getManager();
    }

    private function getDoctor($doctorId)
    {
        return $this->getObjectManager()->createQueryBuilder()
            ->select('doctor')
            ->from(DoctorEntity::class, 'doctor')
            ->where('doctor.id=:id')
            ->setParameter('id', $doctorId)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    private function extractDoctorSlots(DoctorEntity $doctor)
    {
        $slots = $doctor->slots();
        $res = [];
        foreach ($slots as $slot) {
            $res[] = [
                'id' => $slot->getId(),
                'day' => $slot->getDay()->format('Y-m-d'),
                'from_hour' => $slot->getFromHour(),
                'duration' => $slot->getDuration()
            ];
        }
        return $res;
    }

    private function save($object): void
    {
        $this->getObjectManager()->persist($object);
        $this->getObjectManager()->flush();
    }

    private function createDoctor($firstName, $lastName, $specialization): DoctorEntity
    {
        $doctor = new DoctorEntity();
        $doctor->setFirstName($firstName);
        $doctor->setLastName($lastName);
        $doctor->setSpecialization($specialization);

        return $doctor;
    }

    private function createSlot(DoctorEntity $doctor, \DateTime $day, int $duration, $fromHour): SlotEntity
    {
        $slot = new SlotEntity();
        $slot->setDay($day);
        $slot->setDoctor($doctor);
        $slot->setDuration($duration);
        $slot->setFromHour($fromHour);

        return $slot;
    }

}
