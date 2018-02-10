<?php

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class BitBagSyliusInvoicingPlugin extends Bundle
{
    use SyliusPluginTrait;
}
