<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322152622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courrier ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE courrier ADD CONSTRAINT FK_BEF47CAAFD128646 FOREIGN KEY (delivery_man_id) REFERENCES livreur (id)');
        $this->addSql('CREATE INDEX IDX_BEF47CAAFD128646 ON courrier (delivery_man_id)');
        $this->addSql('ALTER TABLE livreur DROP role');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courrier DROP FOREIGN KEY FK_BEF47CAAFD128646');
        $this->addSql('DROP INDEX IDX_BEF47CAAFD128646 ON courrier');
        $this->addSql('ALTER TABLE courrier DROP type');
        $this->addSql('ALTER TABLE livreur ADD role VARCHAR(255) NOT NULL');
    }
}
