<?php
namespace Hostnet\Component\AccessorGenerator\Generator;

use Doctrine\Common\Collections\Collection;
use Hostnet\Component\AccessorGenerator\Generator\fixtures\Item;
use Hostnet\Component\AccessorGenerator\Generator\fixtures\Shipping;

/**
 * @author Hidde Boomsma <hboomsma@hostnet.nl>
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{
    public function testSetShipping()
    {
        $item     = new Item();
        $shipping = new Shipping();

        $item->setShipping($shipping);
        $this->assertSame($shipping, $item->getShipping());
    }

    /**
     * @expectedException \Doctrine\ORM\EntityNotFoundException
     */
    public function testGetShippingEmpty()
    {
        $item = new Item();
        $item->getShipping();
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testGetShippingTooManyArguments()
    {
        $item = new Item();
        $item->getShipping(1);
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetShippingTooManyArguments()
    {
        $item     = new Item();
        $shipping = new Shipping();
        $item->setShipping($shipping, 2);
    }
}