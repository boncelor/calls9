<?php

namespace App\Tests\Service\Shipping;

use App\Service\Shipping\DeliveryEstimator;
use PHPUnit\Framework\TestCase;
use App\Entity\Order;

final class DeliveryEstimatorTest extends TestCase
{
    public function ordersProvider(){
        return [
            'UK monday morning'=>['UK','2020-11-23 10:00:00',1,'2020-11-23','2020-11-24'],
            'UK friday afternoon'=>['UK','2020-11-27 17:00:00',1,'2020-11-30','2020-12-01'],
            'EU monday morning'=>['EU','2020-11-23 11:00:00',3,'2020-11-23','2020-11-26'],
            'EU friday afternoon'=>['EU','2020-11-27 17:00:00',3,'2020-11-30','2020-12-03'],
            'WORLD monday morning'=>['WORLD','2020-11-23 05:00:00',8,'2020-11-23','2020-12-03'],
            'WORLD friday afternoon'=>['WORLD','2020-11-27 18:00:00',8,'2020-11-30','2020-12-10'],
        ];
    }

    /**
     * @dataProvider ordersProvider
     */
    public function testDeliveryTimeForLocation($location,$createdAt,$deliveryTime,$shippingDate, $deliveryDate){
        $order = new Order();
        $order->setLocation($location);
        $order->setCreatedAt(date_create_from_format('Y-m-d H:i:s', $createdAt));

        $shippingProvider = new DeliveryEstimator();
        $shippingProvider->setOrder($order);

        $this->assertSame($deliveryTime, $shippingProvider->getDeliveryTime());
    }

    /**
     * @dataProvider ordersProvider
     */
    public function testShippingDay($location,$createdAt,$deliveryTime,$shippingDate, $deliveryDate){
        $order = new Order();
        $order->setLocation($location);
        $order->setCreatedAt(date_create_from_format('Y-m-d H:i:s', $createdAt));

        $shippingProvider = new DeliveryEstimator();
        $shippingProvider->setOrder($order);

        $this->assertEquals($shippingDate, $shippingProvider->getShippingDay()->format('Y-m-d'));
    }

    /**
     * @dataProvider ordersProvider
     */
    public function testDeliveryDay($location,$createdAt,$deliveryTime,$shippingDate, $deliveryDate){
        $order = new Order();
        $order->setLocation($location);
        $order->setCreatedAt(date_create_from_format('Y-m-d H:i:s', $createdAt));

        $shippingProvider = new DeliveryEstimator();
        $shippingProvider->setOrder($order);

        $this->assertTrue(true);
        $this->assertEquals($deliveryDate, $shippingProvider->getETA()->format('Y-m-d'));
    }
}
