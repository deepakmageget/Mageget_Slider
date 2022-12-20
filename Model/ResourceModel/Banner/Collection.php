<?php
namespace Mageget\Slider\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * _construct
     *
     * @return void
     */
    public function _construct()
    {
        // @codingStandardsIgnoreLine
        $this->_init('Mageget\Slider\Model\Banner', 'Mageget\Slider\Model\ResourceModel\Banner');
    }
}
