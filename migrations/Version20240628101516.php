<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240628101516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE societe (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, raison_social VARCHAR(255) NOT NULL, forme VARCHAR(255) NOT NULL, activite VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, siege VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, INDEX IDX_19653DBD3256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE societe ADD CONSTRAINT FK_19653DBD3256915B FOREIGN KEY (relation_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE societe DROP FOREIGN KEY FK_19653DBD3256915B');
        $this->addSql('DROP TABLE societe');
    }
}
