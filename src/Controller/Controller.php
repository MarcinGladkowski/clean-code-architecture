<?php
declare(strict_types=1);

namespace App\Controller;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Controller extends AbstractController
{

    function index()
    {
        return new JsonResponse('ReallyDirty API v1.0');
    }

    function doctor(Request $request)
    {
        if ($request->getMethod() === 'GET') {
            $doctorId = $request->get('id');
            /** @var EntityManagerInterface $objectManager */
            $objectManager = $this->getDoctrine()->getManager();

            $doctor = $objectManager->createQueryBuilder()
                ->select('doctor')
                ->from(DoctorEntity::class, 'doctor')
                ->where('doctor.id=:id')
                ->setParameter('id', $doctorId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();

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

    function slots(int $doctorId, Request $request)
    {
        /** @var EntityManagerInterface $objectManager */
        $objectManager = $this->getDoctrine()->getManager();

        $doctor = $objectManager->createQueryBuilder()
            ->select('doctor')
            ->from(DoctorEntity::class, 'doctor')
            ->where('doctor.id=:id')
            ->setParameter('id', $doctorId)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        if ($doctor) {

            if ($request->getMethod() === 'GET') {
                /** @var SlotEntity[] $slots */
                $slots = $doctor->slots();

                if (count($slots)) {
                    $res = [];
                    foreach ($slots as $slot) {
                        $res[] = [
                            'id' => $slot->getId(),
                            'day' => $slot->getDay()->format('Y-m-d'),
                            'from_hour' => $slot->getFromHour(),
                            'duration' => $slot->getDuration()
                        ];
                    }
                    return new JsonResponse($res);
                } else {
                    return new JsonResponse([]);
                }
            } elseif ($request->getMethod() === 'POST') {

                $slot = new SlotEntity();
                $slot->setDay(new DateTime($request->get('day')));
                $slot->setDoctor($doctor);
                $slot->setDuration((int)$request->get('duration'));
                $slot->setFromHour($request->get('from_hour'));

                $objectManager->persist($slot);
                $objectManager->flush();

                return new JsonResponse(['id' => $slot->getId()]);
            }
        } else {
            return new JsonResponse([], 404);
        }
    }

}
