<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\ConfigurableBundleCart\Expander;

use Generated\Shared\Transfer\ConfiguredBundleTransfer;

/**
 * @deprecated Will be removed in the next major without replacement.
 */
interface ConfiguredBundleGroupKeyExpanderInterface
{
    public function expandConfiguredBundleWithGroupKey(ConfiguredBundleTransfer $configuredBundleTransfer): ConfiguredBundleTransfer;
}
