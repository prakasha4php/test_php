<?php
/**
 *
 * Prakash Admane <prakashadmane@gmaill.com>
 */
use TestPhp\Entity\Product;
use TestPhp\CheckoutFactory;

/**
 * Class CheckoutTest
 */
class CheckoutTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CheckoutFactory
     */
    protected $checkoutFactory;

    /**
     * @var Product
     */
    protected $product1;

    /**
     * @var Product
     */
    protected $product2;

    /**
     * @var
     */
    protected $product3;

    /**
     * @var Product
     */
    protected $product4;

    /** @var array  */
    protected $promotionRule = [];

    /**
     * @var
     */
    protected $productMock;

    /**
     * Set Up
     */
    public function setUp()
    {
        // $this->checkoutFactory = $this->getMockForAbstractClass('TestPhp\CheckoutFactory');
        $this->checkoutFactory = CheckoutFactory::create();
        $this->productMock = ['001', 'Lavender heart', 9.25];

        $this->product1 = new Product('001', 'Lavender heart', 9.25);
        $this->product2 = new Product('002', 'Personalised cufflinks', 45.00);
        $this->product3 = new Product('003', 'Kids T-shirt', 19.95);
        $this->product4 = new Product('001', 'Lavender heart', 9.25);

        $this->promotionRule = [
            'ProductDiscount' =>
                [
                    [
                        'productCode' => '001',
                        'minimumQuantity' => 2,
                        'promotionalPrice' => 8.5,
                    ],
                ],
            'OrderTotalDiscount' =>
                [
                    'tenPercent' =>
                        [
                            'minimumTotalAmount' => 60,
                            'percent' => 10,
                        ],
                ],
        ];

    }

    /**
     * Test Order Total Discount
     */
    public function testOrderTotalDiscount()
    {
        $checkoutFactory = $this->checkoutFactory;

        $checkoutFactory->scan($this->product1);
        $checkoutFactory->scan($this->product2);
        $checkoutFactory->scan($this->product3);

        $this->assertEquals('£66.78', $checkoutFactory->total());
    }


    /**
     *  Test Product Discount
     */
    public function testProductDiscount()
    {
        $checkoutFactory = $this->checkoutFactory;

        $checkoutFactory->scan($this->product1);
        $checkoutFactory->scan($this->product3);
        $checkoutFactory->scan($this->product4);

        $this->assertEquals('£36.95', $checkoutFactory->total());
    }

    /*
     * Test to Product Discount And Order Total Discount
     */
    public function testProductDiscountAndOrderTotalDiscount()
    {
        $checkoutFactory = $this->checkoutFactory;

        $checkoutFactory->scan($this->product1);
        $checkoutFactory->scan($this->product2);
        $checkoutFactory->scan($this->product3);
        $checkoutFactory->scan($this->product4);

        $this->assertEquals('£73.75', $checkoutFactory->total());
    }
}