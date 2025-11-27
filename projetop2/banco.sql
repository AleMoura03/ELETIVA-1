
USE projetophp;

CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    senha VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS paciente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    data_nascimento DATE
);

CREATE TABLE IF NOT EXISTS medico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especialidade VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS horario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NULL,
    medico_id INT NOT NULL,
    data_atendimento DATETIME NOT NULL,
    FOREIGN KEY (paciente_id) REFERENCES paciente(id),
    FOREIGN KEY (medico_id) REFERENCES medico(id)
);

CREATE TABLE IF NOT EXISTS agendamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NOT NULL,
    horario_id INT NOT NULL,
    status VARCHAR(50) DEFAULT 'Agendado',
    FOREIGN KEY (paciente_id) REFERENCES paciente(id),
    FOREIGN KEY (horario_id) REFERENCES horario(id)
);

USE projetophp;
SHOW CREATE TABLE agendamento;
SHOW CREATE TABLE horario;
SHOW CREATE TABLE medico;
SHOW CREATE TABLE paciente;

USE projetophp;

SELECT CONSTRAINT_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'projetophp'
  AND TABLE_NAME = 'agendamento'
  AND COLUMN_NAME = 'horario_id';

ALTER TABLE agendamento DROP FOREIGN KEY agendamento_ibfk_2;

ALTER TABLE agendamento DROP COLUMN IF EXISTS horario_id;

ALTER TABLE agendamento
  ADD COLUMN medico_id INT NOT NULL AFTER paciente_id,
  ADD COLUMN data_hora DATETIME NOT NULL AFTER medico_id,
  ADD CONSTRAINT fk_agendamento_medico FOREIGN KEY (medico_id) REFERENCES medico(id);

CREATE INDEX idx_agendamento_medico_data ON agendamento (medico_id, data_hora);
