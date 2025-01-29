<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250120082430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C555F1A294');
        $this->addSql('ALTER TABLE pgp DROP FOREIGN KEY FK_D1093D1E7F2DEE08');
        $this->addSql('DROP TABLE pgp');
        $this->addSql('DROP INDEX IDX_9949E4C555F1A294 ON detail_facture');
        $this->addSql('ALTER TABLE detail_facture DROP p_gp_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pgp (id INT AUTO_INCREMENT NOT NULL, facture_id INT DEFAULT NULL, periode1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, periode2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_D1093D1E7F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pgp ADD CONSTRAINT FK_D1093D1E7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE detail_facture ADD p_gp_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C555F1A294 FOREIGN KEY (p_gp_id) REFERENCES pgp (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9949E4C555F1A294 ON detail_facture (p_gp_id)');
    }
}
