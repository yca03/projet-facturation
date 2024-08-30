<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240830141300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detail_mode_payement (id INT AUTO_INCREMENT NOT NULL, encaissement_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, montant VARCHAR(255) NOT NULL, INDEX IDX_21CE12E56F272231 (encaissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_mode_payement ADD CONSTRAINT FK_21CE12E56F272231 FOREIGN KEY (encaissement_id) REFERENCES encaissement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_mode_payement DROP FOREIGN KEY FK_21CE12E56F272231');
        $this->addSql('DROP TABLE detail_mode_payement');
    }
}
