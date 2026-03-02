<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleCart\Updater;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\UpdateConfiguredBundleRequestTransfer;
use Spryker\Client\ConfigurableBundleCart\Reader\QuoteItemReaderInterface;

class QuoteItemUpdater implements QuoteItemUpdaterInterface
{
    /**
     * @var \Spryker\Client\ConfigurableBundleCart\Reader\QuoteItemReaderInterface
     */
    protected $quoteItemReader;

    public function __construct(QuoteItemReaderInterface $quoteItemReader)
    {
        $this->quoteItemReader = $quoteItemReader;
    }

    public function changeQuantity(UpdateConfiguredBundleRequestTransfer $updateConfiguredBundleRequestTransfer): CartChangeTransfer
    {
        $updateConfiguredBundleRequestTransfer->requireQuantity();

        $updatedCartChangeTransfer = new CartChangeTransfer();
        $cartChangeTransfer = $this->quoteItemReader->getItemsByConfiguredBundleGroupKey($updateConfiguredBundleRequestTransfer);

        foreach ($cartChangeTransfer->getItems() as $itemTransfer) {
            $itemTransfer
                ->requireConfiguredBundleItem()
                ->getConfiguredBundleItem()
                    ->requireQuantityPerSlot();

            $itemTransferToUpdate = (new ItemTransfer())
                ->fromArray($itemTransfer->toArray(false))
                ->setQuantity($itemTransfer->getConfiguredBundleItem()->getQuantityPerSlot() * $updateConfiguredBundleRequestTransfer->getQuantity());

            $updatedCartChangeTransfer->getItems()->append($itemTransferToUpdate);
        }

        return $updatedCartChangeTransfer;
    }
}
