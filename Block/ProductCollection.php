<?php
namespace Mageget\Slider\Block;

use Magento\Framework\UrlInterface;

class ProductCollection extends \Magento\Framework\View\Element\Template
{
    /**
     * _productCollectionFactory $_productCollectionFactory
     *
     * @var mixed
     */
    protected $_productCollectionFactory;
            
    /**
     * __construct
     *
     * @param mixed $context
     * @param mixed $productCollectionFactory
     * @param mixed $storeManager
     * @param mixed $url
     * @param mixed $data
     * @return void
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        UrlInterface $url,
        array $data = []
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
        $this->storeManager = $storeManager;
        $this->_url = $url;
    }
        
    /**
     * Get Product Collection
     *
     * @return void
     */
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(24); // fetching only 3 products
        return $collection;
    }
    /**
     * Get media url
     *
     * @return void
     */
    public function mediaurl()
    {
        return $mediaUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }
}
