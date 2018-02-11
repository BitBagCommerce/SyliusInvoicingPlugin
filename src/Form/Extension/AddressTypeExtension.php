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
     * @param InvoiceRepositoryInterface $invoiceRepository
     * @param EntityManagerInterface $invoiceEntityManager
     */
    public function __construct(
        InvoiceRepositoryInterface $invoiceRepository,
        EntityManagerInterface $invoiceEntityManager
    )
    {
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
                $billingAddressForm = $this->getBillingAddressForm($event);

                $billingAddressForm
                    ->add('invoice', InvoiceType::class, [
                        'label' => false,
                        'mapped' => false,
                    ])
                ;

            })
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event): void {
                $billingAddressForm = $this->getBillingAddressForm($event);
                $order = $billingAddressForm->getParent()->getData();

                $billingAddressForm->get('invoice')->setData($this->invoiceRepository->findByOrderId($order->getId()));
            })
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event): void {
                $billingAddressForm = $this->getBillingAddressForm($event);
                /** @var InvoiceInterface $invoice */
                $invoice = $billingAddressForm->get('invoice')->getData();

                if (null !== $invoice->getVatNumber() && true === $billingAddressForm->isValid()) {
                    $order = $billingAddressForm->getParent()->getData();

                    $invoice->setOrder($order);

                    $this->invoiceEntityManager->persist($invoice);
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

    /**
     * @param FormEvent $event
     *
     * @return FormInterface
     */
    private function getBillingAddressForm(FormEvent $event): FormInterface
    {
        return $event->getForm()->getParent()->get('billingAddress');
    }
}
