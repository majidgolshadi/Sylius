<?php

namespace Sylius\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151210134607 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_B04EBA8577153098 ON sylius_promotion_coupon (code)');
        $this->addSql('ALTER TABLE sylius_promotion ADD code VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F157396377153098 ON sylius_promotion (code)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_F157396377153098 ON sylius_promotion');
        $this->addSql('ALTER TABLE sylius_promotion DROP code');
        $this->addSql('DROP INDEX UNIQ_B04EBA8577153098 ON sylius_promotion_coupon');
    }
}
