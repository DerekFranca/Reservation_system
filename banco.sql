Create database reserva;
use reserva;

CREATE TABLE espacos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    capacidade INT NOT NULL,
    descricao TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(15),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    espaco_id INT NOT NULL,
    data_reserva DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fim TIME NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (espaco_id) REFERENCES espacos(id),
    UNIQUE (espaco_id, data_reserva, hora_inicio, hora_fim) 
);


SELECT 
    r.id AS reserva_id, 
    u.nome AS usuario, 
    e.nome AS espaco, 
    r.data_reserva, 
    r.hora_inicio, 
    r.hora_fim
FROM reservas r
JOIN usuarios u ON r.usuario_id = u.id
JOIN espacos e ON r.espaco_id = e.id
ORDER BY r.data_reserva, r.hora_inicio;

SELECT * FROM reservas 
WHERE espaco_id = ? 
AND data_reserva = ? 
AND (
    (hora_inicio <= ? AND hora_fim > ?) OR 
    (hora_inicio < ? AND hora_fim >= ?)
);

 
INSERT INTO reservas (usuario_id, espaco_id, data_reserva, hora_inicio, hora_fim) 
VALUES (?, ?, ?, ?, ?);



SELECT 
    e.nome AS espaco, 
    COUNT(r.id) AS total_reservas 
FROM espacos e
LEFT JOIN reservas r ON e.id = r.espaco_id
GROUP BY e.id
ORDER BY total_reservas DESC;


