<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends AbstractController
{
    public function index(): JsonResponse
    {
        return new JsonResponse('ReallyDirty API v1.0');
    }
}
