<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241125154349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_facture ADD offre_commerciale_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C53DE91328 FOREIGN KEY (offre_commerciale_id) REFERENCES offre_commerciale (id)');
        $this->addSql('CREATE INDEX IDX_9949E4C53DE91328 ON detail_facture (offre_commerciale_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C53DE91328');
        $this->addSql('DROP INDEX IDX_9949E4C53DE91328 ON detail_facture');
        $this->addSql('ALTER TABLE detail_facture DROP offre_commerciale_id');
    }
}
