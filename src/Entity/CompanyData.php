<?php

/*
 * This file has been created by developers from BitBag. 
 * Feel free to contact us once you face any issues or want to start
 * another great project. 
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl. 
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Entity;

class CompanyData implements CompanyDataInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $vatNumber;

    /**
     * @var string
     */
    protected $street;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $postcode;

    /**
     * @var string
     */
    protected $seller;

    /**
     * {@inheritdoc}
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setVatNumber(?string $vatNumber): void
    {
        $this->vatNumber = $vatNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * {@inheritdoc}
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    /**
     * {@inheritdoc}
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * {@inheritdoc}
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * {@inheritdoc}
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * {@inheritdoc}
     */
    public function setPostcode(?string $postcode): void
    {
        $this->postcode = $postcode;
    }

    /**
     * {@inheritdoc}
     */
    public function getSeller(): ?string
    {
        return $this->seller;
    }

    /**
     * {@inheritdoc}
     */
    public function setSeller(?string $seller): void
    {
        $this->seller = $seller;
    }
}
