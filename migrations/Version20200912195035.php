<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200912195035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE shift_work (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shift_id INTEGER DEFAULT NULL, resource_id INTEGER DEFAULT NULL, resource_group_id INTEGER NOT NULL, current_place CLOB DEFAULT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE INDEX IDX_6677174FBB70BC0E ON shift_work (shift_id)');
        $this->addSql('CREATE INDEX IDX_6677174F89329D25 ON shift_work (resource_id)');
        $this->addSql('CREATE INDEX IDX_6677174F50D813EA ON shift_work (resource_group_id)');
        $this->addSql('CREATE TABLE rule (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, rule VARCHAR(255) NOT NULL, priority INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE dependency (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shift_id INTEGER DEFAULT NULL, resource_group_id INTEGER DEFAULT NULL, number INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_2F585505BB70BC0E ON dependency (shift_id)');
        $this->addSql('CREATE INDEX IDX_2F58550550D813EA ON dependency (resource_group_id)');
        $this->addSql('CREATE TABLE shift (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER DEFAULT NULL, start DATETIME DEFAULT NULL, "end" DATETIME DEFAULT NULL, name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_A50B3B45166D1F9C ON shift (project_id)');
        $this->addSql('CREATE TABLE project (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE project_organisation_unit (project_id INTEGER NOT NULL, organisation_unit_id INTEGER NOT NULL, PRIMARY KEY(project_id, organisation_unit_id))');
        $this->addSql('CREATE INDEX IDX_AA2C5074166D1F9C ON project_organisation_unit (project_id)');
        $this->addSql('CREATE INDEX IDX_AA2C50749B39070E ON project_organisation_unit (organisation_unit_id)');
        $this->addSql('CREATE TABLE resource_group (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, code VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE organisation_unit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE organisation_unit_resource (organisation_unit_id INTEGER NOT NULL, resource_id INTEGER NOT NULL, PRIMARY KEY(organisation_unit_id, resource_id))');
        $this->addSql('CREATE INDEX IDX_2C6304E09B39070E ON organisation_unit_resource (organisation_unit_id)');
        $this->addSql('CREATE INDEX IDX_2C6304E089329D25 ON organisation_unit_resource (resource_id)');
        $this->addSql('CREATE TABLE resource (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE resource_resource_group (resource_id INTEGER NOT NULL, resource_group_id INTEGER NOT NULL, PRIMARY KEY(resource_id, resource_group_id))');
        $this->addSql('CREATE INDEX IDX_3435B55489329D25 ON resource_resource_group (resource_id)');
        $this->addSql('CREATE INDEX IDX_3435B55450D813EA ON resource_resource_group (resource_group_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE shift_work');
        $this->addSql('DROP TABLE rule');
        $this->addSql('DROP TABLE dependency');
        $this->addSql('DROP TABLE shift');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_organisation_unit');
        $this->addSql('DROP TABLE resource_group');
        $this->addSql('DROP TABLE organisation_unit');
        $this->addSql('DROP TABLE organisation_unit_resource');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE resource_resource_group');
    }
}
