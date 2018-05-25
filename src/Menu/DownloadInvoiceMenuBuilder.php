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

use BitBag\SyliusInvoicingPlugin\Repository\InvoiceRepositoryInterface;
use BitBag\SyliusInvoicingPlugin\Resolver\CompanyDataResolverInterface;
use Knp\Menu\ItemInterface;
use Sylius\Bundle\AdminBundle\Event\OrderShowMenuBuilderEvent;
use Sylius\Component\Core\Model\OrderInterface;

final class DownloadInvoiceMenuBuilder
{
    /** @var InvoiceRepositoryInterface */
    private $invoiceRepository;

    /** @var InvoiceRepositoryInterface */
    private $companyDataResolver;

    public function __construct(
        InvoiceRepositoryInterface $invoiceRepository,
        CompanyDataResolverInterface $companyDataResolver
    ) {
        $this->invoiceRepository = $invoiceRepository;
        $this->companyDataResolver = $companyDataResolver;
    }

    public function addItem(OrderShowMenuBuilderEvent $orderShowMenuBuilderEvent): void
    {
        /** @var OrderInterface $order */
        $order = $orderShowMenuBuilderEvent->getOrder();

        if (null === $this->invoiceRepository->findByOrderId($order->getId())) {
            return;
        }

        $menu = $orderShowMenuBuilderEvent->getMenu();

        if (null === $this->companyDataResolver->resolveCompanyData()) {
            $this->addNoCompanyDataInfoMenuItem($menu);

            return;
        }

        $this->addDownloadInvoiceMenuItem($menu, $order);
    }

    private function addNoCompanyDataInfoMenuItem(ItemInterface $menu): void
    {
        $menu
            ->addChild('download_invoice', [
                'route' => 'bitbag_sylius_invoicing_plugin_admin_company_data_index',
            ])
            ->setAttribute('type', 'link')
            ->setLabel('bitbag_sylius_invoicing_plugin.ui.set_invoice_data')
            ->setLabelAttribute('icon', 'warning')
            ->setLabelAttribute('color', 'yellow')
        ;
    }

    private function addDownloadInvoiceMenuItem(ItemInterface $menu, OrderInterface $order): void
    {
        $menu
            ->addChild('download_invoice', [
                'route' => 'bitbag_sylius_invoicing_plugin_download_order_invoice',
                'routeParameters' => ['orderTokenValue' => $order->getTokenValue()],
            ])
            ->setAttribute('type', 'link')
            ->setLabel('bitbag_sylius_invoicing_plugin.ui.download_invoice')
            ->setLabelAttribute('icon', 'download')
            ->setLabelAttribute('color', 'blue')
        ;
    }
}
