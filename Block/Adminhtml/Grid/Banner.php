<?php

namespace Mageget\Slider\Block\Adminhtml\Grid;

class Banner extends \Magento\Backend\Block\Widget\Form\Container
{
       
    /**
     * _coreRegistry $_coreRegistry
     *
     * @var undefined
     */
    protected $_coreRegistry = null;
      
    /**
     * __construct
     *
     * @param  mixed $context
     * @param  mixed $registry
     * @param  mixed $data
     * @return void
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
        
    /**
     * _construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'rowid';
        $this->_blockGroup = 'Mageget_Slider';
        $this->_controller = 'adminhtml_grid';
        parent::_construct();
        if ($this->_isAllowedAction('Mageget_Slider::addrow')) {
            $this->buttonList->update('save', 'label', __('Save'));
        } else {
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('reset');
    }
       
    /**
     * GetHeaderText
     *
     * @return void
     */
    public function getHeaderText()
    {
        return __('Edit RoW Data ');
    }
       
    /**
     * _isAllowedAction
     *
     * @param  mixed $resourceId
     * @return void
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
       
    /**
     * Get Form ActionUrl
     *
     * @return void
     */
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
        return $this->getUrl('*/*/save');
    }
}
