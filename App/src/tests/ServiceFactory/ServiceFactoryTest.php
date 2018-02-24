<?php


use  App\Src\ServiceFactory\ServiceFactory;
use App\Src\Service\NameService;
use App\Src\Service\DestinationService;
use App\Src\Service\PriceService;
use App\Src\Service\DateService;

class ServiceFactoryTest extends \PHPUnit\Framework\TestCase
{
    protected $nameServiceObject;
    protected $destinationServiceObject;
    protected $priceServiceObject;
    protected $dateServiceObject;

    public function setUp()
    {
        $object = new ServiceFactory();
        $this->nameServiceObject = $object->create('name', [], ['name' => '']);
        $this->destinationServiceObject = $object->create('destination', [], ['city' => '']);
        $this->priceServiceObject = $object->create('price', [], ['min' => 0, 'max' => 0]);
        $this->dateServiceObject = $object->create('date', [], ['from' => '10-10-2020', 'to' => '15-10-2020']);
    }

    public function providerMethod()
    {
        $object = new ServiceFactory();

        return [
            [
                new NameService([], '')
                , $object->create('name', [], ['name' => ''])
            ],
            [
                new DestinationService([], '')
                , $object->create('destination', [], ['city' => ''])
            ],
            [
                new PriceService([], 0, 0)
                , $object->create('price', [], ['min' => 0, 'max' => 0])
            ],
            [
                new DateService([], '10-10-2020', '15-10-2020')
                , $object->create('date', [], ['from' => '10-10-2020', 'to' => '15-10-2020'])
            ]
        ];
    }

    /**
     * @dataProvider providerMethod
     */

    public function testFactory($object, $objectFactory)
    {
        $this->assertEquals($object, $objectFactory);
    }

}
