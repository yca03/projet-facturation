<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240830113718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE banque_client (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, banque_only_id INT DEFAULT NULL, uid VARCHAR(255) DEFAULT NULL, numero_compte_banque VARCHAR(255) NOT NULL, rib VARCHAR(255) NOT NULL, code_agent VARCHAR(255) NOT NULL, numero_bic VARCHAR(255) NOT NULL, gestionnaire VARCHAR(255) NOT NULL, INDEX IDX_48214E8519EB6921 (client_id), INDEX IDX_48214E8587C553BE (banque_only_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE banque_only (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code_banque VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE banque_client ADD CONSTRAINT FK_48214E8519EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE banque_client ADD CONSTRAINT FK_48214E8587C553BE FOREIGN KEY (banque_only_id) REFERENCES banque_only (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE banque_client DROP FOREIGN KEY FK_48214E8519EB6921');
        $this->addSql('ALTER TABLE banque_client DROP FOREIGN KEY FK_48214E8587C553BE');
        $this->addSql('DROP TABLE banque_client');
        $this->addSql('DROP TABLE banque_only');
    }
}
