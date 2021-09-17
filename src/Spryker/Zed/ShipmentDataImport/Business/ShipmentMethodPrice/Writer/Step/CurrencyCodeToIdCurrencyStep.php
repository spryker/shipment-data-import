<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\ShipmentDataImport\Business\ShipmentMethodPrice\Writer\Step;

use Orm\Zed\Currency\Persistence\SpyCurrencyQuery;
use Spryker\Zed\DataImport\Business\Exception\DataKeyNotFoundInDataSetException;
use Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\ShipmentDataImport\Business\ShipmentMethodPrice\Writer\DataSet\ShipmentMethodPriceDataSetInterface;

class CurrencyCodeToIdCurrencyStep implements DataImportStepInterface
{
    /**
     * @var array<int>
     */
    protected static $idCurrencyCache = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException
     * @throws \Spryker\Zed\DataImport\Business\Exception\DataKeyNotFoundInDataSetException
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $currencyCode = $dataSet[ShipmentMethodPriceDataSetInterface::COL_CURRENCY_NAME];

        if (!$currencyCode) {
            throw new DataKeyNotFoundInDataSetException('Currency ISO code is missing');
        }

        if (!isset(static::$idCurrencyCache[$currencyCode])) {
            $currencyEntity = SpyCurrencyQuery::create()
                ->filterByCode($currencyCode)
                ->findOne();

            if ($currencyEntity === null) {
                throw new EntityNotFoundException(sprintf('Currency not found: %s', $currencyCode));
            }

            static::$idCurrencyCache[$currencyCode] = $currencyEntity->getIdCurrency();
        }

        $dataSet[ShipmentMethodPriceDataSetInterface::COL_ID_CURRENCY] = static::$idCurrencyCache[$currencyCode];
    }
}
