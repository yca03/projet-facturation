<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240722103630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE facture_pro_format (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, reference VARCHAR(255) NOT NULL, numero_facture_pro VARCHAR(255) NOT NULL, date_echeance DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clients ADD facture_pro_format_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E749505321D FOREIGN KEY (facture_pro_format_id) REFERENCES facture_pro_format (id)');
        $this->addSql('CREATE INDEX IDX_C82E749505321D ON clients (facture_pro_format_id)');
        $this->addSql('ALTER TABLE detail_facture ADD facture_proformat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C5BDC4C10D FOREIGN KEY (facture_proformat_id) REFERENCES facture_pro_format (id)');
        $this->addSql('CREATE INDEX IDX_9949E4C5BDC4C10D ON detail_facture (facture_proformat_id)');
        $this->addSql('ALTER TABLE mode_payement ADD facture_pro_format_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mode_payement ADD CONSTRAINT FK_B16D0C1E9505321D FOREIGN KEY (facture_pro_format_id) REFERENCES facture_pro_format (id)');
        $this->addSql('CREATE INDEX IDX_B16D0C1E9505321D ON mode_payement (facture_pro_format_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E749505321D');
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C5BDC4C10D');
        $this->addSql('ALTER TABLE mode_payement DROP FOREIGN KEY FK_B16D0C1E9505321D');
        $this->addSql('DROP TABLE facture_pro_format');
        $this->addSql('DROP INDEX IDX_C82E749505321D ON clients');
        $this->addSql('ALTER TABLE clients DROP facture_pro_format_id');
        $this->addSql('DROP INDEX IDX_B16D0C1E9505321D ON mode_payement');
        $this->addSql('ALTER TABLE mode_payement DROP facture_pro_format_id');
        $this->addSql('DROP INDEX IDX_9949E4C5BDC4C10D ON detail_facture');
        $this->addSql('ALTER TABLE detail_facture DROP facture_proformat_id');
    }
}
