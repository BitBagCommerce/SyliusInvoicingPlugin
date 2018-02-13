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
use Symfony\Component\Form\FormInterface;

final class AddressTypeExtension extends AbstractTypeExtension
{
    /**
     * @var InvoiceRepositoryInterface
     */
    private $invoiceRepository;

    /**
     * @var EntityManagerInterface
     */
    private $invoiceEntityManager;

    /**
     * @var FormInterface
     */
    private $billingAddressForm;

    /**
     * @var InvoiceInterface
     */
    private $invoice;

    /**
     * @param InvoiceRepositoryInterface $invoiceRepository
     * @param EntityManagerInterface $invoiceEntityManager
     */
    public function __construct(
        InvoiceRepositoryInterface $invoiceRepository,
        EntityManagerInterface $invoiceEntityManager
    ) {
        $this->invoiceRepository = $invoiceRepository;
        $this->invoiceEntityManager = $invoiceEntityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
                $billingAddressForm = $event->getForm()->getParent()->get('billingAddress');

                if ($event->getForm() !== $billingAddressForm) {
                    return;
                }

                $order = $billingAddressForm->getParent()->getData();
                $invoice = $this->invoiceRepository->findByOrderId($order->getId());

                $billingAddressForm->add('invoice', InvoiceType::class, [
                    'label' => false,
                    'mapped' => false,
                ]);

                if (null !== $invoice) {
                    $billingAddressForm->get('invoice')->setData($invoice);
                }

                $this->billingAddressForm = $billingAddressForm;
                $this->invoice = $invoice;
            })
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event): void {
                if ($event->getForm() !== $this->billingAddressForm || null === $this->invoice) {
                    return;
                }

                if (null !== $this->invoice->getVatNumber() &&
                    null !== $this->invoice->getId() &&
                    true === $this->billingAddressForm->isValid()) {
                    $order = $this->billingAddressForm->getParent()->getData();

                    $this->invoice->setOrder($order);

                    $this->invoiceEntityManager->persist($this->invoice);
                    $this->invoiceEntityManager->flush();
                }
            })
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType(): string
    {
        return AddressType::class;
    }
}
