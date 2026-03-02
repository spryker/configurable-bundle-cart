<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleCart\Business\Checker;

use Generated\Shared\Transfer\QuoteTransfer;

interface ConfiguredBundleQuantityCheckerInterface
{
    public function checkConfiguredBundleQuantity(QuoteTransfer $quoteTransfer): bool;
}
