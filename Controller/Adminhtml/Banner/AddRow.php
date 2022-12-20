<?php
namespace Mageget\Slider\Controller\Adminhtml\Banner;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
        
    /**
     * coreRegistry $coreRegistry
     *
     * @var mixed
     */
    private $coreRegistry;
      
    /**
     * gridFactory $gridFactory
     *
     * @var mixed
     */
    private $gridFactory;
    /**
     * _redirect $_resultRedirectFactory
     *
     * @var mixed
     */
    protected $_resultRedirectFactory;
        
    /**
     * __construct
     *
     * @param mixed $context
     * @param mixed $coreRegistry
     * @param mixed $gridFactory
     * @param mixed $redirect
     * @return void
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Mageget\Slider\Model\BannerFactory $gridFactory,
        \Magento\Backend\Model\View\Result\Redirect $redirect
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->gridFactory = $gridFactory;
        $this->_resultRedirectFactory = $redirect;
    }
        
    /**
     * Execute
     *
     * @return void
     */
    public function execute()
    {
         $resultRedirect = $this->resultRedirectFactory->create();
         $rowId = (int) $this->getRequest()->getParam('banner_id');
         $rowData = $this->gridFactory->create();
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowName = $rowData->getName();
            if (!$rowData->getEntityId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
            //    $this->_redirect('enquire/grid/rowdata');
            //    return;
                return $resultRedirect->setPath('enquire/grid/rowdataa');
            }
        }
        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Row Data ').$rowName : __('Add Row Data');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
}
