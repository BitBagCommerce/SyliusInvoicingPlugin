<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Fixture;

use BitBag\SyliusInvoicingPlugin\Fixture\Factory\FixtureFactoryInterface;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class CompanyDataFixture extends AbstractFixture
{
    /** @var FixtureFactoryInterface */
    private $companyDataFixtureFactory;

    public function __construct(FixtureFactoryInterface $companyDataFixtureFactory)
    {
        $this->companyDataFixtureFactory = $companyDataFixtureFactory;
    }

    public function load(array $options): void
    {
        $this->companyDataFixtureFactory->load($options['custom']);
    }

    public function getName(): string
    {
        return 'company_data';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->arrayNode('custom')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('name')->defaultNull()->end()
                            ->scalarNode('vatNumber')->defaultNull()->end()
                            ->scalarNode('street')->defaultNull()->end()
                            ->scalarNode('city')->defaultNull()->end()
                            ->scalarNode('postcode')->defaultNull()->end()
                            ->scalarNode('countryCode')->defaultNull()->end()
                            ->scalarNode('seller')->defaultNull()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
