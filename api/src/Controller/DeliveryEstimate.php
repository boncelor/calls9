<?php

namespace App\Controller;

use App\Entity\Order;
use App\Service\Shipping\DeliveryEstimator;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeliveryEstimate
{
    public function __invoke(Order $data)
    {
        $deliveryEstimator = new DeliveryEstimator();

        $deliveryEstimator->setOrder($data);

        $eta = $deliveryEstimator->getETA()->format('Y-m-d');

        return new JsonResponse([
            'eta'=>$eta
        ],200);
    }
}
