<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\FileGenerator;

use BitBag\SyliusInvoicingPlugin\Entity\InvoiceInterface;
use BitBag\SyliusInvoicingPlugin\Resolver\CompanyDataResolverInterface;
use Knp\Snappy\GeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

final class InvoicePdfFileGenerator implements FileGeneratorInterface
{
    /**
     * @var FilenameGeneratorInterface
     */
    protected $filenameGenerator;

    /**
     * @var GeneratorInterface
     */
    private $pdfFileGenerator;

    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @var CompanyDataResolverInterface
     */
    private $companyDataResolver;

    /**
     * @var string
     */
    private $filesPath;

    /**
     * @param GeneratorInterface $pdfFileGenerator
     * @param EngineInterface $templatingEngine
     * @param CompanyDataResolverInterface $companyDataResolver
     * @param string $filesPath
     * @param FilenameGeneratorInterface $filenameGenerator
     */
    public function __construct(
        GeneratorInterface $pdfFileGenerator,
        EngineInterface $templatingEngine,
        CompanyDataResolverInterface $companyDataResolver,
        string $filesPath,
        FilenameGeneratorInterface $filenameGenerator
    ) {
        $this->pdfFileGenerator = $pdfFileGenerator;
        $this->templatingEngine = $templatingEngine;
        $this->companyDataResolver = $companyDataResolver;
        $this->filesPath = $filesPath;
        $this->filenameGenerator = $filenameGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function generateFile(InvoiceInterface $invoice): string
    {
        $html = $this->templatingEngine->render(
            'BitBagSyliusInvoicingPlugin::invoice.html.twig', [
                'invoice' => $invoice,
                'companyData' => $this->companyDataResolver->resolveCompanyData(),
            ]
        );
        $filename = $this->filenameGenerator->generateFilename($invoice);
        $path = $this->filesPath . DIRECTORY_SEPARATOR . $filename;
        
        $this->pdfFileGenerator->generateFromHtml($html, $path);

        return $filename;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilesDirectoryPath(): string
    {
        return $this->filesPath;
    }
}
