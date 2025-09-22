<?php

declare(strict_types=1);

namespace Scandiweb\Popup\Api;

use Scandiweb\Popup\Api\Data\PopupInterface;
use Magento\Framework\Exception\LocalizedException;

interface PopupRepositoryInterface
{
    /**
     * Save Popup
     *
     * @param \Scandiweb\Popup\Api\Data\PopupInterface $popup
     * @return \Scandiweb\Popup\Api\Data\PopupInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Scandiweb\Popup\Api\Data\PopupInterface $popup): \Scandiweb\Popup\Api\Data\PopupInterface;

    /**
     * Delete Popup
     *
     * @param  PopupInterface $popup
     * @throws LocalizedException 
     */
    public function delete(PopupInterface $popup);

    /**
     * Retrieve Popup
     *
     * @param int $popupId
     * @return PopupInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $popupId): PopupInterface;
}
