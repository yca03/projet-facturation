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
//final class Version20240909143811 extends AbstractMigration
//{
//    public function getDescription(): string
//    {
//        return '';
//    }
//
//    public function up(Schema $schema): void
//    {
//        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('DROP TABLE messenger_messages');
//        $this->addSql('ALTER TABLE detail_facture DROP FOREIGN KEY FK_9949E4C5BDC4C10D');
//        $this->addSql('DROP INDEX IDX_9949E4C5BDC4C10D ON detail_facture');
//        $this->addSql('ALTER TABLE detail_facture DROP facture_proformat_id');
//    }
//
//    public function down(Schema $schema): void
//    {
//        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
//        $this->addSql('ALTER TABLE detail_facture ADD facture_proformat_id INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE detail_facture ADD CONSTRAINT FK_9949E4C5BDC4C10D FOREIGN KEY (facture_proformat_id) REFERENCES facture_pro_format (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
//        $this->addSql('CREATE INDEX IDX_9949E4C5BDC4C10D ON detail_facture (facture_proformat_id)');
//    }
//}
