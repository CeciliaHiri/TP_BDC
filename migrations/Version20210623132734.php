<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623132734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommation ADD facture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consommation ADD CONSTRAINT FK_F993F0A27F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE INDEX IDX_F993F0A27F2DEE08 ON consommation (facture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommation DROP FOREIGN KEY FK_F993F0A27F2DEE08');
        $this->addSql('DROP INDEX IDX_F993F0A27F2DEE08 ON consommation');
        $this->addSql('ALTER TABLE consommation DROP facture_id');
    }
}
