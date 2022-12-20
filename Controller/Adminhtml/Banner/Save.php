<?php
namespace Mageget\Slider\Controller\Adminhtml\Banner;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;

class Save extends \Magento\Backend\App\Action
{
    // var $gridFactory;
    
    /**
     * uploaderFactory $uploaderFactory
     *
     * @var mixed
     */
    protected $uploaderFactory;
    
    /**
     * adapterFactory $adapterFactory
     *
     * @var mixed
     */
    protected $adapterFactory;
    
    /**
     * filesystem $filesystem
     *
     * @var mixed
     */
    protected $filesystem;
    
    /**
     * _redirect $_resultRedirectFactory
     *
     * @var mixed
     */
    protected $_resultRedirectFactory;

    /**
     * __construct
     *
     * @param mixed $context
     * @param mixed $gridFactory
     * @param mixed $uploaderFactory
     * @param mixed $adapterFactory
     * @param mixed $filesystem
     * @param mixed $redirect
     * @return void
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Mageget\Slider\Model\BannerFactory $gridFactory,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem,
        \Magento\Backend\Model\View\Result\Redirect $redirect
    ) {
        parent::__construct($context);
        $this->gridFactory = $gridFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->_resultRedirectFactory = $redirect;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(
            \Magento\Framework\App\Filesystem\DirectoryList::MEDIA
        );
    }
    
    /**
     * Execute
     *
     * @return void
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            // $this->_redirect("managebanner/banner/banner");
            // return;
            return $resultRedirect->setPath('managebanner/banner/banner');
        }
        try {
            $rowData = $this->gridFactory->create();

            $files = $this->getRequest()->getFiles("file");
            $target = $this->_mediaDirectory->getAbsolutePath(
                "mageget_slider/"
            );
            //attachment is the input file name posted from your form
            $uploader = $this->uploaderFactory->create(["fileId" => "image"]);
            $_fileType = $uploader->getFileExtension();
            $uniqid = uniqid();
            $newFileName = $uniqid . "." . $_fileType;
            $uploader->setAllowedExtensions(["jpg", "jpeg", "png"]);

            $uploader->setAllowRenameFiles(true);

            $result = $uploader->save($target, $newFileName);

            $data["image"] = $newFileName;

            $rowData->setData($data);

            if (isset($data["banner_id"])) {
                $rowData->setEntityId($data["banner_id"]);
            }

            $rowData->save();
            $this->messageManager->addSuccess(
                __("Banner has been successfully Added.")
            );
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $resultRedirect->setPath('managebanner/banner');
    }
}
