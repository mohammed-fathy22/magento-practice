<?php

namespace Scandiweb\Popup\Controller\Adminhtml\Popup;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Scandiweb\Popup\Api\PopupRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Controller for inline editing Popups.
 */
class InlineEdit extends Action
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
     * InlineEdit constructor.
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
     * Execute inline edit and return grid view.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $items = $this->getRequest()->getParam('items', []);
        $messages = [];
        $error = true;
        if (empty($items)) {
            $messages[] = __('Please correct the data sent.');
            $error = true;
        } else {
            $error = false;
            foreach ($items as $id => $data) {
                try {
                    $popup = $this->popupRepository->getById((int)$id);
                    $popup->addData(array_merge($popup->getData(), $data));
                    $this->popupRepository->save($popup);
                } catch (NoSuchEntityException | CouldNotSaveException $e) {
                    $messages[] = __('Error saving popup ID %1: %2', $id, $e->getMessage());
                    $error = true;
                }
            }
            if (!$error) {
                $messages[] = __('All changes have been saved.');
            }
        }
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)
            ->setData(['messages' => $messages, 'error' => $error]);
    }
}
