<?php
namespace Mageget\Slider\Ui\Component\Listing\Grid\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Image extends Column
{
    public const URL_PATH_EDIT = "managebanner/banner/addrow";
    
    /**
     * storeManager $storeManager
     *
     * @var mixed
     */
    protected $storeManager;
    
    /**
     * url  $url
     *
     * @var mixed
     */
    protected $url;
    
    /**
     * __construct
     *
     * @param mixed $context
     * @param mixed $uiComponentFactory
     * @param mixed $storeManager
     * @param mixed $url
     * @param mixed $components
     * @param mixed $data
     * @return void
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        UrlInterface $url,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManager = $storeManager;
        $this->url = $url;
    }
    
    /**
     * Prepare Data Source
     *
     * @param  mixed $dataSource
     * @return void
     */
    public function prepareDataSource(array $dataSource)
    {
        $mediaUrl = $this->storeManager
            ->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

        if (isset($dataSource["data"]["items"])) {
            $fieldName = "image";
            foreach ($dataSource["data"]["items"] as &$item) {
                if (!empty($item["image"])) {
                    $name = $item["image"];
                    $item[$fieldName . "_src"] =
                        $mediaUrl . "mageget_slider/" . $name;
                    $item[$fieldName . "_alt"] = "";
                    $item[$fieldName . "_link"] = $this->url->getUrl(
                        static::URL_PATH_EDIT,
                        [
                            "id" => $item["banner_id"],
                        ]
                    );
                    $item[$fieldName . "_orig_src"] =
                        $mediaUrl . "mageget_slider/" . $name;
                }
            }
        }
        return $dataSource;
    }
}
