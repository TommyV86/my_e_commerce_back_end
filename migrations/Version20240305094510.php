<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305094510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE6BF700BD');
        $this->addSql('DROP INDEX UNIQ_E00CEDDE6BF700BD ON booking');
        $this->addSql('ALTER TABLE booking ADD status TINYINT(1) DEFAULT NULL, DROP status_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD status_id INT DEFAULT NULL, DROP status');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E00CEDDE6BF700BD ON booking (status_id)');
    }
}
