<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200910175427 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE shift_work (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shift_id INTEGER DEFAULT NULL, resource_id INTEGER DEFAULT NULL, CONSTRAINT FK_6677174FBB70BC0E FOREIGN KEY (shift_id) REFERENCES shift (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6677174F89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6677174FBB70BC0E ON shift_work (shift_id)');
        $this->addSql('CREATE INDEX IDX_6677174F89329D25 ON shift_work (resource_id)');
        $this->addSql('DROP INDEX IDX_2F58550550D813EA');
        $this->addSql('DROP INDEX IDX_2F585505BB70BC0E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__dependency AS SELECT id, shift_id, resource_group_id, number FROM dependency');
        $this->addSql('DROP TABLE dependency');
        $this->addSql('CREATE TABLE dependency (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shift_id INTEGER DEFAULT NULL, resource_group_id INTEGER DEFAULT NULL, number INTEGER NOT NULL, CONSTRAINT FK_2F585505BB70BC0E FOREIGN KEY (shift_id) REFERENCES shift (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2F58550550D813EA FOREIGN KEY (resource_group_id) REFERENCES resource_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO dependency (id, shift_id, resource_group_id, number) SELECT id, shift_id, resource_group_id, number FROM __temp__dependency');
        $this->addSql('DROP TABLE __temp__dependency');
        $this->addSql('CREATE INDEX IDX_2F58550550D813EA ON dependency (resource_group_id)');
        $this->addSql('CREATE INDEX IDX_2F585505BB70BC0E ON dependency (shift_id)');
        $this->addSql('DROP INDEX IDX_3435B55450D813EA');
        $this->addSql('DROP INDEX IDX_3435B55489329D25');
        $this->addSql('CREATE TEMPORARY TABLE __temp__resource_resource_group AS SELECT resource_id, resource_group_id FROM resource_resource_group');
        $this->addSql('DROP TABLE resource_resource_group');
        $this->addSql('CREATE TABLE resource_resource_group (resource_id INTEGER NOT NULL, resource_group_id INTEGER NOT NULL, PRIMARY KEY(resource_id, resource_group_id), CONSTRAINT FK_3435B55489329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_3435B55450D813EA FOREIGN KEY (resource_group_id) REFERENCES resource_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO resource_resource_group (resource_id, resource_group_id) SELECT resource_id, resource_group_id FROM __temp__resource_resource_group');
        $this->addSql('DROP TABLE __temp__resource_resource_group');
        $this->addSql('CREATE INDEX IDX_3435B55450D813EA ON resource_resource_group (resource_group_id)');
        $this->addSql('CREATE INDEX IDX_3435B55489329D25 ON resource_resource_group (resource_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE shift_work');
        $this->addSql('DROP INDEX IDX_2F585505BB70BC0E');
        $this->addSql('DROP INDEX IDX_2F58550550D813EA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__dependency AS SELECT id, shift_id, resource_group_id, number FROM dependency');
        $this->addSql('DROP TABLE dependency');
        $this->addSql('CREATE TABLE dependency (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shift_id INTEGER DEFAULT NULL, resource_group_id INTEGER DEFAULT NULL, number INTEGER NOT NULL)');
        $this->addSql('INSERT INTO dependency (id, shift_id, resource_group_id, number) SELECT id, shift_id, resource_group_id, number FROM __temp__dependency');
        $this->addSql('DROP TABLE __temp__dependency');
        $this->addSql('CREATE INDEX IDX_2F585505BB70BC0E ON dependency (shift_id)');
        $this->addSql('CREATE INDEX IDX_2F58550550D813EA ON dependency (resource_group_id)');
        $this->addSql('DROP INDEX IDX_3435B55489329D25');
        $this->addSql('DROP INDEX IDX_3435B55450D813EA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__resource_resource_group AS SELECT resource_id, resource_group_id FROM resource_resource_group');
        $this->addSql('DROP TABLE resource_resource_group');
        $this->addSql('CREATE TABLE resource_resource_group (resource_id INTEGER NOT NULL, resource_group_id INTEGER NOT NULL, PRIMARY KEY(resource_id, resource_group_id))');
        $this->addSql('INSERT INTO resource_resource_group (resource_id, resource_group_id) SELECT resource_id, resource_group_id FROM __temp__resource_resource_group');
        $this->addSql('DROP TABLE __temp__resource_resource_group');
        $this->addSql('CREATE INDEX IDX_3435B55489329D25 ON resource_resource_group (resource_id)');
        $this->addSql('CREATE INDEX IDX_3435B55450D813EA ON resource_resource_group (resource_group_id)');
    }
}
