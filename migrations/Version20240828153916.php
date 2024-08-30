<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828153916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detail_encaissement (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detatil_encaissement (id INT AUTO_INCREMENT NOT NULL, encaissement_id INT DEFAULT NULL, uid VARCHAR(255) DEFAULT NULL, solde VARCHAR(255) NOT NULL, INDEX IDX_9CEDB6C16F272231 (encaissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detatil_encaissement ADD CONSTRAINT FK_9CEDB6C16F272231 FOREIGN KEY (encaissement_id) REFERENCES encaissement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detatil_encaissement DROP FOREIGN KEY FK_9CEDB6C16F272231');
        $this->addSql('DROP TABLE detail_encaissement');
        $this->addSql('DROP TABLE detatil_encaissement');
    }
}
