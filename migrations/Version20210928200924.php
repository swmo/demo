<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210928200924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE event_resource (event_id INTEGER NOT NULL, resource_id INTEGER NOT NULL, PRIMARY KEY(event_id, resource_id))');
        $this->addSql('CREATE INDEX IDX_FA7D1DC671F7E88B ON event_resource (event_id)');
        $this->addSql('CREATE INDEX IDX_FA7D1DC689329D25 ON event_resource (resource_id)');
        $this->addSql('DROP INDEX IDX_6677174FBB70BC0E');
        $this->addSql('DROP INDEX IDX_6677174F89329D25');
        $this->addSql('DROP INDEX IDX_6677174F50D813EA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__shift_work AS SELECT id, shift_id, resource_id, resource_group_id, current_place FROM shift_work');
        $this->addSql('DROP TABLE shift_work');
        $this->addSql('CREATE TABLE shift_work (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shift_id INTEGER DEFAULT NULL, resource_id INTEGER DEFAULT NULL, resource_group_id INTEGER NOT NULL, current_place CLOB DEFAULT NULL --(DC2Type:json)
        , CONSTRAINT FK_6677174FBB70BC0E FOREIGN KEY (shift_id) REFERENCES shift (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6677174F89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6677174F50D813EA FOREIGN KEY (resource_group_id) REFERENCES resource_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO shift_work (id, shift_id, resource_id, resource_group_id, current_place) SELECT id, shift_id, resource_id, resource_group_id, current_place FROM __temp__shift_work');
        $this->addSql('DROP TABLE __temp__shift_work');
        $this->addSql('CREATE INDEX IDX_6677174FBB70BC0E ON shift_work (shift_id)');
        $this->addSql('CREATE INDEX IDX_6677174F89329D25 ON shift_work (resource_id)');
        $this->addSql('CREATE INDEX IDX_6677174F50D813EA ON shift_work (resource_group_id)');
        $this->addSql('DROP INDEX IDX_2F585505BB70BC0E');
        $this->addSql('DROP INDEX IDX_2F58550550D813EA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__dependency AS SELECT id, shift_id, resource_group_id, number FROM dependency');
        $this->addSql('DROP TABLE dependency');
        $this->addSql('CREATE TABLE dependency (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shift_id INTEGER DEFAULT NULL, resource_group_id INTEGER DEFAULT NULL, number INTEGER NOT NULL, CONSTRAINT FK_2F585505BB70BC0E FOREIGN KEY (shift_id) REFERENCES shift (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2F58550550D813EA FOREIGN KEY (resource_group_id) REFERENCES resource_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO dependency (id, shift_id, resource_group_id, number) SELECT id, shift_id, resource_group_id, number FROM __temp__dependency');
        $this->addSql('DROP TABLE __temp__dependency');
        $this->addSql('CREATE INDEX IDX_2F585505BB70BC0E ON dependency (shift_id)');
        $this->addSql('CREATE INDEX IDX_2F58550550D813EA ON dependency (resource_group_id)');
        $this->addSql('DROP INDEX IDX_A50B3B45166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__shift AS SELECT id, project_id, start, "end", name FROM shift');
        $this->addSql('DROP TABLE shift');
        $this->addSql('CREATE TABLE shift (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER DEFAULT NULL, start DATETIME DEFAULT NULL, "end" DATETIME DEFAULT NULL, name VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_A50B3B45166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO shift (id, project_id, start, "end", name) SELECT id, project_id, start, "end", name FROM __temp__shift');
        $this->addSql('DROP TABLE __temp__shift');
        $this->addSql('CREATE INDEX IDX_A50B3B45166D1F9C ON shift (project_id)');
        $this->addSql('DROP INDEX IDX_AA2C5074166D1F9C');
        $this->addSql('DROP INDEX IDX_AA2C50749B39070E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__project_organisation_unit AS SELECT project_id, organisation_unit_id FROM project_organisation_unit');
        $this->addSql('DROP TABLE project_organisation_unit');
        $this->addSql('CREATE TABLE project_organisation_unit (project_id INTEGER NOT NULL, organisation_unit_id INTEGER NOT NULL, PRIMARY KEY(project_id, organisation_unit_id), CONSTRAINT FK_AA2C5074166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AA2C50749B39070E FOREIGN KEY (organisation_unit_id) REFERENCES organisation_unit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO project_organisation_unit (project_id, organisation_unit_id) SELECT project_id, organisation_unit_id FROM __temp__project_organisation_unit');
        $this->addSql('DROP TABLE __temp__project_organisation_unit');
        $this->addSql('CREATE INDEX IDX_AA2C5074166D1F9C ON project_organisation_unit (project_id)');
        $this->addSql('CREATE INDEX IDX_AA2C50749B39070E ON project_organisation_unit (organisation_unit_id)');
        $this->addSql('DROP INDEX IDX_81DF7FCD89329D25');
        $this->addSql('DROP INDEX IDX_81DF7FCD166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__project_resource AS SELECT project_id, resource_id FROM project_resource');
        $this->addSql('DROP TABLE project_resource');
        $this->addSql('CREATE TABLE project_resource (project_id INTEGER NOT NULL, resource_id INTEGER NOT NULL, PRIMARY KEY(project_id, resource_id), CONSTRAINT FK_81DF7FCD166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_81DF7FCD89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO project_resource (project_id, resource_id) SELECT project_id, resource_id FROM __temp__project_resource');
        $this->addSql('DROP TABLE __temp__project_resource');
        $this->addSql('CREATE INDEX IDX_81DF7FCD89329D25 ON project_resource (resource_id)');
        $this->addSql('CREATE INDEX IDX_81DF7FCD166D1F9C ON project_resource (project_id)');
        $this->addSql('DROP INDEX IDX_2C6304E09B39070E');
        $this->addSql('DROP INDEX IDX_2C6304E089329D25');
        $this->addSql('CREATE TEMPORARY TABLE __temp__organisation_unit_resource AS SELECT organisation_unit_id, resource_id FROM organisation_unit_resource');
        $this->addSql('DROP TABLE organisation_unit_resource');
        $this->addSql('CREATE TABLE organisation_unit_resource (organisation_unit_id INTEGER NOT NULL, resource_id INTEGER NOT NULL, PRIMARY KEY(organisation_unit_id, resource_id), CONSTRAINT FK_2C6304E09B39070E FOREIGN KEY (organisation_unit_id) REFERENCES organisation_unit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2C6304E089329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO organisation_unit_resource (organisation_unit_id, resource_id) SELECT organisation_unit_id, resource_id FROM __temp__organisation_unit_resource');
        $this->addSql('DROP TABLE __temp__organisation_unit_resource');
        $this->addSql('CREATE INDEX IDX_2C6304E09B39070E ON organisation_unit_resource (organisation_unit_id)');
        $this->addSql('CREATE INDEX IDX_2C6304E089329D25 ON organisation_unit_resource (resource_id)');
        $this->addSql('DROP INDEX IDX_3435B55489329D25');
        $this->addSql('DROP INDEX IDX_3435B55450D813EA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__resource_resource_group AS SELECT resource_id, resource_group_id FROM resource_resource_group');
        $this->addSql('DROP TABLE resource_resource_group');
        $this->addSql('CREATE TABLE resource_resource_group (resource_id INTEGER NOT NULL, resource_group_id INTEGER NOT NULL, PRIMARY KEY(resource_id, resource_group_id), CONSTRAINT FK_3435B55489329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_3435B55450D813EA FOREIGN KEY (resource_group_id) REFERENCES resource_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO resource_resource_group (resource_id, resource_group_id) SELECT resource_id, resource_group_id FROM __temp__resource_resource_group');
        $this->addSql('DROP TABLE __temp__resource_resource_group');
        $this->addSql('CREATE INDEX IDX_3435B55489329D25 ON resource_resource_group (resource_id)');
        $this->addSql('CREATE INDEX IDX_3435B55450D813EA ON resource_resource_group (resource_group_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE event_resource');
        $this->addSql('DROP INDEX IDX_2F585505BB70BC0E');
        $this->addSql('DROP INDEX IDX_2F58550550D813EA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__dependency AS SELECT id, shift_id, resource_group_id, number FROM dependency');
        $this->addSql('DROP TABLE dependency');
        $this->addSql('CREATE TABLE dependency (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shift_id INTEGER DEFAULT NULL, resource_group_id INTEGER DEFAULT NULL, number INTEGER NOT NULL)');
        $this->addSql('INSERT INTO dependency (id, shift_id, resource_group_id, number) SELECT id, shift_id, resource_group_id, number FROM __temp__dependency');
        $this->addSql('DROP TABLE __temp__dependency');
        $this->addSql('CREATE INDEX IDX_2F585505BB70BC0E ON dependency (shift_id)');
        $this->addSql('CREATE INDEX IDX_2F58550550D813EA ON dependency (resource_group_id)');
        $this->addSql('DROP INDEX IDX_2C6304E09B39070E');
        $this->addSql('DROP INDEX IDX_2C6304E089329D25');
        $this->addSql('CREATE TEMPORARY TABLE __temp__organisation_unit_resource AS SELECT organisation_unit_id, resource_id FROM organisation_unit_resource');
        $this->addSql('DROP TABLE organisation_unit_resource');
        $this->addSql('CREATE TABLE organisation_unit_resource (organisation_unit_id INTEGER NOT NULL, resource_id INTEGER NOT NULL, PRIMARY KEY(organisation_unit_id, resource_id))');
        $this->addSql('INSERT INTO organisation_unit_resource (organisation_unit_id, resource_id) SELECT organisation_unit_id, resource_id FROM __temp__organisation_unit_resource');
        $this->addSql('DROP TABLE __temp__organisation_unit_resource');
        $this->addSql('CREATE INDEX IDX_2C6304E09B39070E ON organisation_unit_resource (organisation_unit_id)');
        $this->addSql('CREATE INDEX IDX_2C6304E089329D25 ON organisation_unit_resource (resource_id)');
        $this->addSql('DROP INDEX IDX_AA2C5074166D1F9C');
        $this->addSql('DROP INDEX IDX_AA2C50749B39070E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__project_organisation_unit AS SELECT project_id, organisation_unit_id FROM project_organisation_unit');
        $this->addSql('DROP TABLE project_organisation_unit');
        $this->addSql('CREATE TABLE project_organisation_unit (project_id INTEGER NOT NULL, organisation_unit_id INTEGER NOT NULL, PRIMARY KEY(project_id, organisation_unit_id))');
        $this->addSql('INSERT INTO project_organisation_unit (project_id, organisation_unit_id) SELECT project_id, organisation_unit_id FROM __temp__project_organisation_unit');
        $this->addSql('DROP TABLE __temp__project_organisation_unit');
        $this->addSql('CREATE INDEX IDX_AA2C5074166D1F9C ON project_organisation_unit (project_id)');
        $this->addSql('CREATE INDEX IDX_AA2C50749B39070E ON project_organisation_unit (organisation_unit_id)');
        $this->addSql('DROP INDEX IDX_81DF7FCD166D1F9C');
        $this->addSql('DROP INDEX IDX_81DF7FCD89329D25');
        $this->addSql('CREATE TEMPORARY TABLE __temp__project_resource AS SELECT project_id, resource_id FROM project_resource');
        $this->addSql('DROP TABLE project_resource');
        $this->addSql('CREATE TABLE project_resource (project_id INTEGER NOT NULL, resource_id INTEGER NOT NULL, PRIMARY KEY(project_id, resource_id))');
        $this->addSql('INSERT INTO project_resource (project_id, resource_id) SELECT project_id, resource_id FROM __temp__project_resource');
        $this->addSql('DROP TABLE __temp__project_resource');
        $this->addSql('CREATE INDEX IDX_81DF7FCD166D1F9C ON project_resource (project_id)');
        $this->addSql('CREATE INDEX IDX_81DF7FCD89329D25 ON project_resource (resource_id)');
        $this->addSql('DROP INDEX IDX_3435B55489329D25');
        $this->addSql('DROP INDEX IDX_3435B55450D813EA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__resource_resource_group AS SELECT resource_id, resource_group_id FROM resource_resource_group');
        $this->addSql('DROP TABLE resource_resource_group');
        $this->addSql('CREATE TABLE resource_resource_group (resource_id INTEGER NOT NULL, resource_group_id INTEGER NOT NULL, PRIMARY KEY(resource_id, resource_group_id))');
        $this->addSql('INSERT INTO resource_resource_group (resource_id, resource_group_id) SELECT resource_id, resource_group_id FROM __temp__resource_resource_group');
        $this->addSql('DROP TABLE __temp__resource_resource_group');
        $this->addSql('CREATE INDEX IDX_3435B55489329D25 ON resource_resource_group (resource_id)');
        $this->addSql('CREATE INDEX IDX_3435B55450D813EA ON resource_resource_group (resource_group_id)');
        $this->addSql('DROP INDEX IDX_A50B3B45166D1F9C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__shift AS SELECT id, project_id, start, "end", name FROM shift');
        $this->addSql('DROP TABLE shift');
        $this->addSql('CREATE TABLE shift (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, project_id INTEGER DEFAULT NULL, start DATETIME DEFAULT NULL, "end" DATETIME DEFAULT NULL, name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO shift (id, project_id, start, "end", name) SELECT id, project_id, start, "end", name FROM __temp__shift');
        $this->addSql('DROP TABLE __temp__shift');
        $this->addSql('CREATE INDEX IDX_A50B3B45166D1F9C ON shift (project_id)');
        $this->addSql('DROP INDEX IDX_6677174FBB70BC0E');
        $this->addSql('DROP INDEX IDX_6677174F89329D25');
        $this->addSql('DROP INDEX IDX_6677174F50D813EA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__shift_work AS SELECT id, shift_id, resource_id, resource_group_id, current_place FROM shift_work');
        $this->addSql('DROP TABLE shift_work');
        $this->addSql('CREATE TABLE shift_work (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, shift_id INTEGER DEFAULT NULL, resource_id INTEGER DEFAULT NULL, resource_group_id INTEGER NOT NULL, current_place CLOB DEFAULT \'NULL --(DC2Type:json)\' COLLATE BINARY --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO shift_work (id, shift_id, resource_id, resource_group_id, current_place) SELECT id, shift_id, resource_id, resource_group_id, current_place FROM __temp__shift_work');
        $this->addSql('DROP TABLE __temp__shift_work');
        $this->addSql('CREATE INDEX IDX_6677174FBB70BC0E ON shift_work (shift_id)');
        $this->addSql('CREATE INDEX IDX_6677174F89329D25 ON shift_work (resource_id)');
        $this->addSql('CREATE INDEX IDX_6677174F50D813EA ON shift_work (resource_group_id)');
    }
}
