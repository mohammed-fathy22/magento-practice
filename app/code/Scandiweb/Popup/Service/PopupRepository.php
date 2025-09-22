<?php

declare(strict_types=1);

namespace Scandiweb\Popup\Service;

use Scandiweb\Popup\Api\PopupRepositoryInterface;
use Scandiweb\Popup\Api\Data\PopupInterface;
use Scandiweb\Popup\Model\PopupFactory;
use Scandiweb\Popup\Model\ResourceModel\Popup as PopupResource;
use Scandiweb\Popup\Model\ResourceModel\Popup\CollectionFactory as PopupCollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;

class PopupRepository implements PopupRepositoryInterface
{
    /**
     * @var PopupFactory
     */
    protected $popupFactory;

    /**
     * @var PopupResource
     */
    protected $popupResource;

    /**
     * @var PopupCollectionFactory
     */
    protected $popupCollectionFactory;

    /**
     * PopupRepository constructor.
     *
     * @param PopupFactory $popupFactory
     * @param PopupResource $popupResource
     */
    public function __construct(
        PopupFactory $popupFactory,
        PopupResource $popupResource,
    ) {
        $this->popupFactory = $popupFactory;
        $this->popupResource = $popupResource;
    }

    /**
     * Save Popup.
     *
     * @param PopupInterface $popup
     * @return PopupInterface
     * @throws CouldNotSaveException
     */
    public function save(PopupInterface $popup): PopupInterface
    {
        try {
            $this->popupResource->save($popup);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save the popup: %1', $e->getMessage()));
        }
        return $popup;
    }

    /**
     * Get Popup by ID.
     *
     * @param int $popupId
     * @return PopupInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $popupId): PopupInterface
    {
        $popup = $this->popupFactory->create();
        $this->popupResource->load($popup, $popupId);
        if (!$popup->getId()) {
            throw new NoSuchEntityException(__('Popup with id "%1" does not exist.', $popupId));
        }
        return $popup;
    }

    /**
     * Delete Popup.
     *
     * @param  PopupInterface $popup
     * @throws LocalizedException 
     */    public function delete(PopupInterface $popup)
    {
        try {
            $this->popupResource->delete($popup);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete the popup: %1', $e->getMessage()));
        }
    }
}
