<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240808082927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_facture CHANGE facture_id facture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture ADD total_ht VARCHAR(255) DEFAULT NULL, ADD total_tva VARCHAR(255) DEFAULT NULL, ADD total_ttc VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE facture_pro_format ADD total_ht VARCHAR(255) DEFAULT NULL, ADD total_tva VARCHAR(255) DEFAULT NULL, ADD total_ttc VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP total_ht, DROP total_tva, DROP total_ttc');
        $this->addSql('ALTER TABLE facture_pro_format DROP total_ht, DROP total_tva, DROP total_ttc');
        $this->addSql('ALTER TABLE detail_facture CHANGE facture_id facture_id INT NOT NULL');
    }
}
