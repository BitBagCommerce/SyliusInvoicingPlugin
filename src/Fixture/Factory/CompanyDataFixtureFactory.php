<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Fixture\Factory;

use BitBag\SyliusInvoicingPlugin\Entity\CompanyDataInterface;
use BitBag\SyliusInvoicingPlugin\Repository\CompanyDataRepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class CompanyDataFixtureFactory implements FixtureFactoryInterface
{
    /** @var FactoryInterface  */
    private $companyDataFactory;

    /** @var CompanyDataRepositoryInterface  */
    private $companyDataRepository;

    public function __construct(
        FactoryInterface $companyDataFactory,
        CompanyDataRepositoryInterface $companyDataRepository
    ) {
        $this->companyDataFactory = $companyDataFactory;
        $this->companyDataRepository = $companyDataRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $data): void
    {
        foreach ($data as $fields) {
            /** @var CompanyDataInterface $companyData */
            $companyData = $this->companyDataFactory->createNew();

            $companyData->setName($fields['name']);
            $companyData->setVatNumber($fields['vatNumber']);
            $companyData->setCity($fields['city']);
            $companyData->setCountryCode($fields['countryCode']);
            $companyData->setPostcode($fields['postcode']);
            $companyData->setStreet($fields['street']);
            $companyData->setSeller($fields['seller']);

            $this->companyDataRepository->add($companyData);
        }
    }
}
