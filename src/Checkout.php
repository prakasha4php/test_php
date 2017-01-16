<?php
/**
 *
 * Prakash Admane <prakashadmane@gmaill.com>
 */

namespace TestPhp;

use TestPhp\Entity\Product;
use TestPhp\Promotion\PromotionalRules;

/**
 * Class Checkout
 * @package TestPhp
 */
class Checkout implements CheckoutInterface
{
    /**
     * @var array
     */
    protected $products = [];

    /**
     * @var object
     */
    protected $promotionalRules;

    /**
     * Checkout constructor.
     *
     * @param \TestPhp\Promotion\PromotionalRules $promotionalRules
     */
    public function __construct($promotionalRules)
    {
        setlocale(LC_MONETARY, 'en_GB.UTF-8');
        $this->promotionalRules = $promotionalRules;
    }

    /**
     * Scan new item
     *
     * @param object $item
     */
    public function scan($item)
    {
        $this->products[] = $item;
    }

    /**
     * Calculate total price of the basket including promotions
     * Returns price string in the £X.XX format
     *
     * @return string
     */
    public function total()
    {
        $total = 0;

        $promotionalRules = $this->promotionalRules;

        $products = $promotionalRules->productDiscount($this->products);

        foreach ($products as $product) {
            $total += $product->getPrice();
        }

        $total = $promotionalRules->orderTotalDiscount($total);

        return money_format('%.2n', $total);
    }
}