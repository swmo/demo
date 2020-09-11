<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200911203613 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE shift_work ADD COLUMN current_place CLOB DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_6677174FBB70BC0E');
        $this->addSql('DROP INDEX IDX_6677174F89329D25');
        $this->addSql('DROP INDEX IDX_6677174F50D813EA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__shift_work AS SELECT id, shift_id, resource_id, resource_group_id FROM shift_work');
        $this->addSql('DROP TABLE shift_work');
        $this->addSql('CREATE TABLE shift_work (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shift_id INTEGER DEFAULT NULL, resource_id INTEGER DEFAULT NULL, resource_group_id INTEGER NOT NULL, CONSTRAINT FK_6677174FBB70BC0E FOREIGN KEY (shift_id) REFERENCES shift (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6677174F89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6677174F50D813EA FOREIGN KEY (resource_group_id) REFERENCES resource_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO shift_work (id, shift_id, resource_id, resource_group_id) SELECT id, shift_id, resource_id, resource_group_id FROM __temp__shift_work');
        $this->addSql('DROP TABLE __temp__shift_work');
        $this->addSql('CREATE INDEX IDX_6677174FBB70BC0E ON shift_work (shift_id)');
        $this->addSql('CREATE INDEX IDX_6677174F89329D25 ON shift_work (resource_id)');
        $this->addSql('CREATE INDEX IDX_6677174F50D813EA ON shift_work (resource_group_id)');
    }
}
