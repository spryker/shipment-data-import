<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\ShipmentDataImport\Communication\Plugin;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ShipmentDataImport\ShipmentDataImportConfig;

/**
 * @method \Spryker\Zed\ShipmentDataImport\Business\ShipmentDataImportFacadeInterface getFacade()
 * @method \Spryker\Zed\ShipmentDataImport\ShipmentDataImportConfig getConfig()
 */
class ShipmentMethodStoreDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    /**
     * {@inheritDoc}
     * - Imports shipment method store data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer
    {
        return $this->getFacade()->importShipmentMethodStore($dataImporterConfigurationTransfer);
    }

    /**
     * {@inheritDoc}
     * - Returns the name of shipment store DataImporter.
     *
     * @api
     *
     * @return string
     */
    public function getImportType(): string
    {
        return ShipmentDataImportConfig::IMPORT_TYPE_SHIPMENT_METHOD_STORE;
    }
}
