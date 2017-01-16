<?php
/**
 *
 * Prakash Admane <prakashadmane@gmaill.com>
 */

namespace TestPhp\Entity;

/**
 * Class Product
 * @package TestPhp
 */
class Product
{
    /**
     * @var integer
     */
    protected $code;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var double
     */
    protected $price;

    /**
     * Product constructor.
     *
     * @param $code
     * @param $name
     * @param $price
     */
    public function __construct($code, $name, $price)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}