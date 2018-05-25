<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Form\Extension;

use BitBag\SyliusInvoicingPlugin\Entity\InvoiceInterface;
use BitBag\SyliusInvoicingPlugin\Form\Type\InvoiceType;
use BitBag\SyliusInvoicingPlugin\Repository\InvoiceRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class AddressTypeExtension extends AbstractTypeExtension
{
    /** @var InvoiceRepositoryInterface */
    private $invoiceRepository;

    /** @var EntityManagerInterface */
    private $invoiceEntityManager;

    public function __construct(
        InvoiceRepositoryInterface $invoiceRepository,
        EntityManagerInterface $invoiceEntityManager
    ) {
        $this->invoiceRepository = $invoiceRepository;
        $this->invoiceEntityManager = $invoiceEntityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
                $parentForm = $event->getForm()->getParent();

                if (null === $parentForm) {
                    return;
                }

                $billingAddressForm = $parentForm->get('billingAddress');

                if ($event->getForm() !== $billingAddressForm) {
                    return;
                }

                $order = $billingAddressForm->getParent()->getData();
                $invoice = $this->invoiceRepository->findByOrderId($order->getId());

                $billingAddressForm->add('invoice', InvoiceType::class, [
                    'label' => false,
                    'mapped' => false,
                    'data' => $invoice,
                ]);
            })
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event): void {
                if (!$event->getForm()->has('invoice')) {
                    return;
                }

                /** @var InvoiceInterface $invoice */
                $billingAddressForm = $event->getForm();
                $invoice = $billingAddressForm->get('invoice')->getData();

                if (null !== $invoice->getVatNumber() && true === $billingAddressForm->isValid()) {
                    $order = $billingAddressForm->getParent()->getData();

                    $invoice->setOrder($order);

                    $invoice->getId() ?: $this->invoiceEntityManager->persist($invoice);
                    $this->invoiceEntityManager->flush();
                }
            })
        ;
    }

    public function getExtendedType(): string
    {
        return AddressType::class;
    }
}
