<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Slide\Edit\Tab;

class Slide extends \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return \Scandiweb\Slider\Block\Adminhtml\Slide\Edit\Tab\Slide
     */
    protected function _prepareForm()
    {
        /* @var $model \Scandiweb\Slider\Model\Slide */
        $model = $this->_coreRegistry->registry('slide');

        /* @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('slide_');

        /* @var $general \Magento\Framework\Data\Form\Element\Fieldset */
        $general = $form->addFieldset(
            'general_fieldset',
            ['legend' => __('General'), 'class' => 'fieldset-wide']
        );

        if ($model->getSliderId()) {
            $general->addField('slider_id', 'hidden', ['name' => 'slider_id']);
        }

        if ($model->getSlideId()) {
            $general->addField('slide_id', 'hidden', ['name' => 'slide_id']);
        }

        $general->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Slide Title'),
                'title' => __('Slide Title'),
                'required' => true,
            ]
        );

        $general->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => ['1' => __('Enabled'), '0' => __('Disabled')],
            ]
        );

        /* Check is single store mode */
        if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $general->addField(
                'store_id',
                'multiselect',
                [
                    'name' => 'stores[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true),
                ]
            );

            /* @var $renderer \Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element */
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
        } else {
            $general->addField(
                'store_id',
                'hidden',
                ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
            $model->setStoreId($this->_storeManager->getStore(true)->getId());
        }

        $dateFormat = $this->_localeDate->getDateFormat(
            \IntlDateFormatter::SHORT
        );

        $general->addField(
            'start_time',
            'date',
            [
                'name' => 'start_time',
                'label' => __('Start Time'),
                'date_format' => $dateFormat,
                'class' => 'validate-date validate-date-range date-range-custom_theme-from'
            ]
        );

        $general->addField(
            'end_time',
            'date',
            [
                'name' => 'end_time',
                'label' => __('End Time'),
                'date_format' => $dateFormat,
                'class' => 'validate-date validate-date-range date-range-custom_theme-to'
            ]
        );

        $general->addField(
            'position',
            'text',
            [
                'label' => __('Position'),
                'title' => __('Position'),
                'name' => 'position',
            ]
        );

        $wysiwygConfig = $this->_wysiwygConfig->getConfig(
            [
                'tab_id' => $this->getTabId(),
            ]
        );

        // Block 1

        /* @var $general \Magento\Framework\Data\Form\Element\Fieldset */
        $block1 = $form->addFieldset(
            'block_1_fieldset',
            ['legend' => __('Block 1'), 'class' => 'fieldset-wide']
        );

        $block1->addField(
            'mobile_image',
            'image',
            [
                'name' => 'mobile_image',
                'label' => __('Mobile Image'),
                'title' => __('Mobile Image'),
                'required' => true
            ]
        );

        $block1->addField(
            'desktop_image',
            'image',
            [
                'name' => 'desktop_image',
                'label' => __('Desktop Image'),
                'title' => __('Desktop Image'),
                'required' => true
            ]
        );

        $block1->addField(
            'embed_code',
            'text',
            [
                'label' => __('Video Embed Code'),
                'title' => __('Video Embed Code'),
                'name' => 'embed_code',
                'note' => __(
                    'Copy youtube or vimeo or any iframe code from "share" '
                    . 'tab here if you want to display video in this block.'
                )
            ]
        );

        $block1->addField(
            'slide_link',
            'text',
            [
                'label' => __('Block Link'),
                'title' => __('Block Link'),
                'name' => 'slide_link',
                'note' => __('Full URL where block should redirect after click on it.')
            ]
        );

        $block1->addField(
            'display_title',
            'text',
            [
                'label' => __('Display Title'),
                'title' => __('Display Title'),
                'name' => 'display_title',
            ]
        );

        $block1->addField(
            'slide_text',
            'editor',
            [
                'label' => __('Block Text'),
                'title' => __('Block Text'),
                'name' => 'slide_text',
                'config' => $wysiwygConfig,
            ]
        );

        $block1->addField(
            'slide_text_position',
            'select',
            [
                'label' => __('Block Foreground Text Position'),
                'title' => __('Block Foreground Text Position'),
                'name' => 'slide_text_position',
                'required' => true,
                'options' => ['0' => __('Left'), '1' => __('Right'), '2' => __('Center')]
            ]
        );

        $block1->addField(
            'slide_width_class',
            'select',
            [
                'label' => __('Block Width in 2 block mode'),
                'title' => __('Block Width in 2 block mode'),
                'name' => 'slide_width_class',
                'options' => ['' => __('Normal'), 'wide' => __('Wide')]
            ]
        );

        // Block 2

        /* @var $general \Magento\Framework\Data\Form\Element\Fieldset */
        $block2 = $form->addFieldset(
            'block_2_fieldset',
            ['legend' => __('Block 2 (optional)'), 'class' => 'fieldset-wide']
        );

        $block2->addField(
            'mobile_image_2',
            'image',
            [
                'name' => 'mobile_image_2',
                'label' => __('Mobile Image'),
                'title' => __('Mobile Image')
            ]
        );

        $block2->addField(
            'desktop_image_2',
            'image',
            [
                'name' => 'desktop_image_2',
                'label' => __('Desktop Image'),
                'title' => __('Desktop Image')
            ]
        );

        $block2->addField(
            'embed_code_2',
            'text',
            [
                'label' => __('Video Embed Code'),
                'title' => __('Video Embed Code'),
                'name' => 'embed_code_2',
                'note' => __(
                    'Copy youtube or vimeo or any iframe code from "share" '
                    . 'tab here if you want to display video in this block.'
                )
            ]
        );

        $block2->addField(
            'slide_link_2',
            'text',
            [
                'label' => __('Block Link'),
                'title' => __('Block Link'),
                'name' => 'slide_link_2',
                'note' => __('Full URL where block should redirect after click on it.')
            ]
        );

        $block2->addField(
            'display_title_2',
            'text',
            [
                'label' => __('Display Title'),
                'title' => __('Display Title'),
                'name' => 'display_title_2',
            ]
        );

        $block2->addField(
            'slide_text_2',
            'editor',
            [
                'label' => __('Block Text'),
                'title' => __('Block Text'),
                'name' => 'slide_text_2',
                'config' => $wysiwygConfig,
            ]
        );

        $block2->addField(
            'slide_text_position_2',
            'select',
            [
                'label' => __('Block Foreground Text Position'),
                'title' => __('Block Foreground Text Position'),
                'name' => 'slide_text_position_2',
                'required' => true,
                'options' => ['0' => __('Left'), '1' => __('Right'), '2' => __('Center')]
            ]
        );

        // Block 3

        /* @var $general \Magento\Framework\Data\Form\Element\Fieldset */
        $block3 = $form->addFieldset(
            'block_3_fieldset',
            ['legend' => __('Block 3 (optional)'), 'class' => 'fieldset-wide']
        );

        $block3->addField(
            'mobile_image_3',
            'image',
            [
                'name' => 'mobile_image_3',
                'label' => __('Mobile Image'),
                'title' => __('Mobile Image')
            ]
        );

        $block3->addField(
            'desktop_image_3',
            'image',
            [
                'name' => 'desktop_image_3',
                'label' => __('Desktop Image'),
                'title' => __('Desktop Image')
            ]
        );

        $block3->addField(
            'embed_code_3',
            'text',
            [
                'label' => __('Video Embed Code'),
                'title' => __('Video Embed Code'),
                'name' => 'embed_code_3',
                'note' => __(
                    'Copy youtube or vimeo or any iframe code from "share" '
                    . 'tab here if you want to display video in this block.'
                )
            ]
        );

        $block3->addField(
            'slide_link_3',
            'text',
            [
                'label' => __('Block Link'),
                'title' => __('Block Link'),
                'name' => 'slide_link_3',
                'note' => __('Full URL where block should redirect after click on it.')
            ]
        );

        $block3->addField(
            'display_title_3',
            'text',
            [
                'label' => __('Display Title'),
                'title' => __('Display Title'),
                'name' => 'display_title_3',
            ]
        );

        $block3->addField(
            'slide_text_3',
            'editor',
            [
                'label' => __('Block Text'),
                'title' => __('Block Text'),
                'name' => 'slide_text_3',
                'config' => $wysiwygConfig,
            ]
        );

        $block3->addField(
            'slide_text_position_3',
            'select',
            [
                'label' => __('Block Foreground Text Position'),
                'title' => __('Block Foreground Text Position'),
                'name' => 'slide_text_position_3',
                'required' => true,
                'options' => ['0' => __('Left'), '1' => __('Right'), '2' => __('Center')]
            ]
        );

        $values = $model->getData();
        $values['mobile_image'] = $model->getMobileImageUrl();
        $values['desktop_image'] = $model->getDesktopImageUrl();
        $values['mobile_image_2'] = $model->getMobileImageUrl2();
        $values['desktop_image_2'] = $model->getDesktopImageUrl2();
        $values['mobile_image_3'] = $model->getMobileImageUrl3();
        $values['desktop_image_3'] = $model->getDesktopImageUrl3();

        $form->setValues($values);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Slide');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Slide');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * @param  string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
