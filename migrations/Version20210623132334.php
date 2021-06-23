<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623132334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommation ADD station_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consommation ADD CONSTRAINT FK_F993F0A221BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('CREATE INDEX IDX_F993F0A221BDB235 ON consommation (station_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommation DROP FOREIGN KEY FK_F993F0A221BDB235');
        $this->addSql('DROP INDEX IDX_F993F0A221BDB235 ON consommation');
        $this->addSql('ALTER TABLE consommation DROP station_id');
    }
}
