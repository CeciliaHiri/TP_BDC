<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210628132137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consommation (id INT AUTO_INCREMENT NOT NULL, station_id INT DEFAULT NULL, client_id INT DEFAULT NULL, facture_id INT DEFAULT NULL, numero INT NOT NULL, date_debut_contrat DATE NOT NULL, quantite DOUBLE PRECISION NOT NULL, date_heure_connexion DATETIME NOT NULL, date_heure_deconnexion DATETIME NOT NULL, id_station_local VARCHAR(255) NOT NULL, INDEX IDX_F993F0A221BDB235 (station_id), INDEX IDX_F993F0A219EB6921 (client_id), INDEX IDX_F993F0A27F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, montant DOUBLE PRECISION NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, operateur_id INT DEFAULT NULL, nom_station VARCHAR(80) NOT NULL, date_mise_en_service DATE DEFAULT NULL, nb_bornes INT NOT NULL, adresse_station VARCHAR(255) NOT NULL, tarification DOUBLE PRECISION DEFAULT NULL, localisation VARCHAR(255) DEFAULT NULL, id_station VARCHAR(255) NOT NULL, positionx DOUBLE PRECISION DEFAULT NULL, positiony DOUBLE PRECISION DEFAULT NULL, INDEX IDX_9F39F8B13F192FC (operateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consommation ADD CONSTRAINT FK_F993F0A221BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE consommation ADD CONSTRAINT FK_F993F0A219EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE consommation ADD CONSTRAINT FK_F993F0A27F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B13F192FC FOREIGN KEY (operateur_id) REFERENCES operateur (id)');
        $this->addSql('ALTER TABLE operateur ADD adresse VARCHAR(400) DEFAULT NULL, ADD tarif DOUBLE PRECISION DEFAULT NULL, CHANGE date_fin_contrat date_fin_contrat DATE DEFAULT NULL, CHANGE date_debut_contrat date_debut_contrat DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommation DROP FOREIGN KEY FK_F993F0A27F2DEE08');
        $this->addSql('ALTER TABLE consommation DROP FOREIGN KEY FK_F993F0A221BDB235');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE consommation');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE operateur DROP adresse, DROP tarif, CHANGE date_fin_contrat date_fin_contrat DATE NOT NULL, CHANGE date_debut_contrat date_debut_contrat DATE NOT NULL');
    }
}
