<?php

namespace Scandiweb\Popup\Controller\Adminhtml\Popup;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Controller for Creating Popups.
 */
class NewAction extends Action
{
    /**
     * Execute Creating new popup
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute(): ResultInterface
    {
        return  $this->resultFactory->create(ResultFactory::TYPE_FORWARD)->forward('edit');
    }
}
