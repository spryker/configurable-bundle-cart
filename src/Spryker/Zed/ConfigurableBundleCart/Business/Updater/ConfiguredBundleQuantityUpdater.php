<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleCart\Business\Updater;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class ConfiguredBundleQuantityUpdater implements ConfiguredBundleQuantityUpdaterInterface
{
    public function updateConfiguredBundleQuantity(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if (!$this->isConfiguredBundleItem($itemTransfer)) {
                continue;
            }

            $itemTransfer->getConfiguredBundleItem()
                ->requireQuantityPerSlot();

            // For BC, when quantityPerSlot is zero, we use the item quantity.
            if (!$itemTransfer->getConfiguredBundleItem()->getQuantityPerSlot()) {
                continue;
            }

            $quantity = (int)($itemTransfer->getQuantity() / $itemTransfer->getConfiguredBundleItem()->getQuantityPerSlot());
            $itemTransfer->getConfiguredBundle()->setQuantity($quantity);
        }

        return $quoteTransfer;
    }

    public function updateConfiguredBundleQuantityPerSlot(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            if (!$this->isConfiguredBundleItem($itemTransfer)) {
                continue;
            }

            $itemTransfer->getConfiguredBundle()
                ->requireQuantity();

            $quantityPerSlot = (int)($itemTransfer->getQuantity() / $itemTransfer->getConfiguredBundle()->getQuantity());
            $itemTransfer->getConfiguredBundleItem()->setQuantityPerSlot($quantityPerSlot);
        }

        return $quoteTransfer;
    }

    protected function isConfiguredBundleItem(ItemTransfer $itemTransfer): bool
    {
        return $itemTransfer->getConfiguredBundleItem() && $itemTransfer->getConfiguredBundle();
    }
}
