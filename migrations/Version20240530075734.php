<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530075734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients ADD adresse VARCHAR(255) NOT NULL, ADD contact VARCHAR(255) NOT NULL, DROP prenom, DROP numero');
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C57F2DEE08');
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C5F347EFB');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C57F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C5F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641099DED506');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641099DED506 FOREIGN KEY (id_client_id) REFERENCES clients (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients ADD prenom VARCHAR(255) NOT NULL, ADD numero VARCHAR(255) NOT NULL, DROP adresse, DROP contact');
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C5F347EFB');
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C57F2DEE08');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C5F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C57F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641099DED506');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641099DED506 FOREIGN KEY (id_client_id) REFERENCES clients (id) ON DELETE CASCADE');
    }
}
