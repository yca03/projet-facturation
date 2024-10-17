<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241004145632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notify (id INT AUTO_INCREMENT NOT NULL, facture_id INT DEFAULT NULL, facture_pro_format_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, uid VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, statut VARCHAR(255) DEFAULT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, INDEX IDX_217BEDC87F2DEE08 (facture_id), INDEX IDX_217BEDC89505321D (facture_pro_format_id), INDEX IDX_217BEDC8FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notify ADD CONSTRAINT FK_217BEDC87F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE notify ADD CONSTRAINT FK_217BEDC89505321D FOREIGN KEY (facture_pro_format_id) REFERENCES facture_pro_format (id)');
        $this->addSql('ALTER TABLE notify ADD CONSTRAINT FK_217BEDC8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notify DROP FOREIGN KEY FK_217BEDC87F2DEE08');
        $this->addSql('ALTER TABLE notify DROP FOREIGN KEY FK_217BEDC89505321D');
        $this->addSql('ALTER TABLE notify DROP FOREIGN KEY FK_217BEDC8FB88E14F');
        $this->addSql('DROP TABLE notify');
    }
}
