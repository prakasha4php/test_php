<?php
/**
 *
 * Prakash Admane <prakashadmane@gmaill.com>
 */

namespace TestPhp;

use TestPhp\Promotion\PromotionalRules;
use Symfony\Component\Yaml\Yaml;

/**
 * Class CheckoutFactory
 * @package TestPhp
 */
class CheckoutFactory implements CheckoutFactoryInterface
{
    /**
     * @return CheckoutInterface
     */
    public static function create()
    {
        $promotionalRules = Yaml::parse(file_get_contents("./config/promotions.yml"));

        return new Checkout(new PromotionalRules($promotionalRules));
    }
}
