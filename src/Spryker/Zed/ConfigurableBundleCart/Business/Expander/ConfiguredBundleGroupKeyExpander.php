<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleCart\Business\Expander;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\ItemTransfer;

class ConfiguredBundleGroupKeyExpander implements ConfiguredBundleGroupKeyExpanderInterface
{
    public function expandConfiguredBundleItemsWithGroupKey(CartChangeTransfer $cartChangeTransfer): CartChangeTransfer
    {
        foreach ($cartChangeTransfer->getItems() as $itemTransfer) {
            if (!$this->isItemConfiguredBundle($itemTransfer)) {
                continue;
            }

            $itemTransfer->setGroupKey(
                $this->getItemTransferConfiguredBundleGroupKey($itemTransfer),
            );
        }

        return $cartChangeTransfer;
    }

    protected function isItemConfiguredBundle(ItemTransfer $itemTransfer): bool
    {
        return $itemTransfer->getConfiguredBundle() && $itemTransfer->getConfiguredBundleItem();
    }

    protected function getItemTransferConfiguredBundleGroupKey(ItemTransfer $itemTransfer): string
    {
        $itemTransfer
            ->requireGroupKey()
            ->requireConfiguredBundle()
            ->getConfiguredBundle()
                ->requireGroupKey();

        return sprintf(
            '%s-%s',
            $itemTransfer->getConfiguredBundle()->getGroupKey(),
            $itemTransfer->getGroupKey(),
        );
    }
}
