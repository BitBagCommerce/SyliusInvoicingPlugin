<?php

/*
 * This file has been created by developers from BitBag. 
 * Feel free to contact us once you face any issues or want to start
 * another great project. 
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl. 
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class CompanyDataMenuBuilder
{
    public function addItem(MenuBuilderEvent $menuBuilderEvent): void
    {
        $configuration = $menuBuilderEvent->getMenu()->getChild('configuration');
        $configuration
            ->addChild('company_data', [
                'route' => 'bitbag_sylius_invoicing_plugin_admin_company_data_index',
            ])
            ->setLabel('bitbag_sylius_invoicing_plugin.ui.invoice_data')
            ->setLabelAttribute('icon', 'file text outline')
        ;
    }
}
