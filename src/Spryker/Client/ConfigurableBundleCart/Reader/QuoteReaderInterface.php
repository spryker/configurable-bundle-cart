<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleCart\Reader;

use ArrayObject;
use Generated\Shared\Transfer\QuoteTransfer;

interface QuoteReaderInterface
{
    /**
     * @param string $configuredBundleGroupKey
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[]
     */
    public function getItemsByConfiguredBundleGroupKey(string $configuredBundleGroupKey, QuoteTransfer $quoteTransfer): ArrayObject;
}
