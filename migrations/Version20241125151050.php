<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241125151050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_pro_format ADD offre_commerciale_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture_pro_format ADD CONSTRAINT FK_92A7118C3DE91328 FOREIGN KEY (offre_commerciale_id) REFERENCES offre_commerciale (id)');
        $this->addSql('CREATE INDEX IDX_92A7118C3DE91328 ON facture_pro_format (offre_commerciale_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_pro_format DROP FOREIGN KEY FK_92A7118C3DE91328');
        $this->addSql('DROP INDEX IDX_92A7118C3DE91328 ON facture_pro_format');
        $this->addSql('ALTER TABLE facture_pro_format DROP offre_commerciale_id');
    }
}
