<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523160029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C5D396D753');
        $this->addSql('DROP INDEX IDX_9949E4C5D396D753 ON detail_facture');
        $this->addSql('ALTER TABLE detail_facture DROP produit_fact_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_facture ADD produit_fact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C5D396D753 FOREIGN KEY (produit_fact_id) REFERENCES facture (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9949E4C5D396D753 ON detail_facture (produit_fact_id)');
    }
}
