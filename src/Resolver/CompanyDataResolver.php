<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Resolver;

use BitBag\SyliusInvoicingPlugin\Entity\CompanyDataInterface;
use BitBag\SyliusInvoicingPlugin\Repository\CompanyDataRepositoryInterface;

final class CompanyDataResolver implements CompanyDataResolverInterface
{
    /** @var CompanyDataRepositoryInterface */
    private $companyDataRepository;

    public function __construct(CompanyDataRepositoryInterface $companyDataRepository)
    {
        $this->companyDataRepository = $companyDataRepository;
    }

    public function resolveCompanyData(): ?CompanyDataInterface
    {
        return $this->companyDataRepository->findCompanyData();
    }
}
