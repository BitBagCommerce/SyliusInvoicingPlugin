<?php

/*
 * This file has been created by developers from BitBag. 
 * Feel free to contact us once you face any issues or want to start
 * another great project. 
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl. 
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\EmailManager;

use Sylius\Component\Core\Model\PaymentInterface;

interface InvoiceEmailManagerInterface
{
    const INVOICE_EMAIL = 'order_invoice';

    public function sendInvoiceEmail(PaymentInterface $payment): void;
}
