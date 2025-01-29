<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250117094247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pgp ADD facture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pgp ADD CONSTRAINT FK_D1093D1E7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE INDEX IDX_D1093D1E7F2DEE08 ON pgp (facture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pgp DROP FOREIGN KEY FK_D1093D1E7F2DEE08');
        $this->addSql('DROP INDEX IDX_D1093D1E7F2DEE08 ON pgp');
        $this->addSql('ALTER TABLE pgp DROP facture_id');
    }
}
