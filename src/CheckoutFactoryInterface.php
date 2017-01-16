<?php
/**
 *
 * Prakash Admane <prakashadmane@gmaill.com>
 */

namespace TestPhp;

/**
 * Factory which is responsible for the
 * creation of the new checkout object
 */
interface CheckoutFactoryInterface
{
    /**
     * Create new checkout object
     *
     * @return CheckoutInterface
     */
    public static function create();
}
