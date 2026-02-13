<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class ApiController extends AbstractController
{
    #[Route('/api/sum', name: 'api_sum', methods: ['POST'])]
    public function sum(Request $request): JsonResponse
    {
        // Obtener contenido JSON
        $data = json_decode($request->getContent(), true);

        // Validar que existan
        if (!isset($data['a']) || !isset($data['b'])) {
            return new JsonResponse([
                'error' => "Both 'a' and 'b' are required."
            ], 400);
        }

        // Validar que sean numéricos
        if (!is_numeric($data['a']) || !is_numeric($data['b']) ||
            is_string($data['a']) || is_string($data['b'])) {

            return new JsonResponse([
                'error' => "Both 'a' and 'b' must be numeric."
            ], 400);
        }

        // Realizar suma
        $sum = $data['a'] + $data['b'];

        // Respuesta exitosa
        return new JsonResponse([
            'sum' => $sum
        ]);
    }
}
