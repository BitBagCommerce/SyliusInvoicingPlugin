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

use Sylius\Component\Resource\Model\ResourceInterface;

interface FileGeneratorInterface
{
    /**
     * @param ResourceInterface $resource
     *
     * @return string path to the generated file
     */
    public function generateFile(ResourceInterface $resource): string;
}
