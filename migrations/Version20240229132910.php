<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229132910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart ADD person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_BA388B7217BBB47 ON cart (person_id)');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1761AD5CDBF');
        $this->addSql('DROP INDEX UNIQ_34DCD1761AD5CDBF ON person');
        $this->addSql('ALTER TABLE person DROP cart_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7217BBB47');
        $this->addSql('DROP INDEX IDX_BA388B7217BBB47 ON cart');
        $this->addSql('ALTER TABLE cart DROP person_id');
        $this->addSql('ALTER TABLE person ADD cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1761AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD1761AD5CDBF ON person (cart_id)');
    }
}
