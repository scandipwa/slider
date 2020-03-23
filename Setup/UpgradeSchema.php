<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Raivis Dejus <info@scandiweb.com>
 * @copyright   Copyright (c) 2017 Scandiweb, Ltd (https://scandiweb.com)
 */
namespace Scandiweb\Slider\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.0', '<')) {
            $this->installMainSliderTable($setup);
            $this->installSliderItemsTable($setup);
            $this->installStoreMappingTable($setup);
            $this->installSliderMappingTable($setup);
        }

        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $this->addAdditionalSlideFields($setup);
        }

        if (version_compare($context->getVersion(), '1.0.6', '<')) {
            $this->addExtraWidthSlideField($setup);
        }

        if (version_compare($context->getVersion(), '1.0.15', '<')) {
            $this->addExtraImageField($setup);
        }

        $setup->endSetup();
    }

    protected function addAdditionalSlideFields(SchemaSetupInterface $setup)
    {
        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'image_2',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Image 2 location',
                'after' => 'embed_code'
            ]
        );


        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'embed_code_2',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 1000,
                'nullable' => true,
                'comment' => 'Iframe 2 code',
                'after' => 'image_2'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'slide_link_2',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Slide link 2',
                'after' => 'embed_code_2'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'display_title_2',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Display title 2',
                'after' => 'slide_link_2'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'slide_text_2',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 4096,
                'nullable' => true,
                'comment' => 'Slide 2 text to display',
                'after' => 'display_title_2'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'slide_text_position_2',
            [
                'type' => Table::TYPE_SMALLINT,
                'default' => '0',
                'comment' => 'Slide text position',
                'after' => 'slide_text_2'
            ]
        );


        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'image_3',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Image 3 location',
                'after' => 'slide_text_position_2'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'embed_code_3',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 1000,
                'nullable' => true,
                'comment' => 'Iframe 3 code',
                'after' => 'image_3'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'slide_link_3',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Slide link 3',
                'after' => 'embed_code_3'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'display_title_3',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Display title 3',
                'after' => 'slide_link_3'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'slide_text_3',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 4096,
                'nullable' => true,
                'comment' => 'Slide 3 text to display',
                'after' => 'display_title_3'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'slide_text_position_3',
            [
                'type' => Table::TYPE_SMALLINT,
                'default' => '0',
                'comment' => 'Slide text position',
                'after' => 'slide_text_3'
            ]
        );
    }

    protected function addExtraWidthSlideField(SchemaSetupInterface $setup)
    {
        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'slide_width_class',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Width of first Block',
                'after' => 'slide_text_position'
            ]
        );
    }

    protected function addExtraImageField(SchemaSetupInterface $setup)
    {
        $setup->getConnection()->changeColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'image',
            'desktop_image',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Desktop Image location',
                'after' => 'title'
            ]
        );

        $setup->getConnection()->changeColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'image_2',
            'desktop_image_2',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Desktop Image 2 location',
                'after' => 'embed_code'
            ]
        );

        $setup->getConnection()->changeColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'image_3',
            'desktop_image_3',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Desktop Image 3 location',
                'after' => 'slide_text_position_2'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'mobile_image',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Mobile Image location',
                'after' => 'desktop_image'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'mobile_image_2',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Mobile Image 2 location',
                'after' => 'desktop_image_2'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('scandiweb_slider_slide'),
            'mobile_image_3',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Mobile Image 3 location',
                'after' => 'desktop_image_3'
            ]
        );
    }

    /**
     * Create slider table
     */
    protected function installMainSliderTable(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable('scandiweb_slider'))
            ->addColumn(
                'slider_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Slider id'
            )->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Slider title'
            )->addColumn(
                'is_active',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1'],
                'Is slider active'
            )->addColumn(
                'show_menu',
                Table::TYPE_SMALLINT,
                null,
                ['default' => '1'],
                'Show slide menu'
            )->addColumn(
                'show_navigation',
                Table::TYPE_SMALLINT,
                null,
                ['default' => '1'],
                'Show slide navigation'
            )->addColumn(
                'slide_speed',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => 0],
                'Slide speed'
            )->addColumn(
                'position',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => 0],
                'Slide speed'
            )->addColumn(
                'animation_speed',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => 0],
                'Animation speed'
            )->addColumn(
                'slides_to_display',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => 0],
                'Slides to display'
            )->addColumn(
                'slides_to_scroll',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => 0],
                'Slides to scroll'
            )->addColumn(
                'lazy_load',
                Table::TYPE_SMALLINT,
                null,
                ['default' => '0'],
                'Use lazy load'
            )->addColumn(
                'slides_to_display_tablet',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => '0'],
                'Slides to display on tablet'
            )->addColumn(
                'slides_to_scroll_tablet',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => '0'],
                'Slides to scroll on tablet'
            )->addColumn(
                'slides_to_display_mobile',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => '0'],
                'Slides to display on mobile'
            )->addColumn(
                'slides_to_scroll_mobile',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'default' => '0'],
                'Slides to scroll on mobile'
            )->addIndex(
                $setup->getIdxName('scandiweb_slider', ['slider_id']),
                ['slider_id']
            )->addIndex(
                $setup->getIdxName('scandiweb_slider', ['position']),
                ['position']
            )->setComment(
                'Slider table'
            );
        $setup->getConnection()->createTable($table);
    }

    /**
     * Create slider image table
     */
    protected function installSliderItemsTable(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable('scandiweb_slider_slide'))
            ->addColumn(
                'slide_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Slide id'
            )->addColumn(
                'slider_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Slider id'
            )->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Slide title'
            )->addColumn(
                'image',
                Table::TYPE_TEXT,
                255,
                [],
                'Image location'
            )->addColumn(
                'is_active',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1'],
                'Image is active'
            )->addColumn(
                'position',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'default' => '0'],
                'Slide position'
            )->addColumn(
                'start_time',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => true],
                'Slide starting time'
            )->addColumn(
                'end_time',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => true],
                'Slide ending time'
            )->addColumn(
                'slide_link',
                Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Slide link'
            )->addColumn(
                'slide_link_text',
                Table::TYPE_TEXT,
                1000,
                ['nullable' => true],
                'Slide link text'
            )->addColumn(
                'display_title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Slide title to display'
            )->addColumn(
                'slide_text',
                Table::TYPE_TEXT,
                4096,
                ['nullable' => true],
                'Slide text to display'
            )->addColumn(
                'embed_code',
                Table::TYPE_TEXT,
                1000,
                ['nullable' => true],
                'Iframe url'
            )->addColumn(
                'slide_text_position',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '0'],
                'Slide text position'
            )->addIndex(
                $setup->getIdxName('scandiweb_slider_slide', ['slide_id']),
                ['slide_id']
            )->addIndex(
                $setup->getIdxName('scandiweb_slider_slide', ['slider_id']),
                ['slider_id']
            )->addIndex(
                $setup->getIdxName('scandiweb_slider_slide', ['position']),
                ['position']
            )->addForeignKey(
                $setup->getFkName('scandiweb_slider_slide', 'slider_id', 'scandiweb_slider', 'slider_id'),
                'slider_id',
                $setup->getTable('scandiweb_slider'),
                'slider_id',
                Table::ACTION_CASCADE
            )->setComment(
                'Slider image table'
            );
        $setup->getConnection()->createTable($table);
    }

    /**
     * Create slider - store mapping table
     */
    protected function installStoreMappingTable(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable('scandiweb_slider_slide_store'))
            ->addColumn(
                'slide_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Image id'
            )->addColumn(
                'store_id',
                Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Store ID'
            )->addIndex(
                $setup->getIdxName('scandiweb_slider_slide_store', ['slide_id']),
                ['slide_id']
            )->addForeignKey(
                $setup->getFkName('scandiweb_slider_slide_store', 'slide_id', 'scandiweb_slider_slide', 'slide_id'),
                'slide_id',
                $setup->getTable('scandiweb_slider_slide'),
                'slide_id',
                Table::ACTION_CASCADE
            )->addForeignKey(
                $setup->getFkName('scandiweb_slider_slide_store', 'store_id', 'store', 'store_id'),
                'store_id',
                $setup->getTable('store'),
                'store_id',
                Table::ACTION_NO_ACTION
            )->setComment(
                'Slider image to store linkage table'
            );
        $setup->getConnection()->createTable($table);
    }

    /**
     * Create slider - slides mapping table
     */
    protected function installSliderMappingTable(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable('scandiweb_slider_slide_map'))
            ->addColumn(
                'map_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Map id'
            )->addColumn(
                'slide_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Image id'
            )->addColumn(
                'title',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Image map title'
            )->addColumn(
                'coordinates',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Map coordinates'
            )->addColumn(
                'is_active',
                Table::TYPE_SMALLINT,
                null,
                ['default' => '1'],
                'Map is active'
            )->addColumn(
                'product_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => true],
                'Product id'
            )->addIndex(
                $setup->getIdxName('scandiweb_slider_slide_map', ['slide_id']),
                ['slide_id']
            )->addForeignKey(
                $setup->getFkName('scandiweb_slider_slide_map', 'slide_id', 'scandiweb_slider_slide', 'slide_id'),
                'slide_id',
                $setup->getTable('scandiweb_slider_slide'),
                'slide_id',
                Table::ACTION_CASCADE
            );

        $setup->getConnection()->createTable($table);
    }
}

