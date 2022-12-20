<?php

namespace Mageget\Slider\Controller\Adminhtml\Banner;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level
     *
     * @see _isAllowed()
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed("Mageget_Slider::delete");
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam("banner_id");

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                // init model and delete
                $model = $this->_objectManager->create(
                    \Mageget\Slider\Model\Banner::class
                );
                $model->load($id);
                $title = $model->getName();
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(
                    __("The row has been deleted.")
                );
                // go to grid
                $this->_eventManager->dispatch("slider_banner_on_delete", [
                    "title" => $title,
                    "status" => "success",
                ]);
                return $resultRedirect->setPath("*/*/");
            } catch (\Exception $e) {
                $this->_eventManager->dispatch("adminhtml_grid_on_delete", [
                    "title" => $title,
                    "status" => "fail",
                ]);
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath("*/*/edit", [
                    "banner_id" => $id,
                ]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a news to delete.'));
        // go to grid
        return $resultRedirect->setPath("*/*/");
    }
}
