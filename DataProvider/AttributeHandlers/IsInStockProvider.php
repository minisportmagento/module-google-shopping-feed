<?php

namespace Minisport\GoogleShoppingFeed\DataProvider\AttributeHandlers;

use Magento\Catalog\Model\Product;
use Minisport\GoogleShoppingFeed\Model\Stock;
use RunAsRoot\GoogleShoppingFeed\DataProvider\AttributeHandlers\AttributeHandlerInterface;
use RunAsRoot\GoogleShoppingFeed\Enum\GoogleShoppingAviabilityEnumInterface;

class IsInStockProvider implements AttributeHandlerInterface
{
    /**
     * @var Stock
     */
    private $stock;

    /**
     * @param Stock $stock [description]
     */
    public function __construct(
        Stock $stock
    ) {
        $this->stock = $stock;
    }

    public function get(Product $product): string
    {
        if (!$this->stock->isInStock($product)) {
            return GoogleShoppingAviabilityEnumInterface::OUT_OF_STOCK;
        }

        if ($this->stock->isManageStock($product)) {
            // Manage stock enabled
            if ($this->stock->getQty($product, 'max') <= 0) {
                // Product qty is 0 or less
                if (!$this->stock->getIsBackorders($product)) {
                    // No backorders
                    return GoogleShoppingAviabilityEnumInterface::OUT_OF_STOCK;
                }
            }
        }

        return GoogleShoppingAviabilityEnumInterface::IN_STOCK;
    }
}
