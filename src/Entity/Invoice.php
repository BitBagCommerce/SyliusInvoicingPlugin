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

use Sylius\Component\Core\Model\OrderInterface;

class Invoice implements InvoiceInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $vatNumber;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var OrderInterface
     */
    protected $order;

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
}
