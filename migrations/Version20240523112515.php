<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523112515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detail_facture (id INT AUTO_INCREMENT NOT NULL, produit_fact_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, quantite INT NOT NULL, prix VARCHAR(255) NOT NULL, montant_ttc VARCHAR(255) NOT NULL, montant_ht VARCHAR(255) NOT NULL, montant_tva VARCHAR(255) NOT NULL, remise VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_9949E4C5D396D753 (produit_fact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C5D396D753 FOREIGN KEY (produit_fact_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CD396D753');
        $this->addSql('DROP TABLE produits');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, produit_fact_id INT DEFAULT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, quantite INT NOT NULL, prix VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, montant_ttc VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, montant_ht VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, montant_tva VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, remise VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATETIME NOT NULL, INDEX IDX_BE2DDF8CD396D753 (produit_fact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CD396D753 FOREIGN KEY (produit_fact_id) REFERENCES facture (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C5D396D753');
        $this->addSql('DROP TABLE detail_facture');
    }
}
