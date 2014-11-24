--Create Read Only Acct in SQL
CREATE USER 'beerr'@'localhost' IDENTIFIED BY 'beerr';
GRANT SELECT ON beer.* TO 'beerr'@'localhost';

--Create Write Acct in SQL **BE SURE TO CHANGE THIS PASSWORD**
CREATE USER 'beerw'@'localhost' IDENTIFIED BY 'beerwbeerrbeerw';
GRANT UPDATE,DELETE,SELECT,INSERT ON beer.* TO 'beerw'@'localhost';