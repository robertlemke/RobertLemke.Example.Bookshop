<?php
namespace TYPO3\FLOW3\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20120601125542 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("CREATE TABLE roebooks_shop_domain_model_category (flow3_persistence_identifier VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(flow3_persistence_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE roebooks_shop_domain_model_book (flow3_persistence_identifier VARCHAR(40) NOT NULL, category VARCHAR(40) DEFAULT NULL, title VARCHAR(255) NOT NULL, price INT NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_1E761C5C64C19C1 (category), PRIMARY KEY(flow3_persistence_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE roebooks_shop_domain_model_review (flow3_persistence_identifier VARCHAR(40) NOT NULL, book VARCHAR(40) DEFAULT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, rating INT NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_F2CEEFA2CBE5A331 (book), PRIMARY KEY(flow3_persistence_identifier)) ENGINE = InnoDB");
		$this->addSql("ALTER TABLE roebooks_shop_domain_model_book ADD CONSTRAINT FK_1E761C5C64C19C1 FOREIGN KEY (category) REFERENCES roebooks_shop_domain_model_category (flow3_persistence_identifier)");
		$this->addSql("ALTER TABLE roebooks_shop_domain_model_review ADD CONSTRAINT FK_F2CEEFA2CBE5A331 FOREIGN KEY (book) REFERENCES roebooks_shop_domain_model_book (flow3_persistence_identifier)");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE roebooks_shop_domain_model_book DROP FOREIGN KEY FK_1E761C5C64C19C1");
		$this->addSql("ALTER TABLE roebooks_shop_domain_model_review DROP FOREIGN KEY FK_F2CEEFA2CBE5A331");
		$this->addSql("DROP TABLE roebooks_shop_domain_model_category");
		$this->addSql("DROP TABLE roebooks_shop_domain_model_book");
		$this->addSql("DROP TABLE roebooks_shop_domain_model_review");
	}
}

?>