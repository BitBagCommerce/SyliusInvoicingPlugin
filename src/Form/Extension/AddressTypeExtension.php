<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace AppBundle\Form\Extension;

use BitBag\SyliusInvoicingPlugin\Form\Type\InvoiceType;
use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class AddressTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('invoice', InvoiceType::class, [
                'label' => false,
                'mapped' => false,
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event): void {
                $form = $event->getForm();
                $differentBillingAddress = $form->get('differentBillingAddress')->getData();

                if (true === $differentBillingAddress) {
                    $invoice = $form->get('invoice')->getData();
                    $billingAddress = $form->get('billingAddress')->getData();

                    $invoice->setBillingAddress($billingAddress);
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
