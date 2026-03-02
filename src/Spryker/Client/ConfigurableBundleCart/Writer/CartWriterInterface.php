<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleCart\Writer;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\UpdateConfiguredBundleRequestTransfer;

interface CartWriterInterface
{
    public function removeConfiguredBundle(UpdateConfiguredBundleRequestTransfer $updateConfiguredBundleRequestTransfer): QuoteResponseTransfer;

    public function updateConfiguredBundleQuantity(UpdateConfiguredBundleRequestTransfer $updateConfiguredBundleRequestTransfer): QuoteResponseTransfer;
}
