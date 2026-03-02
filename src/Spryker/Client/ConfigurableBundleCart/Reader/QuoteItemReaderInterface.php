<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleCart\Reader;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\UpdateConfiguredBundleRequestTransfer;

interface QuoteItemReaderInterface
{
    public function getItemsByConfiguredBundleGroupKey(UpdateConfiguredBundleRequestTransfer $updateConfiguredBundleRequestTransfer): CartChangeTransfer;
}
