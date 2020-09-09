<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200909200155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE dependency (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shift_id INTEGER DEFAULT NULL, resource_group_id INTEGER DEFAULT NULL, number INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_2F585505BB70BC0E ON dependency (shift_id)');
        $this->addSql('CREATE INDEX IDX_2F58550550D813EA ON dependency (resource_group_id)');
        $this->addSql('CREATE TABLE shift (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, start DATETIME DEFAULT NULL, "end" DATETIME DEFAULT NULL, name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE block (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, start DATETIME DEFAULT NULL, "end" DATETIME DEFAULT NULL, type VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE resource_group (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, code VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE resource (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE resource_resource_group (resource_id INTEGER NOT NULL, resource_group_id INTEGER NOT NULL, PRIMARY KEY(resource_id, resource_group_id))');
        $this->addSql('CREATE INDEX IDX_3435B55489329D25 ON resource_resource_group (resource_id)');
        $this->addSql('CREATE INDEX IDX_3435B55450D813EA ON resource_resource_group (resource_group_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE dependency');
        $this->addSql('DROP TABLE shift');
        $this->addSql('DROP TABLE block');
        $this->addSql('DROP TABLE resource_group');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE resource_resource_group');
    }
}
