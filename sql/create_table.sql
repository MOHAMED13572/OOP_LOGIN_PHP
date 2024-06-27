CREATE TABLE IF NOT EXISTS 'users' (
  'user_Id' int(11) NOT NULL AUTO_INCREMENT,
  'userName' varchar(64) NOT NULL,
  'userEmail' varchar(64) NOT NULL,
  'userPasswordHash' varchar(255) NOT NULL,
  PRIMARY KEY ('user_id'),
  UNIQUE KEY 'userName' ('userName'),
  UNIQUE KEY 'userEmail' ('userEmail')
);