<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623131848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE station ADD operateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B13F192FC FOREIGN KEY (operateur_id) REFERENCES operateur (id)');
        $this->addSql('CREATE INDEX IDX_9F39F8B13F192FC ON station (operateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B13F192FC');
        $this->addSql('DROP INDEX IDX_9F39F8B13F192FC ON station');
        $this->addSql('ALTER TABLE station DROP operateur_id');
    }
}
