<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\ConfigurableBundleCart;

use Generated\Shared\Transfer\ConfiguredBundleTransfer;

interface ConfigurableBundleCartServiceInterface
{
    /**
     * Specification:
     * - Expects template uuid to be provided.
     * - Expands provided ConfiguredBundleTransfer with group key.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ConfiguredBundleTransfer $configuredBundleTransfer
     *
     * @return \Generated\Shared\Transfer\ConfiguredBundleTransfer
     */
    public function expandConfiguredBundleWithGroupKey(ConfiguredBundleTransfer $configuredBundleTransfer): ConfiguredBundleTransfer;
}
