<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240613132813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C57F2DEE08');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C57F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641099DED506');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410EF4F1912');
        $this->addSql('ALTER TABLE facture ADD date_expiration DATE NOT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641099DED506 FOREIGN KEY (id_client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410EF4F1912 FOREIGN KEY (mode_payement_id) REFERENCES mode_payement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641099DED506');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410EF4F1912');
        $this->addSql('ALTER TABLE facture DROP date_expiration');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641099DED506 FOREIGN KEY (id_client_id) REFERENCES clients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410EF4F1912 FOREIGN KEY (mode_payement_id) REFERENCES mode_payement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C57F2DEE08');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C57F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id) ON DELETE CASCADE');
    }
}
