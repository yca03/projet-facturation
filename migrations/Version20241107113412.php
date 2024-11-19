<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241107113412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE relation_detail_psous_detail_p (id INT AUTO_INCREMENT NOT NULL, detail_produits_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_836017E3A21ACF9E (detail_produits_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_detail_produit (id INT AUTO_INCREMENT NOT NULL, relation_detail_psous_detail_p_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', libelle VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, INDEX IDX_3350954685D44E84 (relation_detail_psous_detail_p_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE relation_detail_psous_detail_p ADD CONSTRAINT FK_836017E3A21ACF9E FOREIGN KEY (detail_produits_id) REFERENCES detail_produit (id)');
        $this->addSql('ALTER TABLE sous_detail_produit ADD CONSTRAINT FK_3350954685D44E84 FOREIGN KEY (relation_detail_psous_detail_p_id) REFERENCES relation_detail_psous_detail_p (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relation_detail_psous_detail_p DROP FOREIGN KEY FK_836017E3A21ACF9E');
        $this->addSql('ALTER TABLE sous_detail_produit DROP FOREIGN KEY FK_3350954685D44E84');
        $this->addSql('DROP TABLE relation_detail_psous_detail_p');
        $this->addSql('DROP TABLE sous_detail_produit');
    }
}
