<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828171220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detatil_encaissement ADD facture_id INT DEFAULT NULL, ADD montant_du VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE detatil_encaissement ADD CONSTRAINT FK_9CEDB6C17F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE INDEX IDX_9CEDB6C17F2DEE08 ON detatil_encaissement (facture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detatil_encaissement DROP FOREIGN KEY FK_9CEDB6C17F2DEE08');
        $this->addSql('DROP INDEX IDX_9CEDB6C17F2DEE08 ON detatil_encaissement');
        $this->addSql('ALTER TABLE detatil_encaissement DROP facture_id, DROP montant_du');
    }
}
