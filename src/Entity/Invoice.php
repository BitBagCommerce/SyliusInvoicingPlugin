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

use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Core\Model\OrderInterface;

final class Invoice implements InvoiceInterface
{
    /**
     * @var string
     */
    protected $vatNumber;

    /**
     * @var AddressInterface
     */
    protected $address;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @var string
     */
    protected $path;

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
    public function getAddress(): AddressInterface
    {
        return $this->address;
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress(AddressInterface $address): void
    {
        $this->address = $address;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder(): OrderInterface
    {
        return $this->order;
    }

    /**
     * {@inheritdoc}
     */
    public function setOrder(?OrderInterface $order): void
    {
        $this->order = $order;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }
}
