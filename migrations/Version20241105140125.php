<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241105140125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_commerciale ADD clients_id INT DEFAULT NULL, ADD produits_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre_commerciale ADD CONSTRAINT FK_95EB2D66AB014612 FOREIGN KEY (clients_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE offre_commerciale ADD CONSTRAINT FK_95EB2D66CD11A2CF FOREIGN KEY (produits_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_95EB2D66AB014612 ON offre_commerciale (clients_id)');
        $this->addSql('CREATE INDEX IDX_95EB2D66CD11A2CF ON offre_commerciale (produits_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_commerciale DROP FOREIGN KEY FK_95EB2D66AB014612');
        $this->addSql('ALTER TABLE offre_commerciale DROP FOREIGN KEY FK_95EB2D66CD11A2CF');
        $this->addSql('DROP INDEX IDX_95EB2D66AB014612 ON offre_commerciale');
        $this->addSql('DROP INDEX IDX_95EB2D66CD11A2CF ON offre_commerciale');
        $this->addSql('ALTER TABLE offre_commerciale DROP clients_id, DROP produits_id');
    }
}
