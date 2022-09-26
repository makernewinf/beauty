CREATE TABLE agenda( 
      id number(10)    NOT NULL , 
      dataag date   , 
      horaag time   , 
      cor varchar  (10)   , 
      clientes_id number(10)    NOT NULL , 
      profissionais_id number(10)    NOT NULL , 
      servicos_id number(10)    NOT NULL , 
      horario_inicial timestamp(0)   , 
      horario_final timestamp(0)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE clientes( 
      id number(10)    NOT NULL , 
      nome varchar  (100)   , 
      cpf number(10)   , 
      sexo varchar  (10)   , 
      telefone number(10)   , 
      celular number(10)   , 
      email varchar  (100)   , 
      datanasc date   , 
      datacad date   , 
      obs varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE contas( 
      id number(10)    NOT NULL , 
      documento number(10)   , 
      fornecedores_id number(10)    NOT NULL , 
      valor binary_double   , 
      grupo_contas_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE fornecedores( 
      id number(10)    NOT NULL , 
      nome varchar  (100)   , 
      empresa varchar  (100)   , 
      telefone number(10)   , 
      celular number(10)   , 
      email varchar  (100)   , 
      observacao varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_contas( 
      id number(10)    NOT NULL , 
      nome varchar  (100)   , 
      tipo varchar  (10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_produtos( 
      id number(10)    NOT NULL , 
      nome varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_servicos( 
      id number(10)    NOT NULL , 
      nome varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE horario_profissionais( 
      id number(10)    NOT NULL , 
      dia varchar  (10)   , 
      hora_inicio time   , 
      hora_final time   , 
      intervalo number(10)   , 
      profissionais_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE pagamentos( 
      id number(10)    NOT NULL , 
      datalanc date   , 
      datapgto date   , 
      formapgto varchar  (20)   , 
      desconto binary_double   , 
      valor binary_double   , 
      profissionais_id number(10)    NOT NULL , 
      clientes_id number(10)    NOT NULL , 
      tipo_pagamento_id number(10)    NOT NULL , 
      servicos_id number(10)    NOT NULL , 
      produtos_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE produtos( 
      id number(10)    NOT NULL , 
      descricao varchar  (100)   , 
      tipo varchar  (100)   , 
      custo binary_double   , 
      preco binary_double   , 
      estoque_min number(10)   , 
      estoque_atual number(10)   , 
      grupo_produtos_id number(10)    NOT NULL , 
      fornecedores_id number(10)    NOT NULL , 
      foto blob   , 
      nome_foto varchar  (100)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE profissionais( 
      id number(10)    NOT NULL , 
      nome varchar  (100)   , 
      telefone number(10)   , 
      celular number(10)   , 
      salario binary_double   , 
      cpf number(10)   , 
      comissao binary_double   , 
      tipo_profissionais_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE servicos( 
      id number(10)    NOT NULL , 
      nome varchar  (100)   , 
      grupo_servicos_id number(10)    NOT NULL , 
      valor binary_double   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_pagamento( 
      id number(10)    NOT NULL , 
      nome varchar  (20)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_profissionais( 
      id number(10)    NOT NULL , 
      nome varchar  (100)   , 
 PRIMARY KEY (id)) ; 

 
  
 ALTER TABLE agenda ADD CONSTRAINT fk_agenda_1 FOREIGN KEY (clientes_id) references clientes(id); 
ALTER TABLE agenda ADD CONSTRAINT fk_agenda_2 FOREIGN KEY (profissionais_id) references profissionais(id); 
ALTER TABLE agenda ADD CONSTRAINT fk_agenda_3 FOREIGN KEY (servicos_id) references servicos(id); 
ALTER TABLE contas ADD CONSTRAINT fk_contas_1 FOREIGN KEY (fornecedores_id) references fornecedores(id); 
ALTER TABLE contas ADD CONSTRAINT fk_contas_2 FOREIGN KEY (grupo_contas_id) references grupo_contas(id); 
ALTER TABLE horario_profissionais ADD CONSTRAINT fk_horario_profissionais_1 FOREIGN KEY (profissionais_id) references profissionais(id); 
ALTER TABLE pagamentos ADD CONSTRAINT fk_pagamentos_1 FOREIGN KEY (profissionais_id) references profissionais(id); 
ALTER TABLE pagamentos ADD CONSTRAINT fk_pagamentos_2 FOREIGN KEY (clientes_id) references clientes(id); 
ALTER TABLE pagamentos ADD CONSTRAINT fk_pagamentos_3 FOREIGN KEY (tipo_pagamento_id) references tipo_pagamento(id); 
ALTER TABLE pagamentos ADD CONSTRAINT fk_pagamentos_4 FOREIGN KEY (servicos_id) references servicos(id); 
ALTER TABLE pagamentos ADD CONSTRAINT fk_pagamentos_5 FOREIGN KEY (produtos_id) references produtos(id); 
ALTER TABLE produtos ADD CONSTRAINT fk_produtos_1 FOREIGN KEY (grupo_produtos_id) references grupo_produtos(id); 
ALTER TABLE produtos ADD CONSTRAINT fk_produtos_2 FOREIGN KEY (fornecedores_id) references fornecedores(id); 
ALTER TABLE profissionais ADD CONSTRAINT fk_profissionais_1 FOREIGN KEY (tipo_profissionais_id) references tipo_profissionais(id); 
ALTER TABLE servicos ADD CONSTRAINT fk_servicos_1 FOREIGN KEY (grupo_servicos_id) references grupo_servicos(id); 
 CREATE SEQUENCE agenda_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER agenda_id_seq_tr 

BEFORE INSERT ON agenda FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT agenda_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE clientes_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER clientes_id_seq_tr 

BEFORE INSERT ON clientes FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT clientes_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE contas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER contas_id_seq_tr 

BEFORE INSERT ON contas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT contas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE fornecedores_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER fornecedores_id_seq_tr 

BEFORE INSERT ON fornecedores FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT fornecedores_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE grupo_contas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER grupo_contas_id_seq_tr 

BEFORE INSERT ON grupo_contas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT grupo_contas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE grupo_produtos_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER grupo_produtos_id_seq_tr 

BEFORE INSERT ON grupo_produtos FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT grupo_produtos_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE grupo_servicos_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER grupo_servicos_id_seq_tr 

BEFORE INSERT ON grupo_servicos FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT grupo_servicos_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE horario_profissionais_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER horario_profissionais_id_seq_tr 

BEFORE INSERT ON horario_profissionais FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT horario_profissionais_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE pagamentos_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER pagamentos_id_seq_tr 

BEFORE INSERT ON pagamentos FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT pagamentos_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE produtos_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER produtos_id_seq_tr 

BEFORE INSERT ON produtos FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT produtos_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE profissionais_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER profissionais_id_seq_tr 

BEFORE INSERT ON profissionais FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT profissionais_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE servicos_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER servicos_id_seq_tr 

BEFORE INSERT ON servicos FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT servicos_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipo_pagamento_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipo_pagamento_id_seq_tr 

BEFORE INSERT ON tipo_pagamento FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT tipo_pagamento_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipo_profissionais_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipo_profissionais_id_seq_tr 

BEFORE INSERT ON tipo_profissionais FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT tipo_profissionais_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
  
