<?php
// @codingStandardsIgnoreFile
namespace Mageget\Slider\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Install
     *
     * @param mixed $setup
     * @param mixed $context
     * @return void
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        $tableName = $setup->getTable("mageget_banner");

        if ($setup->getConnection()->isTableExists($tableName) != true) {
            $table = $setup
                ->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    "banner_id",
                    Table::TYPE_INTEGER,
                    null,
                    [
                        "identity" => true,
                        "unsigned" => true,
                        "nullable" => false,
                        "primary" => true,
                    ],
                    "ID"
                )
                ->addColumn(
                    "name",
                    Table::TYPE_TEXT,
                    255,
                    ["nullable" => false],
                    "Name"
                )
                ->addColumn(
                    "title",
                    Table::TYPE_TEXT,
                    255,
                    ["nullable" => false],
                    "Title"
                )
                ->addColumn(
                    "content",
                    Table::TYPE_TEXT,
                    null,
                    ["nullable" => false],
                    "Content"
                )
                ->addColumn(
                    "image",
                    Table::TYPE_TEXT,
                    255,
                    ["nullable" => false],
                    "Image"
                )
                ->addColumn(
                    "status",
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ["nullable" => false, "default" => 0],
                    "Status"
                )
                ->addColumn(
                    "created_at",
                    Table::TYPE_TIMESTAMP,
                    null,
                    ["nullable" => false, "default" => Table::TIMESTAMP_INIT],
                    "Created At"
                )
                ->setComment("Mageget Banner");
            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}
