<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624151035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE operateur CHANGE adresse adresse VARCHAR(400) DEFAULT NULL, CHANGE tarif tarif DOUBLE PRECISION DEFAULT NULL, CHANGE date_fin_contrat date_fin_contrat DATE DEFAULT NULL, CHANGE date_debut_contrat date_debut_contrat DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE operateur CHANGE adresse adresse VARCHAR(400) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tarif tarif DOUBLE PRECISION NOT NULL, CHANGE date_fin_contrat date_fin_contrat DATE NOT NULL, CHANGE date_debut_contrat date_debut_contrat DATE NOT NULL');
    }
}
