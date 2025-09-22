<?php

namespace Scandiweb\Popup\Controller\Adminhtml\Popup;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Scandiweb\Popup\Api\PopupRepositoryInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Controller for deleting Popups.
 */
class Delete extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var PopupRepositoryInterface
     */
    protected $popupRepository;

    /**
     * MassDelete constructor.
     *
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param PopupRepositoryInterface $popupRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        PopupRepositoryInterface $popupRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->popupRepository = $popupRepository;
    }

    /**
     * Execute mass delete and return grid view.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('popup_id', 0);
        try {
            $popup = $this->popupRepository->getById((int)$id);
            if (!$popup->getPopupId()) {
                $this->messageManager->addWarningMessage(
                    __('Popup with ID %1 does not exist.', $id)
                );
            } else {
                $this->popupRepository->delete($popup);
                $this->messageManager->addSuccessMessage(
                    __('Popup with ID %1 has been deleted.', $id)
                );
            }
        } catch (NoSuchEntityException | CouldNotDeleteException $e) {
            // Optionally log error
        }

        $result = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $result->setPath('scandiweb_popup/popup/index');
    }
}
