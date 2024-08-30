<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828152122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encaissement (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, mode_payement_id INT DEFAULT NULL, uid VARCHAR(255) NOT NULL, date DATETIME NOT NULL, reference VARCHAR(255) NOT NULL, INDEX IDX_5D4869B019EB6921 (client_id), INDEX IDX_5D4869B0EF4F1912 (mode_payement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE encaissement ADD CONSTRAINT FK_5D4869B019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE encaissement ADD CONSTRAINT FK_5D4869B0EF4F1912 FOREIGN KEY (mode_payement_id) REFERENCES mode_payement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encaissement DROP FOREIGN KEY FK_5D4869B019EB6921');
        $this->addSql('ALTER TABLE encaissement DROP FOREIGN KEY FK_5D4869B0EF4F1912');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE encaissement');
    }
}
