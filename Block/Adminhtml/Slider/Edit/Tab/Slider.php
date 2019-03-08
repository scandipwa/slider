<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Slider\Edit\Tab;

class Slider extends \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @return \Scandiweb\Slider\Block\Adminhtml\Slider\Edit\Tab\General
     */
    protected function _prepareForm()
    {
        /* @var $model \Scandiweb\Slider\Model\Slider */
        $model = $this->_coreRegistry->registry('slider');

        /* @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('slider_');

        /* @var $fieldset \Magento\Framework\Data\Form\Element\Fieldset */
        $fieldset = $form->addFieldset(
            'content_fieldset',
            ['legend' => __('General'), 'class' => 'fieldset-wide']
        );

        if ($model->getSliderId()) {
            $fieldset->addField('slider_id', 'hidden', ['name' => 'slider_id']);
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Slider Title'),
                'title' => __('Slider Title'),
                'required' => true,
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'name' => 'is_active',
                'label' => __('Status'),
                'title' => __('Status'),
                'options' => [1 => __('Enabled'), 0 => __('Disabled')],
            ]
        );

        $fieldset->addField(
            'show_menu',
            'select',
            [
                'name' => 'show_menu',
                'label' => __('Slider Menu Status'),
                'title' => __('Slider Menu Status'),
                'options' => [1 => __('Enabled'), 0 => __('Disabled')],
                'note' => __('If Enabled, will show menu with button for each slide')
            ]
        );

        $fieldset->addField(
            'show_navigation',
            'select',
            [
                'name' => 'show_navigation',
                'label' => __('Slider Navigation Status'),
                'title' => __('Slider Navigation Status'),
                'options' => [1 => __('Enabled'), 0 => __('Disabled')],
                'note' => __('If Enabled, will show previous and next slide buttons')
            ]
        );

        $fieldset->addField(
            'lazy_load',
            'select',
            [
                'name' => 'lazy_load',
                'label' => __('Lazy Load Status'),
                'title' => __('Lazy Load Status'),
                'options' => [1 => __('Enabled'), 0 => __('Disabled')],
                'note' => __(
                    'If Enabled, images will be loaded on demand. ' .
                    'This option can improve page loading speed, ' .
                    'but slider won\'t be visible while page is being rendered'
                )
            ]
        );

        $fieldset->addField(
            'animation_speed',
            'text',
            [
                'name' => 'animation_speed',
                'label' => __('Animation Speed'),
                'title' => __('Animation Speed'),
                'note' => __('Default - 300ms, write value as numbers only, in milliseconds (1 second is 1000ms)')
            ]
        );

        $fieldset->addField(
            'slide_speed',
            'text',
            [
                'name' => 'slide_speed',
                'label' => __('Slide Speed'),
                'title' => __('Slide Speed'),
                'note' => __(
                    'Default - 5000ms (5s), write value as numbers only, in milliseconds. Set how long each slide is displayed.'
                )
            ]
        );

        $fieldset->addField(
            'slides_to_display',
            'text',
            [
                'name' => 'slides_to_display',
                'label' => __('Number of slides to display'),
                'title' => __('Number of slides to display'),
                'note' =>  __(
                    'Default - 1, Number of slides displayed simultaneously. ' .
                    'useful for brand logos carousels, where you want to display more logos at the same time.'
                )
            ]
        );

        $fieldset->addField(
            'slides_to_scroll',
            'text',
            [
                'name' => 'slides_to_scroll',
                'label' => __('Number of slides to scroll'),
                'title' => __('Number of slides to scroll'),
                'note' =>  __(
                    'Default - 1, Number of slides to be scrolled at the same time. ' .
                    'E.g. if you display 2 slides simultaneously you would want to change both or only 1 of them.'
                )
            ]
        );

        $fieldset->addField(
            'slides_to_display_tablet',
            'text',
            [
                'name' => 'slides_to_display_tablet',
                'label' => __('Number of slides to display on tablets'),
                'title' => __('Number of slides to display on tablets'),
                'note' =>  __('Default - 1, Number of slides displayed simultaneously on tablet devices')
            ]
        );

        $fieldset->addField(
            'slides_to_scroll_tablet',
            'text',
            [
                'name' => 'slides_to_scroll_tablet',
                'label' => __('Number of slides to scroll on tablets'),
                'title' => __('Number of slides to scroll on tablets'),
                'note' =>  __('Default - 1, Number of slides scrolled on tablet')
            ]
        );

        $fieldset->addField(
            'slides_to_display_mobile',
            'text',
            [
                'name' => 'slides_to_display_mobile',
                'label' => __('Number of slides to display on mobile'),
                'title' => __('Number of slides to display on mobile'),
                'note' =>  __('Default - 1, Number of slides displayed simultaneously on mobile devices')
            ]
        );

        $fieldset->addField(
            'slides_to_scroll_mobile',
            'text',
            [
                'name' => 'slides_to_scroll_mobile',
                'label' => __('Number of slides to scroll on mobile'),
                'title' => __('Number of slides to scroll on mobile'),
                'note' =>  __('Default - 1, Number of slides scrolled on mobile')
            ]
        );

        $form->setValues($model->getData());
        $form->addFieldNameSuffix('slider');
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('General');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('General');
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
