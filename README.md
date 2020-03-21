# Configuração da aplicação backend:

No ``` http://localhost/phpmyadmin/ ``` crie um banco chamado convenio e jogue o codigo abaixo para criar as definições:

``` 
CREATE TABLE plano (
                pk_plano INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(255) NOT NULL,
                PRIMARY KEY (pk_plano)
);


CREATE TABLE paciente (
                pk_paciente INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(255) NOT NULL,
                endereco VARCHAR(255) NOT NULL,
                cidade VARCHAR(255),
                estado VARCHAR(255),
                telefone VARCHAR(255),
                email VARCHAR(255) NOT NULL,
                senha VARCHAR(255) NOT NULL,
                cpf VARCHAR(255) NOT NULL,
                nome_da_mae VARCHAR(255),
                nome_do_pai VARCHAR(255),
                numero_da_carteira_do_plano_de_saude VARCHAR(255) NOT NULL,
                PRIMARY KEY (pk_paciente)
);


CREATE TABLE convenio (
                fk_plano INT NOT NULL,
                fk_paciente INT NOT NULL,
                PRIMARY KEY (fk_plano, fk_paciente)
);


ALTER TABLE convenio ADD CONSTRAINT plano_paciente_plano_fk
FOREIGN KEY (fk_plano)
REFERENCES plano (pk_plano)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

ALTER TABLE convenio ADD CONSTRAINT paciente_paciente_plano_fk
FOREIGN KEY (fk_paciente)
REFERENCES paciente (pk_paciente)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

insert into plano(nome) values ("Alfa");
insert into plano(nome) values ("Beta");
insert into plano(nome) values ("Gama");
insert into plano(nome) values ("Delta");       
insert into plano(nome) values ("Ômega"); 

```