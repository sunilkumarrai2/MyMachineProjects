CREATE USER 'test_user'@'localhost' IDENTIFIED BY 'testuser';

GRANT ALL ON test.* TO 'test_user'@'localhost';


CREATE USER 'test_user'@'localhost' IDENTIFIED BY 'testuser';

GRANT ALL ON test.* TO 'test_user'@'localhost';


-- BUDGET APP
create database BudgetApp;
CREATE USER 'budget_app_user'@'localhost' IDENTIFIED BY 'budgetappuser';
GRANT ALL ON BudgetApp.* TO 'budget_app_user'@'localhost';

-- HarshitaPortfolio APP
create database HarshitaPortfolio;
CREATE USER 'hs_folio_user'@'localhost' IDENTIFIED BY 'hs_folio_user';
GRANT ALL ON HarshitaPortfolio.* TO 'hs_folio_user'@'localhost';
