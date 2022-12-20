<?php
namespace Mageget\slider\Model;

use Magento\Cron\Exception;
use Magento\Framework\Model\AbstractModel;

class Banner extends AbstractModel
{
      
    /**
     * _dateTime $_dateTime
     *
     * @var mixed
     */
    protected $_dateTime;
    
    /**
     * _construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Mageget\slider\Model\ResourceModel\Banner::class);
    }
}
