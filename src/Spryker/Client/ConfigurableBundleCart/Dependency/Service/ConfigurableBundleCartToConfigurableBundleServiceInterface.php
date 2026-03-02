<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleCart\Dependency\Service;

use Generated\Shared\Transfer\ConfiguredBundleTransfer;

interface ConfigurableBundleCartToConfigurableBundleServiceInterface
{
    public function expandConfiguredBundleWithGroupKey(ConfiguredBundleTransfer $configuredBundleTransfer): ConfiguredBundleTransfer;
}
