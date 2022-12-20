<?php
namespace Mageget\Slider\Block\Adminhtml\Grid\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
        
    /**
     * __construct
     *
     * @param  mixed $context
     * @param  mixed $registry
     * @param  mixed $formFactory
     * @param  mixed $wysiwygConfig
     * @param  mixed $options
     * @param  mixed $data
     * @return void
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Mageget\Slider\Model\Status $options,
        array $data = []
    ) {
        $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }
      
    /**
     * _prepareForm
     *
     * @return void
     */
    protected function _prepareForm()
    {
     
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
            $form = $this->_formFactory->create(
                ['data' => [
                                'id' => 'edit_form',
                                'enctype' => 'multipart/form-data',
                                'action' => $this->getData('action'),
                                'method' => 'post'
                            ]
                ]
            );
            $form->setHtmlIdPrefix('magegrid_');
        if ($model->getBannerId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('banner_id', 'hidden', ['name' => 'banner_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }
            $fieldset->addField(
                'name',
                'text',
                [
                    'name' => 'name',
                    'label' => __('Name'),
                    'id' => 'name',
                    'title' => __('Name'),
                    'class' => 'required-entry',
                    'required' => true,
                ]
            );
            $fieldset->addField(
                'title',
                'text',
                [
                    'name' => 'title',
                    'label' => __('Title'),
                    'id' => 'title',
                    'title' => __('Title'),
                    'class' => 'required-entry',
                    'required' => true,
                ]
            );
        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);
        $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'label' => __('Content'),
                'style' => 'height:36em;',
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );
        $fieldset->addField(
            'image',
            'file',
            [
                'name' => 'image',
                'label' => __('Image'),
                'title' => __('Image'),
            ],
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
