<?php
namespace Scandiweb\Popup\Controller\Adminhtml\Popup\MassDelete;

/**
 * Interceptor class for @see \Scandiweb\Popup\Controller\Adminhtml\Popup\MassDelete
 */
class Interceptor extends \Scandiweb\Popup\Controller\Adminhtml\Popup\MassDelete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Scandiweb\Popup\Api\PopupRepositoryInterface $popupRepository)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $popupRepository);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
