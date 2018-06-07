<?php

namespace LukeSnowden\GoogleShoppingFeed;

class Shipping
{
    /**
     * @var Feed
     */
    private $googleShoppingFeed = null;

    public function __construct($googleShoppingFeed)
    {
        $this->googleShoppingFeed = $googleShoppingFeed;
    }

    /**
     *  ISO 3166-2 country code. (optional)
     * @var string
     */
    private $country;

    /**
     * Submit a service class or shipping speed. (optional)
     * @var string
     */
    private $service;

    /**
     * Fixed shipping cost. (required)
     * @var string
     */
    private $price;

    /**
     * State, territory, or prefecture. (optional)
     * @var string
     */
    private $region;

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @param string $service
     * @return $this
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @param string $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @param string $region
     * @return $this
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Return XML content
     */
    public function getContent()
    {
        $node = new Node('shipping');
        $value = "<g:price>{$this->price} {$this->googleShoppingFeed->getIso4217CountryCode()}</g:price>";

        if($this->country) {
            $value .= "<g:country>{$this->country}</g:country>";
        }

        if($this->service) {
            $value .= "<g:service>{$this->service}</g:service>";
        }

        if($this->region) {
            $value .= "<g:region>{$this->region}</g:region>";
        }

        if (! isset($this->nodes['shipping'])) {
            $this->nodes['shipping'] = array();
        }

        return $node->value($value);
    }
}
