<?php

namespace Mageget\Slider\Controller\Adminhtml\Banner;

class Index extends \Magento\Backend\App\Action
{
    /**
     * _resultPageFactory $_resultPageFactor
     *
     * @var mixed
     */
    protected $_resultPageFactory;
    
    /**
     * __construct
     *
     * @param mixed $context
     * @param mixed $resultPageFactory
     * @return void
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }
    
    /**
     * Execute
     *
     * @return void
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage
            ->getConfig()
            ->getTitle()
            ->prepend(__("Manage Banners"));
        return $resultPage;
    }
}
