<?php

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\EmailManager;

use BitBag\SyliusInvoicingPlugin\Repository\InvoiceRepositoryInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\PaymentInterface;
use Sylius\Component\Mailer\Sender\SenderInterface;

final class InvoiceEmailManager implements InvoiceEmailManagerInterface
{
    /** @var SenderInterface */
    private $emailSender;

    /** @var InvoiceRepositoryInterface */
    private $invoiceRepository;

    public function __construct(SenderInterface $emailSender, InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->emailSender = $emailSender;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function sendInvoiceEmail(PaymentInterface $payment): void
    {
        /** @var OrderInterface $order */
        $order = $payment->getOrder();

        if (!$this->invoiceRepository->findByOrderId($order->getId())) {
            return;
        }

        $email = $order->getCustomer()->getEmail();

        $this->emailSender->send(self::INVOICE_EMAIL, [$email], ['order' => $order]);
    }
}
