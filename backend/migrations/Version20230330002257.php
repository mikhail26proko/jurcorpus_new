<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330002257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, login VARCHAR(25) NOT NULL, fio VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, is_active BOOLEAN NOT NULL, password VARCHAR(60) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON "user" (login)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE department (id UUID NOT NULL, name VARCHAR(120) NOT NULL, adress VARCHAR(255) NOT NULL, description VARCHAR(1000) NOT NULL, coordinates TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN department.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN department.coordinates IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE employee (id UUID NOT NULL, fio VARCHAR(120) NOT NULL, job_title VARCHAR(255) NOT NULL, description VARCHAR(1000) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN employee.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE employee_department (employee_id UUID NOT NULL, department_id UUID NOT NULL, PRIMARY KEY(employee_id, department_id))');
        $this->addSql('CREATE INDEX IDX_55CA515E8C03F15C ON employee_department (employee_id)');
        $this->addSql('CREATE INDEX IDX_55CA515EAE80F5DF ON employee_department (department_id)');
        $this->addSql('COMMENT ON COLUMN employee_department.employee_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN employee_department.department_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE employee_department ADD CONSTRAINT FK_55CA515E8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_department ADD CONSTRAINT FK_55CA515EAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE employee_department DROP CONSTRAINT FK_55CA515E8C03F15C');
        $this->addSql('ALTER TABLE employee_department DROP CONSTRAINT FK_55CA515EAE80F5DF');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_department');
    }
}
