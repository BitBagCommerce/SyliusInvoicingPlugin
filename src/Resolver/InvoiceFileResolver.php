<?php

/*
 * This file has been created by developers from BitBag.
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
    private $invoiceFileGenerator;

    /**
     * @var InvoiceRepositoryInterface
     */
    private $invoiceRepository;

    /**
     * @var EntityManagerInterface
     */
    private $invoiceEntityManager;

    /**
     * @var string
     */
    private $environment;

    /**
     * @param FileGeneratorInterface $invoiceFileGenerator
     * @param InvoiceRepositoryInterface $invoiceRepository
     * @param EntityManagerInterface $invoiceEntityManager
     * @param string $environment
     */
    public function __construct(
        FileGeneratorInterface $invoiceFileGenerator,
        InvoiceRepositoryInterface $invoiceRepository,
        EntityManagerInterface $invoiceEntityManager,
        string $environment
    )
    {
        $this->invoiceFileGenerator = $invoiceFileGenerator;
        $this->invoiceRepository = $invoiceRepository;
        $this->invoiceEntityManager = $invoiceEntityManager;
        $this->environment = $environment;
    }

    /**
     * {@inheritdoc}
     */
    public function resolveInvoicePath(InvoiceInterface $invoice): string
    {
        if (null === $invoice->getPath() || (null !== $invoice->getPath() && 'prod' !== $this->environment)) {
            $invoicePath = $this->invoiceFileGenerator->generateFile($invoice);

            $invoice->setPath($invoicePath);

            $this->invoiceEntityManager->flush();
        }

        return $invoice->getPath();
    }
}
