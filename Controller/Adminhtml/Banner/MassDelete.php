<?php

namespace Mageget\Slider\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Mageget\Slider\Model\ResourceModel\Banner\CollectionFactory;

class MassDelete extends Action
{
    /**
     * collectionFactory $collectionFactory
     *
     * @var mixed
     */
    public $collectionFactory;
    
    /**
     * filter $filter
     *
     * @var mixed
     */
    public $filter;
    
    /**
     * __construct
     *
     * @param mixed $context
     * @param mixed $filter
     * @param mixed $collectionFactory
     * @param mixed $documentFactory
     * @return void
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        \Mageget\Slider\Model\BannerFactory $documentFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->documentFactory = $documentFactory;
        parent::__construct($context);
    }
    
    /**
     * Execute
     *
     * @return void
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection(
                $this->collectionFactory->create()
            );

            $count = 0;
            foreach ($collection as $model) {
                $model = $this->documentFactory
                    ->create()
                    ->load($model->getId());
                $model->delete();
                $count++;
            }
            $this->messageManager->addSuccess(
                __("A total of %1 rows have been deleted.", $count)
            );
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory
            ->create(ResultFactory::TYPE_REDIRECT)
            ->setPath("managebanner/banner/index");
    }
    
    /**
     * _isAllowed
     *
     * @return void
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed("Mageget_Slider::delete");
    }
}
