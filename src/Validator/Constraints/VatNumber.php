<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

final class VatNumber extends Constraint
{
    /**
     * @var string
     */
    public $message = 'bitbag_sylius_invoicing_plugin.ui.invalid_vat_number';

    /**
     * {@inheritdoc}
     */
    public function validatedBy(): string
    {
        return 'bitbag_sylius_invoicing_plugin_vat_number_validator';
    }

    /**
     * {@inheritdoc}
     */
    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
