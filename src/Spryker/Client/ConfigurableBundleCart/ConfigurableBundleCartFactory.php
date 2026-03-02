<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleCart;

use Spryker\Client\ConfigurableBundleCart\Adder\ConfiguredBundleCartAdder;
use Spryker\Client\ConfigurableBundleCart\Adder\ConfiguredBundleCartAdderInterface;
use Spryker\Client\ConfigurableBundleCart\Dependency\Client\ConfigurableBundleCartToCartClientInterface;
use Spryker\Client\ConfigurableBundleCart\Dependency\Service\ConfigurableBundleCartToConfigurableBundleServiceInterface;
use Spryker\Client\ConfigurableBundleCart\Reader\QuoteItemReader;
use Spryker\Client\ConfigurableBundleCart\Reader\QuoteItemReaderInterface;
use Spryker\Client\ConfigurableBundleCart\Updater\QuoteItemUpdater;
use Spryker\Client\ConfigurableBundleCart\Updater\QuoteItemUpdaterInterface;
use Spryker\Client\ConfigurableBundleCart\Writer\CartWriter;
use Spryker\Client\ConfigurableBundleCart\Writer\CartWriterInterface;
use Spryker\Client\Kernel\AbstractFactory;

/**
 * @method \Spryker\Client\ConfigurableBundleCart\ConfigurableBundleCartConfig getConfig()
 */
class ConfigurableBundleCartFactory extends AbstractFactory
{
    public function createCartWriter(): CartWriterInterface
    {
        return new CartWriter(
            $this->getCartClient(),
            $this->createQuoteItemReader(),
            $this->createQuoteItemUpdater(),
        );
    }

    public function createQuoteItemUpdater(): QuoteItemUpdaterInterface
    {
        return new QuoteItemUpdater(
            $this->createQuoteItemReader(),
        );
    }

    public function createQuoteItemReader(): QuoteItemReaderInterface
    {
        return new QuoteItemReader();
    }

    public function createConfiguredBundleCartAdder(): ConfiguredBundleCartAdderInterface
    {
        return new ConfiguredBundleCartAdder(
            $this->getCartClient(),
            $this->getConfigurableBundleService(),
        );
    }

    public function getCartClient(): ConfigurableBundleCartToCartClientInterface
    {
        return $this->getProvidedDependency(ConfigurableBundleCartDependencyProvider::CLIENT_CART);
    }

    public function getConfigurableBundleService(): ConfigurableBundleCartToConfigurableBundleServiceInterface
    {
        return $this->getProvidedDependency(ConfigurableBundleCartDependencyProvider::SERVICE_CONFIGURABLE_BUNDLE);
    }
}
