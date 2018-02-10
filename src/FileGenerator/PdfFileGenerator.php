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

use Knp\Snappy\GeneratorInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Templating\EngineInterface;

final class PdfFileGenerator implements FileGeneratorInterface
{
    /**
     * @var GeneratorInterface
     */
    private $pdfFileGenerator;

    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @var string
     */
    private $filesPath;

    /**
     * @var string
     */
    private $templatePath;

    /**
     * @param GeneratorInterface $pdfFileGenerator
     * @param EngineInterface $templatingEngine
     * @param string $filesPath
     * @param string $templatePath
     */
    public function __construct(
        GeneratorInterface $pdfFileGenerator,
        EngineInterface $templatingEngine,
        string $filesPath,
        string $templatePath
    ) {
        $this->pdfFileGenerator = $pdfFileGenerator;
        $this->templatingEngine = $templatingEngine;
        $this->filesPath = $filesPath;
        $this->templatePath = $templatePath;
    }

    /**
     * {@inheritdoc}
     */
    public function generateFile(ResourceInterface $resource): string
    {
        $html = $this->templatingEngine->render($this->templatePath, ['resource' => $resource]);
        $path = $this->filesPath . '/' . (string) $resource->getId() . bin2hex(random_bytes(6)) . '.pdf';

        $this->pdfFileGenerator->getOutputFromHtml($html, $path);

        return $path;
    }
}
