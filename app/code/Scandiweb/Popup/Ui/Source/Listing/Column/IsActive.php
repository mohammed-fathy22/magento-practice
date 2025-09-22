<?php

declare(strict_types=1);

namespace Scandiweb\Popup\Ui\Source\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Source model for IsActive status options.
 */
class IsActive implements OptionSourceInterface
{
    protected const STATUS_ENABLED = 1;
    protected const STATUS_DISABLED = 0;

    /**
     * Retrieve option array for status.
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::STATUS_ENABLED, 'label' => __('Enabled')],
            ['value' => self::STATUS_DISABLED, 'label' => __('Disabled')],
        ];
    }
}
