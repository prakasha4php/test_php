<?php
/**
 *
 * Prakash Admane <prakashadmane@gmaill.com>
 */

namespace TestPhp\Promotion;

/**
 * Class PromotionalRules
 * @package TestPhp\Promotion
 */
class PromotionalRules
{
    /**
     * @var array
     */
    protected $promotionalRules;

    /**
     * @var float
     */
    public $total = 0;

    /**
     * PromotionalRules constructor.
     * @param $promotionalRules
     */
    public function __construct($promotionalRules)
    {
        $this->promotionalRules = $promotionalRules;
    }

    /**
     * @param $total
     * @return mixed
     */
    public function orderTotalDiscount($total)
    {
        $promotionalRules = $this->promotionalRules;

        if (array_key_exists('OrderTotalDiscount', $promotionalRules)) {
            if (count($promotionalRules['OrderTotalDiscount']) > 0) {
                foreach ($promotionalRules['OrderTotalDiscount'] as $offer => $discount) {
                    if ($total > $discount['minimumTotalAmount']) {
                        $total = $total - (($total * $discount['percent']) / 100);
                    }
                }
            }
        }
        return $total;
    }

    /**
     * @param $products
     * @return mixed
     */
    public function productDiscount($products)
    {
        $promotionalRules = $this->promotionalRules;

        if (array_key_exists('ProductDiscount', $promotionalRules)) {
            if (count($promotionalRules['ProductDiscount']) > 0) {
                foreach ($promotionalRules['ProductDiscount'] as $productCode => $offer) {
                    $i = 0;
                    $count = 0;
                    while ($count < $offer['minimumQuantity'] && $i < count($products)) {
                        if ($products[$i]->getCode() === $offer['productCode']) {
                            $count++;
                        }
                        $i++;
                    }

                    if ($count > 1) {
                        foreach ($products as $product) {
                            if ($product->getCode() === $offer['productCode']) {
                                $product->setPrice($offer['promotionalPrice']);
                            }
                        }
                    }
                }
            }
        }

        return $products;
    }
}