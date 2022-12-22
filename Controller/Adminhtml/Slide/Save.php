<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @author      Raivis Dejus <info@scandiweb.com>
 * @copyright   Copyright (c) 2018 Scandiweb, Ltd (https://scandiweb.com)
 */

namespace Scandiweb\Slider\Controller\Adminhtml\Slide;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\ReadInterface;
use Magento\Framework\Image\AdapterFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Scandiweb\Slider\Api\SlideRepositoryInterface;
use Scandiweb\Slider\Model\SlideFactory;
use Scandiweb\Slider\Model\Slider;

class Save extends Action
{
    /**
     * @var ReadInterface
     */
    protected $mediaDirectory;

    /**
     * @var AdapterFactory
     */
    protected $imageAdapterFactory;

    /**
     * @var UploaderFactory
     */
    protected $fileUploaderFactory;

    /**
     * @var SlideRepositoryInterface
     */
    protected $slideRepository;

    /**
     * @var SlideFactory
     */
    protected $slideFactory;

    /**
     * @param Context $context
     * @param Filesystem $filesystem
     * @param AdapterFactory $imageAdapterFactory
     * @param UploaderFactory $fileUploaderFactory
     * @param SlideRepositoryInterface $slideRepository
     * @param SlideFactory $slideFactory
     */
    public function __construct(
        Context $context,
        Filesystem $filesystem,
        AdapterFactory $imageAdapterFactory,
        UploaderFactory $fileUploaderFactory,
        SlideRepositoryInterface $slideRepository,
        SlideFactory $slideFactory
    ) {
        parent::__construct($context);

        $this->imageAdapterFactory = $imageAdapterFactory;
        $this->fileUploaderFactory = $fileUploaderFactory;
        $this->slideRepository = $slideRepository;
        $this->slideFactory = $slideFactory;
        $this->mediaDirectory = $filesystem->getDirectoryRead(DirectoryList::MEDIA);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Scandiweb_Slider::slide_save');
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $images['desktop_image'] = $this->getRequest()->getParam('desktop_image');
        $images['mobile_image'] = $this->getRequest()->getParam('mobile_image');
        $images['desktop_image_2'] = $this->getRequest()->getParam('desktop_image_2');
        $images['mobile_image_2'] = $this->getRequest()->getParam('mobile_image_2');
        $images['desktop_image_3'] = $this->getRequest()->getParam('desktop_image_3');
        $images['mobile_image_3'] = $this->getRequest()->getParam('mobile_image_3');

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            /** @var \Scandiweb\Slider\Model\Slide $slide */
            $slide = $this->slideFactory->create();
            $slide->setData($data);

            $imageKeys = [
                'desktop_image',
                'mobile_image',
                'desktop_image_2',
                'mobile_image_2',
                'desktop_image_3',
                'mobile_image_3'
            ];

            try {
                foreach ($imageKeys as $imageKey) {
                    if (isset($_FILES[$imageKey]['name']) && $_FILES[$imageKey]['name']) {
                        $result = $this->uploadImage($imageKey);

                        // Resize images for use in srcSets
                        $slide->prepareImagesForSrcset($result['path'] . $result['file']);
                        $slide->setData($imageKey, Slider::MEDIA_PATH . $result['file']);
                    } elseif (isset($images[$imageKey]['delete']) && $images[$imageKey]['delete']) {
                        $slide->setData($imageKey, null);
                    } else {
                        // Nothing changed, removing from the data to change
                        $slide->unSetData($imageKey);
                    }
                }

                $this->slideRepository->save($slide);
                $this->messageManager->addSuccessMessage(__('Slide successfully saved.'));
                $this->_getSession()->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', [
                        'slide_id' => $slide->getId(),
                        '_current' => true
                    ]);
                }

                return $resultRedirect->setPath('slideradmin/slider/edit', [
                    'slider_id' => $slide->getSliderId()
                ]);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __('Something went wrong while saving the slide.')
                );
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', [
                'slide_id' => $this->getRequest()->getParam('slide_id')
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }

    protected function uploadImage($imageKey)
    {
        $uploader = $this->fileUploaderFactory->create(['field' => $imageKey]);
        $imageAdapter = $this->imageAdapterFactory->create();

        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
        $uploader->addValidateCallback($imageKey, $imageAdapter, 'validateUploadFile')
            ->setAllowRenameFiles(true)
            ->setFilesDispersion(true);

        $path = $this->mediaDirectory->getAbsolutePath(Slider::MEDIA_PATH);
        return $uploader->save($path);
    }
}
