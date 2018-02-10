<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CompanyDataType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'bitbag.invoicing.company_name',
            ])
            ->add('street', TextType::class, [
                'label' => 'bitbag.invoicing.street',
            ])
            ->add('city', TextType::class, [
                'label' => 'bitbag.invoicing.city',
            ])
            ->add('postcode', TextType::class, [
                'label' => 'bitbag.invoicing.postcode',
            ])
            ->add('vatNumber', TextType::class, [
                'label' => 'bitbag.invoicing.vat_number',
            ])
            ->add('seller', TextType::class, [
                'label' => 'bitbag.invoicing.seller',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'bitbag_sylius_invoicing_plugin_company_data';
    }
}
