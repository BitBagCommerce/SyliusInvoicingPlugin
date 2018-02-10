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

interface InvoiceInterface
{
    /**
     * @return string|null
     */
    public function getVatNumber(): ?string;

    /**
     * @param string|null $vatNumber
     */
    public function setVatNumber(?string $vatNumber): void;

    /**
     * @return AddressInterface
     */
    public function getAddress(): AddressInterface;

    /**
     * @param AddressInterface $address
     */
    public function setAddress(AddressInterface $address): void;

    /**
     * @return OrderInterface
     */
    public function getOrder(): OrderInterface;

    /**
     * @param OrderInterface $order
     */
    public function setOrder(OrderInterface $order): void;

    /**
     * @return null|string
     */
    public function getPath(): ?string;

    /**
     * @param null|string $path
     */
    public function setPath(?string $path): void;
}
