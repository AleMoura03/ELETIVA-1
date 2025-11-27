CREATE DATABASE IF NOT EXISTS sistema_agendamento;
USE sistema_agendamento;

CREATE TABLE usuario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  senha TEXT NOT NULL
);

CREATE TABLE paciente (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  telefone VARCHAR(20)
);

CREATE TABLE medico (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  especialidade VARCHAR(100)
);

CREATE TABLE horario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  data DATE NOT NULL,
  hora TIME NOT NULL
);

CREATE TABLE agendamento (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_paciente INT NOT NULL,
  id_medico INT NOT NULL,
  id_horario INT NOT NULL,
  FOREIGN KEY (id_paciente) REFERENCES paciente(id),
  FOREIGN KEY (id_medico) REFERENCES medico(id),
  FOREIGN KEY (id_horario) REFERENCES horario(id)
);
