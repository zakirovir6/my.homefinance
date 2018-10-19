<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181019192213 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, amount NUMERIC(10, 2) NOT NULL, direction SMALLINT NOT NULL, comment VARCHAR(1000) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_file (id INT AUTO_INCREMENT NOT NULL, transaction_id INT NOT NULL, name VARCHAR(255) NOT NULL, link VARCHAR(1000) NOT NULL, comment VARCHAR(1000) DEFAULT NULL, INDEX IDX_6EDC08B12FC0CB0F (transaction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction_file ADD CONSTRAINT FK_6EDC08B12FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction_file DROP FOREIGN KEY FK_6EDC08B12FC0CB0F');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE transaction_file');
    }
}
