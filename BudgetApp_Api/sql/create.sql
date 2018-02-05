-- drop DATABASE if EXISTS BudgetApp;

-- CREATE DATABASE BudgetApp;

drop table if exists BudgetApp.Expenses;
drop table if exists BudgetApp.Category_Detail;
drop table if exists BudgetApp.Budget;
drop table if exists BudgetApp.Time_Period;
drop table if exists BudgetApp.User;
drop table if exists BudgetApp.Category;

-- Category
create table BudgetApp.Category
    (
        category_id    int not null AUTO_INCREMENT
        ,category_name varchar(255) not null
        ,default_amount int
		,is_basic int not null
  ,unique (category_name)
		,PRIMARY KEY (category_id)
    );

-- User
create table BudgetApp.User
    (
        user_id    int not null AUTO_INCREMENT
        ,user_name varchar(255) not null
        ,password varchar(255) not null
  ,unique (user_name)
		,PRIMARY KEY (user_id)
    );

-- TimePeriod
create table BudgetApp.Time_Period
    (
        time_period_id    int not null AUTO_INCREMENT
        ,budget_month date unique not null
  ,unique (budget_month)
		,PRIMARY KEY (time_period_id)
    );

-- Budget
create table BudgetApp.Budget
    (
        budget_id    int not null AUTO_INCREMENT
		,user_id	 int not null
        ,time_period_id   int not null
	    ,amount      double not null
        ,PRIMARY KEY (budget_id)
		,FOREIGN KEY (user_id) REFERENCES BudgetApp.User(user_id)  ON DELETE CASCADE
		,FOREIGN KEY (time_period_id) REFERENCES BudgetApp.Time_Period(time_period_id)  ON DELETE CASCADE
		,unique (user_id,time_period_id)
    );

-- Category_detail
create table BudgetApp.Category_Detail
    (
		category_detail_id    int not null AUTO_INCREMENT
        ,category_id    int not null 
		,budget_id	 int not null
	    ,amount double not null
		,PRIMARY KEY (category_detail_id)
        ,FOREIGN KEY (category_id) REFERENCES BudgetApp.Category(category_id) ON DELETE CASCADE
		,FOREIGN KEY (budget_id) REFERENCES BudgetApp.Budget(budget_id) ON DELETE CASCADE
    );

-- Expenses
create table BudgetApp.Expenses
    (
        expense_id    int not null AUTO_INCREMENT
		,expense_name varchar(255) not null
		,category_id    int not null
	    ,amount double not null
   ,budget_id int not null
  ,expense_date date
		,PRIMARY KEY (expense_id)
        ,FOREIGN KEY (category_id) REFERENCES BudgetApp.Category(category_id)  ON DELETE CASCADE
        ,FOREIGN KEY (budget_id) REFERENCES BudgetApp.Budget(budget_id)  ON DELETE CASCADE
    );








