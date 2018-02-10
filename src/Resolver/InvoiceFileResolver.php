<?php

/*
 * This file has been created by the developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Resolver;

use BitBag\SyliusInvoicingPlugin\Entity\InvoiceInterface;
use BitBag\SyliusInvoicingPlugin\FileGenerator\FileGeneratorInterface;
use BitBag\SyliusInvoicingPlugin\Repository\InvoiceRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class InvoiceFileResolver implements InvoiceFileResolverInterface
{
    /**
     * @var FileGeneratorInterface
     */
    private $invoicePdfFileGenerator;

    /**
     * @var InvoiceRepositoryInterface
     */
    private $invoiceRepository;

    /**
     * @var EntityManagerInterface
     */
    private $invoiceEntityManager;

    /**
     * @param FileGeneratorInterface $invoicePdfFileGenerator
     * @param InvoiceRepositoryInterface $invoiceRepository
     * @param EntityManagerInterface $invoiceEntityManager
     */
    public function __construct(
        FileGeneratorInterface $invoicePdfFileGenerator,
        InvoiceRepositoryInterface $invoiceRepository,
        EntityManagerInterface $invoiceEntityManager
    )
    {
        $this->invoicePdfFileGenerator = $invoicePdfFileGenerator;
        $this->invoiceRepository = $invoiceRepository;
        $this->invoiceEntityManager = $invoiceEntityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function resolveInvoicePath(InvoiceInterface $invoice): string
    {
        if (null === $invoice->getPath()) {
            $invoicePath = $this->invoicePdfFileGenerator->generateFile($invoice->getOrder());

            $invoice->setPath($invoicePath);

            $this->invoiceEntityManager->flush();
        }

        return $invoice->getPath();
    }
}
