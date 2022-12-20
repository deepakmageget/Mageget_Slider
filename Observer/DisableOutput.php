<?php
namespace Mageget\Slider\Observer;

class DisableOutput implements \Magento\Framework\Event\ObserverInterface
{
    public const VENDOR_CONFIG = "slider/general/enable";
    
    /**
     * _config $_config
     *
     * @var mixed
     */
    protected $_config;
    
    /**
     * _scopeConfig $_scopeConfig
     *
     * @var mixed
     */
    protected $_scopeConfig;
    
    /**
     * storeManager $storeManager
     *
     * @var mixed
     */
    protected $storeManager;
    
    /**
     * __construct
     *
     * @param mixed $_config
     * @param mixed $_scopeConfig
     * @param mixed $storeManager
     * @param mixed $request
     * @return void
     */
    public function __construct(
        \Magento\Config\Model\ResourceModel\Config $_config,
        \Magento\Framework\App\Config\ScopeConfigInterface $_scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->_config = $_config;
        $this->_scopeConfig = $_scopeConfig;
        $this->storeManager = $storeManager;
        $this->request = $request;
    }
    
    /**
     * Execute
     *
     * @param  mixed $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $disable = false;
        $scopeType =
            \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT;
        $scopeCode = 0;
        if ($this->request->getParam(
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        )
        ) {
            $scopeType = ScopeInterface::SCOPE_STORE;
            $scopeCode = $this->storeManager
                ->getStore(
                    $this->request->getParam(
                        \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                    )
                )
                ->getCode();
        } elseif ($this->request->getParam(
            \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE
        )
        ) {
            $scopeType = ScopeInterface::SCOPE_WEBSITE;
            $scopeCode = $this->storeManager
                ->getWebsite(
                    $this->request->getParam(
                        \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE
                    )
                )
                ->getCode();
        } else {
            $scopeType =
                \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT;
            $scopeCode = 0;
        }
        $moduleConfig = $this->_scopeConfig->getValue(
            self::VENDOR_CONFIG,
            $scopeType
        );

        if ((int) $moduleConfig == 0) {
            $disable = true;
        }

        $moduleName = "Mageget_Slider";
        $outputPath = "advanced/modules_disable_output/$moduleName";

        $this->_config->saveConfig(
            $outputPath,
            $disable,
            $scopeType,
            $scopeCode
        );
    }
}
