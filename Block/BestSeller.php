<?php
namespace Mageget\Slider\Block;

use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory as BestSellersCollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class BestSeller extends Template
{
    /**
     * _bestSellersCollectionFactory $_bestSellersCollectionFactor
     *
     * @var mixed
     */
    protected $_bestSellersCollectionFactory;
    /**
     * _productCollectionFactory $_productCollectionFactory
     *
     * @var mixed
     */
    protected $_productCollectionFactory;
    /**
     * _storeManager $_storeManager
     *
     * @var mixed
     */
    protected $_storeManager;
    /**
     * _url $_url
     *
     * @var mixed
     */
    protected $_url;
    
    /**
     * __construct
     *
     * @param  mixed $context
     * @param  mixed $productCollectionFactory
     * @param  mixed $storeManager
     * @param  mixed $bestSellersCollectionFactory
     * @param  mixed $url
     * @return void
     */
    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        StoreManagerInterface $storeManager,
        BestSellersCollectionFactory $bestSellersCollectionFactory,
        UrlInterface $url,
    ) {
        $this->_bestSellersCollectionFactory = $bestSellersCollectionFactory;
        $this->_storeManager = $storeManager;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_url = $url;
        parent::__construct($context);
    }
       
    /**
     * Get Product Collection
     *
     * @return void
     */
    public function getProductCollection()
    {
        $productIds = [];
        $bestSellers = $this->_bestSellersCollectionFactory->create()
            ->setPeriod('month');
        foreach ($bestSellers as $product) {
            $productIds[] = $product->getProductId();
        }
        $collection = $this->_productCollectionFactory->create()->addIdFilter($productIds);
        $collection->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addAttributeToSelect('*')
            ->addStoreFilter($this->getStoreId())
            ->setPageSize(count($productIds));
        return $collection;
    }
    
    /**
     * Get Store Id
     *
     * @return void
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }
    /**
     * Get media url
     *
     * @return void
     */
    public function mediaurl()
    {
        return $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }
}
