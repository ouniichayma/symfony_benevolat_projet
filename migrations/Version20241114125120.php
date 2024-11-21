<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114125120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE benevole_zone DROP FOREIGN KEY FK_41F7B7B49F2C3FAB');
        $this->addSql('ALTER TABLE benevole_zone DROP FOREIGN KEY FK_41F7B7B4E77B7C09');
        $this->addSql('ALTER TABLE disponibilite DROP FOREIGN KEY FK_2CBACE2FE77B7C09');
        $this->addSql('DROP TABLE benevole_zone');
        $this->addSql('DROP TABLE disponibilite');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6C18272');
        $this->addSql('DROP INDEX IDX_5E90F6D6C18272 ON inscription');
        $this->addSql('ALTER TABLE inscription CHANGE projet_id mission_id INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6BE6CAE90 ON inscription (mission_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE benevole_zone (benevole_id INT NOT NULL, zone_id INT NOT NULL, INDEX IDX_41F7B7B4E77B7C09 (benevole_id), INDEX IDX_41F7B7B49F2C3FAB (zone_id), PRIMARY KEY(benevole_id, zone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE disponibilite (id INT AUTO_INCREMENT NOT NULL, benevole_id INT NOT NULL, jours_disponibles VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, heures_disponibles VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_2CBACE2FE77B7C09 (benevole_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE benevole_zone ADD CONSTRAINT FK_41F7B7B49F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE benevole_zone ADD CONSTRAINT FK_41F7B7B4E77B7C09 FOREIGN KEY (benevole_id) REFERENCES benevole (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE disponibilite ADD CONSTRAINT FK_2CBACE2FE77B7C09 FOREIGN KEY (benevole_id) REFERENCES benevole (id)');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6BE6CAE90');
        $this->addSql('DROP INDEX IDX_5E90F6D6BE6CAE90 ON inscription');
        $this->addSql('ALTER TABLE inscription CHANGE mission_id projet_id INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6C18272 ON inscription (projet_id)');
    }
}
