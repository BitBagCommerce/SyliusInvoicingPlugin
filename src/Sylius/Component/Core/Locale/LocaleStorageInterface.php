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

namespace Sylius\Component\Core\Locale;

use Sylius\Component\Channel\Context\ChannelNotFoundException;
use Sylius\Component\Channel\Model\ChannelInterface;

interface LocaleStorageInterface
{
    /**
     * @param ChannelInterface $channel
     * @param string $localeCode
     */
    public function set(ChannelInterface $channel, string $localeCode): void;

    /**
     * @param ChannelInterface $channel
     *
     * @return string
     *
     * @throws ChannelNotFoundException
     */
    public function get(ChannelInterface $channel): string;
}
