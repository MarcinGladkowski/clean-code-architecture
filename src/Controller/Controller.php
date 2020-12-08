<?php
declare(strict_types=1);

namespace App\Controller;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\DoctorEntity;

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

            $objectManager = $this->getDoctrine()->getManager();

            $doctor = new DoctorEntity();
            $doctor->setFirstName($request->get('firstName'));
            $doctor->setLastName($request->get('lastName'));
            $doctor->setSpecialization($request->get('specialization'));

            $objectManager->persist($doctor);
            $objectManager->flush();

            return new JsonResponse(['id' => $doctor->getId()]);
        }
    }

    public function slots(int $doctorId, Request $request)
    {
        $doctor = $this->getDoctor($doctorId);

        if ($doctor) {

            if ($request->getMethod() === 'GET') {
                /** @var SlotEntity[] $slots */
                $slots = $this->extractDoctorSlots($doctor);

                if (count($slots)) {
                    return new JsonResponse($slots);
                } else {
                    return new JsonResponse([]);
                }
            } elseif ($request->getMethod() === 'POST') {

                $slot = new SlotEntity();
                $slot->setDay(new DateTime($request->get('day')));
                $slot->setDoctor($doctor);
                $slot->setDuration((int)$request->get('duration'));
                $slot->setFromHour($request->get('from_hour'));

                $this->getObjectManager()->persist($slot);
                $this->getObjectManager()->flush();

                return new JsonResponse(['id' => $slot->getId()]);
            }
        } else {
            return new JsonResponse([], 404);
        }
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

}
