<?php

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class InvoiceType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('vatNumber', TextType::class, [
            'label' => 'bitbag_sylius_invoicing_plugin.ui.vat_number',
            'required' => false,
        ]);
    }
}
