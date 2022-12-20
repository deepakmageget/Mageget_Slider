<?php
namespace Mageget\Slider\Block;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class GetBanner extends \Magento\Framework\View\Element\Template
{
    /**
     * _getbanner $_getbanner
     *
     * @var mixed
     */
    protected $_getbanner;
    /**
     * _bannerCollection $_bannerCollectio
     *
     * @var mixed
     */
    protected $_bannerCollection;
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
     * @param mixed $context
     * @param mixed $bannerCollection
     * @param mixed $storeManager
     * @param mixed $url
     * @param mixed $data
     * @return void
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Mageget\Slider\Model\ResourceModel\Banner\CollectionFactory $bannerCollection,
        StoreManagerInterface $storeManager,
        UrlInterface $url,
        array $data = []
    ) {
        $this->_bannerCollection = $bannerCollection;
        $this->_storeManager = $storeManager;
        $this->_url = $url;
        parent::__construct($context, $data);
    }
    
    /**
     * Get Banners
     *
     * @return void
     */
    public function getBanners()
    {
        if (empty($this->_getbanner)) {
            $this->_getbanner = $this->_bannerCollection->create();
        }
       
        return $this->_getbanner;
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
