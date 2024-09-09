<?php
//
//declare(strict_types=1);
//
//namespace DoctrineMigrations;
//
//use Doctrine\DBAL\Schema\Schema;
//use Doctrine\Migrations\AbstractMigration;
//
///**
// * Auto-generated Migration: Please modify to your needs!
// */
//final class Version20240702080306 extends AbstractMigration
//{
//    public function getDescription(): string
//    {
//        return '';
//    }
//
//    public function up(Schema $schema): void
//    {
//        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('CREATE TABLE societe (id INT AUTO_INCREMENT NOT NULL, raison_social VARCHAR(255) NOT NULL, forme VARCHAR(255) NOT NULL, activite VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, siege VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('ALTER TABLE facture ADD date_expiration DATE NOT NULL');
//        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_EMAIL ON user');
//        $this->addSql('ALTER TABLE user ADD nom_utilisateur VARCHAR(255) NOT NULL');
//        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (nom_utilisateur)');
//    }
//
//    public function down(Schema $schema): void
//    {
//        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('DROP TABLE societe');
//        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_EMAIL ON user');
//        $this->addSql('ALTER TABLE user DROP nom_utilisateur');
//        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
//        $this->addSql('ALTER TABLE facture DROP date_expiration');
//    }
//}
