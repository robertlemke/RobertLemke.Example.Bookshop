<?php
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs! This block will be used as the migration description if getDescription() is not used.
 */
class Version20170207124232 extends AbstractMigration
{

    /**
     * @return string
     */
    public function getDescription()
    {
        return '';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('CREATE TABLE robertlemke_example_bookshop_domain_model_book_assets_join (bookshop_book VARCHAR(40) NOT NULL, media_asset VARCHAR(40) NOT NULL, INDEX IDX_D9C250E03D281673 (bookshop_book), INDEX IDX_D9C250E01DB69EED (media_asset), PRIMARY KEY(bookshop_book, media_asset)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE robertlemke_example_bookshop_domain_model_book_assets_join ADD CONSTRAINT FK_D9C250E03D281673 FOREIGN KEY (bookshop_book) REFERENCES robertlemke_example_bookshop_domain_model_book (persistence_object_identifier)');
        $this->addSql('ALTER TABLE robertlemke_example_bookshop_domain_model_book_assets_join ADD CONSTRAINT FK_D9C250E01DB69EED FOREIGN KEY (media_asset) REFERENCES neos_media_domain_model_asset (persistence_object_identifier)');
        $this->addSql('ALTER TABLE robertlemke_example_bookshop_domain_model_book ADD sampleimages VARCHAR(40) DEFAULT NULL');
        $this->addSql('ALTER TABLE robertlemke_example_bookshop_domain_model_book ADD CONSTRAINT FK_18A52A6462F659F9 FOREIGN KEY (sampleimages) REFERENCES neos_media_domain_model_assetcollection (persistence_object_identifier)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_18A52A6462F659F9 ON robertlemke_example_bookshop_domain_model_book (sampleimages)');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('DROP TABLE robertlemke_example_bookshop_domain_model_book_assets_join');
        $this->addSql('ALTER TABLE robertlemke_example_bookshop_domain_model_book DROP FOREIGN KEY FK_18A52A6462F659F9');
        $this->addSql('DROP INDEX UNIQ_18A52A6462F659F9 ON robertlemke_example_bookshop_domain_model_book');
        $this->addSql('ALTER TABLE robertlemke_example_bookshop_domain_model_book DROP sampleimages');
    }
}