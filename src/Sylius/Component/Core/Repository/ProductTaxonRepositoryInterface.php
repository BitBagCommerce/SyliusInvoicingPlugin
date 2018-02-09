<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Component\Core\Repository;

use Sylius\Component\Core\Model\ProductTaxonInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface ProductTaxonRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $productCode
     * @param string $taxonCode
     *
     * @return ProductTaxonInterface|null
     */
    public function findOneByProductCodeAndTaxonCode(string $productCode, string $taxonCode): ?ProductTaxonInterface;
}
