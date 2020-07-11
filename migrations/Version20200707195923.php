<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200707195923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, numch VARCHAR(255) NOT NULL, numbatiment VARCHAR(255) NOT NULL, type_chambre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, numch_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, type_etudiant VARCHAR(255) NOT NULL, type_bourse VARCHAR(255) DEFAULT NULL, profil VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, INDEX IDX_717E22E3137940BB (numch_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3137940BB FOREIGN KEY (numch_id) REFERENCES chambre (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3137940BB');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE etudiant');
    }
}
