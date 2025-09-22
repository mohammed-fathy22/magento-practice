<?php

namespace Scandiweb\Popup\Controller\Adminhtml\Popup;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Scandiweb\Popup\Model\ResourceModel\Popup\CollectionFactory;

/**
 * Controller for mass disabling Popups.
 */
class MassDisable extends Action
{
    /**
     * MassDisable constructor.
     *
     * @param Action\Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Action\Context $context,
        protected \Magento\Ui\Component\MassAction\Filter $filter,
        protected CollectionFactory $popupCollectionFactory
    ) {
        parent::__construct($context);
    }

    /**
     * Execute mass disable and return grid view.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->popupCollectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $popup) {
            try {
                $popup->setIsActive(0);
                $popup->save();
            } catch (NoSuchEntityException | CouldNotSaveException $e) {
                $this->messageManager->addErrorMessage(
                    __('Error disabling popup ID %1: %2', $popup->getId(), $e->getMessage())
                );
            }
        }

        $this->messageManager->addSuccessMessage(
            __(
                'A total of %1 record(s) have been disabled.',
                $collectionSize
            )
        );

        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $result->setPath('scandiweb_popup/popup/index');
    }
}
