<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleCart\Business\Checker;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;

interface ConfiguredBundleTemplateSlotCheckerInterface
{
    public function checkConfiguredBundleTemplateSlotCombination(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer;
}
