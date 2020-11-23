<?php

namespace App\Service\Shipping;

use App\Entity\Order;

interface IDeliverable{
    public function setOrder(Order $order);
    public function getDeliveryTime();
    public function getShippingDay();
    public function getETA();
}
