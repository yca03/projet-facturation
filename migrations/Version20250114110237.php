<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250114110237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_facture ADD p_gp_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C555F1A294 FOREIGN KEY (p_gp_id) REFERENCES pgp (id)');
        $this->addSql('CREATE INDEX IDX_9949E4C555F1A294 ON detail_facture (p_gp_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C555F1A294');
        $this->addSql('DROP INDEX IDX_9949E4C555F1A294 ON detail_facture');
        $this->addSql('ALTER TABLE detail_facture DROP p_gp_id');
    }
}
