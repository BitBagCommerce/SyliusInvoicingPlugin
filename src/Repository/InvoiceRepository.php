<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Repository;

use BitBag\SyliusInvoicingPlugin\Entity\InvoiceInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

final class InvoiceRepository extends EntityRepository implements InvoiceRepositoryInterface
{
    public function findByOrderId(?int $orderId): ?InvoiceInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.order', 'invoiceOrder')
            ->where('invoiceOrder.id = :orderId')
            ->setParameter('orderId', $orderId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
