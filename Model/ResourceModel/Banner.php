<?php

namespace Mageget\Slider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Banner extends AbstractDb
{
    /**
     * _construct
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init("mageget_banner", "banner_id");
    }
}
