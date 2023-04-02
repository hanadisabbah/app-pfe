<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230401211558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique ADD courrier_id INT NOT NULL');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC8BF41DC7 FOREIGN KEY (courrier_id) REFERENCES courrier (id)');
        $this->addSql('CREATE INDEX IDX_EDBFD5EC8BF41DC7 ON historique (courrier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC8BF41DC7');
        $this->addSql('DROP INDEX IDX_EDBFD5EC8BF41DC7 ON historique');
        $this->addSql('ALTER TABLE historique DROP courrier_id');
    }
}
