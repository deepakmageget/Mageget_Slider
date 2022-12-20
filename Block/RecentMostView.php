<?php

namespace Mageget\Slider\Block;

use Magento\Framework\UrlInterface;

class RecentMostView extends \Magento\Framework\View\Element\Template
{
    
    /**
     * _url $_url
     *
     * @var mixed
     */
    protected $_url;
    /**
     * __construct
     *
     * @param mixed $reportCollectionFactory
     * @param mixed $storeManager
     * @param mixed $url
     * @return void
     */
    public function __construct(
        \Magento\Reports\Model\ResourceModel\Product\CollectionFactory $reportCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        UrlInterface $url
    ) {
        $this->reportCollectionFactory = $reportCollectionFactory;
        $this->storeManager = $storeManager;
        $this->_url = $url;
    }
    
    /**
     * Get Most Viewed Products
     *
     * @return void
     */
    public function getMostViewedProducts()
    {
        $storeId =  $this->storeManager->getStore()->getId();
        $collection = $this->reportCollectionFactory->create()
            ->addAttributeToSelect(
                '*'
            )->addViewsCount()->setStoreId(
                $storeId
            )->addStoreFilter(
                $storeId
            );
        $items = $collection->getItems();
        return $items;
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
