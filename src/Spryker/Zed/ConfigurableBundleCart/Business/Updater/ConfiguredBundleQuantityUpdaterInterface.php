<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleCart\Business\Updater;

use Generated\Shared\Transfer\QuoteTransfer;

interface ConfiguredBundleQuantityUpdaterInterface
{
    public function updateConfiguredBundleQuantity(QuoteTransfer $quoteTransfer): QuoteTransfer;

    public function updateConfiguredBundleQuantityPerSlot(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
