<?php
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130307154111 extends AbstractMigration
{

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("CREATE TABLE robertlemke_example_bookshop_domain_model_book (persistence_object_identifier VARCHAR(40) NOT NULL, category VARCHAR(40) DEFAULT NULL, image VARCHAR(40) DEFAULT NULL, title VARCHAR(255) NOT NULL, price INT NOT NULL, description LONGTEXT NOT NULL, isbn VARCHAR(255) NOT NULL, INDEX IDX_18A52A6464C19C1 (category), INDEX IDX_18A52A64C53D045F (image), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB");
        $this->addSql("CREATE TABLE robertlemke_example_bookshop_domain_model_category (persistence_object_identifier VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB");
        $this->addSql("CREATE TABLE robertlemke_example_bookshop_domain_model_review (persistence_object_identifier VARCHAR(40) NOT NULL, book VARCHAR(40) DEFAULT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, rating INT NOT NULL, comment LONGTEXT NOT NULL, INDEX IDX_2AEBC013CBE5A331 (book), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB");
        $this->addSql("CREATE TABLE robertlemke_example_bookshop_domain_model_user (persistence_object_identifier VARCHAR(40) NOT NULL, department VARCHAR(255) NOT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB");
        $this->addSql("ALTER TABLE robertlemke_example_bookshop_domain_model_book ADD CONSTRAINT FK_18A52A6464C19C1 FOREIGN KEY (category) REFERENCES robertlemke_example_bookshop_domain_model_category (persistence_object_identifier)");
        $this->addSql("ALTER TABLE robertlemke_example_bookshop_domain_model_book ADD CONSTRAINT FK_18A52A64C53D045F FOREIGN KEY (image) REFERENCES typo3_flow_resource_resource (persistence_object_identifier)");
        $this->addSql("ALTER TABLE robertlemke_example_bookshop_domain_model_review ADD CONSTRAINT FK_2AEBC013CBE5A331 FOREIGN KEY (book) REFERENCES robertlemke_example_bookshop_domain_model_book (persistence_object_identifier)");
        $this->addSql("ALTER TABLE robertlemke_example_bookshop_domain_model_user ADD CONSTRAINT FK_5ED35F1C47A46B0A FOREIGN KEY (persistence_object_identifier) REFERENCES typo3_party_domain_model_abstractparty (persistence_object_identifier) ON DELETE CASCADE");
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $this->addSql("ALTER TABLE robertlemke_example_bookshop_domain_model_review DROP FOREIGN KEY FK_2AEBC013CBE5A331");
        $this->addSql("ALTER TABLE robertlemke_example_bookshop_domain_model_book DROP FOREIGN KEY FK_18A52A6464C19C1");
        $this->addSql("DROP TABLE robertlemke_example_bookshop_domain_model_book");
        $this->addSql("DROP TABLE robertlemke_example_bookshop_domain_model_category");
        $this->addSql("DROP TABLE robertlemke_example_bookshop_domain_model_review");
        $this->addSql("DROP TABLE robertlemke_example_bookshop_domain_model_user");
    }
}

?>
