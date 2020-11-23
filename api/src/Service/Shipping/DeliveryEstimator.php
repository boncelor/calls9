<?php

namespace App\Service\Shipping;

use App\Entity\Order;
use App\Service\Shipping\Provider\RoyalMail;

class DeliveryEstimator implements IDeliverable{

    public $supplier;
    public $order;

    public function setOrder(Order $order) {
        // TODO: In the future there is meant to be multiple suppliers apart of Royal Mail
        $this->supplier = new RoyalMail();
        $this->supplier->setOrder($order);
    }

    public function getDeliveryTime() {
        return $this->supplier->getDeliveryTime();
    }
    public function getShippingDay(){
        return $this->supplier->getShippingDay();
    }
    public function getETA(){
        return $this->supplier->getETA();
    }
}
