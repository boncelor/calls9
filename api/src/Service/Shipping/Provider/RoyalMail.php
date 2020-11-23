<?php

namespace App\Service\Shipping\Provider;

use App\Entity\Order;
use App\Service\Shipping\IDeliverable;

class RoyalMail implements IDeliverable{

    /*
     * @var Order
     */
    public $order;

    /**
     * @param Order $order
     */
    public function setOrder(Order $order = null)
    {
        $this->order = $order;
    }

    public function getDeliveryTime()
    {
        switch ($this->order->getLocation()){
            case 'UK':
                return 1;
            case 'EU':
                return 3;
            case 'WORLD':
                return 8;
            default:
                break;
        }
        throw new \Exception('Invalid location');
    }
    public function getShippingDay()
    {
        if((int)$this->order->getCreatedAt()->format('H')>=16){
            $nextWorkingDay = \DateInterval::createFromDateString('1 weekday');
            return $this->order->getCreatedAt()->add($nextWorkingDay);
        }

        return $this->order->getCreatedAt();

    }
    public function getETA()
    {
        $workingDays = \DateInterval::createFromDateString($this->getDeliveryTime(). " weekdays");
        return $this->getShippingDay()->add($workingDays);
    }
}
