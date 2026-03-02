<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleCart\Business;

use Spryker\Zed\ConfigurableBundleCart\Business\Checker\ConfiguredBundleQuantityChecker;
use Spryker\Zed\ConfigurableBundleCart\Business\Checker\ConfiguredBundleQuantityCheckerInterface;
use Spryker\Zed\ConfigurableBundleCart\Business\Checker\ConfiguredBundleTemplateSlotChecker;
use Spryker\Zed\ConfigurableBundleCart\Business\Checker\ConfiguredBundleTemplateSlotCheckerInterface;
use Spryker\Zed\ConfigurableBundleCart\Business\Expander\ConfiguredBundleGroupKeyExpander;
use Spryker\Zed\ConfigurableBundleCart\Business\Expander\ConfiguredBundleGroupKeyExpanderInterface;
use Spryker\Zed\ConfigurableBundleCart\Business\Expander\ConfiguredBundleQuantityExpander;
use Spryker\Zed\ConfigurableBundleCart\Business\Expander\ConfiguredBundleQuantityExpanderInterface;
use Spryker\Zed\ConfigurableBundleCart\Business\Updater\ConfiguredBundleQuantityUpdater;
use Spryker\Zed\ConfigurableBundleCart\Business\Updater\ConfiguredBundleQuantityUpdaterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Spryker\Zed\ConfigurableBundleCart\ConfigurableBundleCartConfig getConfig()
 * @method \Spryker\Zed\ConfigurableBundleCart\Persistence\ConfigurableBundleCartRepositoryInterface getRepository()
 */
class ConfigurableBundleCartBusinessFactory extends AbstractBusinessFactory
{
    public function createConfiguredBundleQuantityUpdater(): ConfiguredBundleQuantityUpdaterInterface
    {
        return new ConfiguredBundleQuantityUpdater();
    }

    public function createConfiguredBundleQuantityChecker(): ConfiguredBundleQuantityCheckerInterface
    {
        return new ConfiguredBundleQuantityChecker();
    }

    public function createConfiguredBundleQuantityExpander(): ConfiguredBundleQuantityExpanderInterface
    {
        return new ConfiguredBundleQuantityExpander();
    }

    public function createConfiguredBundleGroupKeyExpander(): ConfiguredBundleGroupKeyExpanderInterface
    {
        return new ConfiguredBundleGroupKeyExpander();
    }

    public function createConfiguredBundleTemplateSlotChecker(): ConfiguredBundleTemplateSlotCheckerInterface
    {
        return new ConfiguredBundleTemplateSlotChecker(
            $this->getRepository(),
        );
    }
}
