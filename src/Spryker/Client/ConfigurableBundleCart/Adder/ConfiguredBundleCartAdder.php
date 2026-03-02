<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleCart\Adder;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateSlotTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateTransfer;
use Generated\Shared\Transfer\ConfiguredBundleItemTransfer;
use Generated\Shared\Transfer\ConfiguredBundleTransfer;
use Generated\Shared\Transfer\CreateConfiguredBundleRequestTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteErrorTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Spryker\Client\ConfigurableBundleCart\Dependency\Client\ConfigurableBundleCartToCartClientInterface;
use Spryker\Client\ConfigurableBundleCart\Dependency\Service\ConfigurableBundleCartToConfigurableBundleServiceInterface;

class ConfiguredBundleCartAdder implements ConfiguredBundleCartAdderInterface
{
    /**
     * @var \Spryker\Client\ConfigurableBundleCart\Dependency\Client\ConfigurableBundleCartToCartClientInterface
     */
    protected $cartClient;

    /**
     * @var \Spryker\Client\ConfigurableBundleCart\Dependency\Service\ConfigurableBundleCartToConfigurableBundleServiceInterface
     */
    protected ConfigurableBundleCartToConfigurableBundleServiceInterface $configurableBundleService;

    public function __construct(
        ConfigurableBundleCartToCartClientInterface $cartClient,
        ConfigurableBundleCartToConfigurableBundleServiceInterface $configurableBundleService
    ) {
        $this->cartClient = $cartClient;
        $this->configurableBundleService = $configurableBundleService;
    }

    public function addConfiguredBundleToCart(CreateConfiguredBundleRequestTransfer $createConfiguredBundleRequestTransfer): QuoteResponseTransfer
    {
        $createConfiguredBundleRequestTransfer
            ->requireItems()
            ->requireConfiguredBundle()
            ->getConfiguredBundle()
                ->requireTemplate()
                ->getTemplate()
                    ->requireUuid();

        $cartChangeTransfer = $this->mapCreateConfiguredBundleRequestTransferToCartChangeTransfer(
            $createConfiguredBundleRequestTransfer,
            new CartChangeTransfer(),
        );

        return $this->cartClient->addToCart($cartChangeTransfer);
    }

    protected function mapCreateConfiguredBundleRequestTransferToCartChangeTransfer(
        CreateConfiguredBundleRequestTransfer $createConfiguredBundleRequestTransfer,
        CartChangeTransfer $cartChangeTransfer
    ): CartChangeTransfer {
        $configuredBundleTransfer = $this->getSlimConfiguredBundleTransfer($createConfiguredBundleRequestTransfer->getConfiguredBundle());

        foreach ($createConfiguredBundleRequestTransfer->getItems() as $itemTransfer) {
            $cartChangeTransfer->addItem($this->getSlimItemTransfer($configuredBundleTransfer, $itemTransfer));
        }

        return $cartChangeTransfer;
    }

    protected function getSlimConfiguredBundleTransfer(ConfiguredBundleTransfer $configuredBundleTransfer): ConfiguredBundleTransfer
    {
        $configuredBundleTransfer
            ->requireQuantity()
            ->requireTemplate()
            ->getTemplate()
                ->requireUuid();

        $configuredBundleTransfer = $this->configurableBundleService->expandConfiguredBundleWithGroupKey($configuredBundleTransfer);

        return (new ConfiguredBundleTransfer())
            ->setGroupKey($configuredBundleTransfer->getGroupKey())
            ->setQuantity($configuredBundleTransfer->getQuantity())
            ->setTemplate(
                (new ConfigurableBundleTemplateTransfer())
                    ->setIdConfigurableBundleTemplate($configuredBundleTransfer->getTemplate()->getIdConfigurableBundleTemplate())
                    ->setUuid($configuredBundleTransfer->getTemplate()->getUuid())
                    ->setName($configuredBundleTransfer->getTemplate()->getName()),
            );
    }

    protected function getSlimItemTransfer(ConfiguredBundleTransfer $configuredBundleTransfer, ItemTransfer $itemTransfer): ItemTransfer
    {
        $itemTransfer
            ->getConfiguredBundleItem()
                ->requireSlot()
                ->getSlot()
                    ->requireUuid();

        $configuredBundleItemTransfer = (new ConfiguredBundleItemTransfer())
            ->setQuantityPerSlot($itemTransfer->getConfiguredBundleItem()->getQuantityPerSlot())
            ->setSlot(
                (new ConfigurableBundleTemplateSlotTransfer())
                    ->setUuid($itemTransfer->getConfiguredBundleItem()->getSlot()->getUuid()),
            );

        $itemTransfer
            ->setConfiguredBundle($configuredBundleTransfer)
            ->setConfiguredBundleItem($configuredBundleItemTransfer);

        return $itemTransfer;
    }

    protected function createErrorResponse(string $message): QuoteResponseTransfer
    {
        $quoteErrorTransfer = (new QuoteErrorTransfer())
            ->setMessage($message);

        return (new QuoteResponseTransfer())
            ->addError($quoteErrorTransfer);
    }
}
