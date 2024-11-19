<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241106111244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_commerciale ADD produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre_commerciale ADD CONSTRAINT FK_95EB2D66F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_95EB2D66F347EFB ON offre_commerciale (produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_commerciale DROP FOREIGN KEY FK_95EB2D66F347EFB');
        $this->addSql('DROP INDEX IDX_95EB2D66F347EFB ON offre_commerciale');
        $this->addSql('ALTER TABLE offre_commerciale DROP produit_id');
    }
}
