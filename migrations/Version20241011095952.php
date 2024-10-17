<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241011095952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detatil_produit (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, type_produit_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_3FC45A1EF347EFB (produit_id), INDEX IDX_3FC45A1E1237A8DE (type_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detatil_produit ADD CONSTRAINT FK_3FC45A1EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE detatil_produit ADD CONSTRAINT FK_3FC45A1E1237A8DE FOREIGN KEY (type_produit_id) REFERENCES type_produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detatil_produit DROP FOREIGN KEY FK_3FC45A1EF347EFB');
        $this->addSql('ALTER TABLE detatil_produit DROP FOREIGN KEY FK_3FC45A1E1237A8DE');
        $this->addSql('DROP TABLE detatil_produit');
    }
}
