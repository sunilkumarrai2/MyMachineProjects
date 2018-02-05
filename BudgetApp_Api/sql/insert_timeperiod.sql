insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-01-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-02-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-03-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-04-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-05-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-06-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-07-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-08-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-09-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-10-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-11-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-12-2016', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-01-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-02-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-03-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-04-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-05-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-06-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-07-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-08-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-09-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-10-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-11-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-12-2017', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-01-2018', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-02-2018', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-03-2018', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-04-2018', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-05-2018', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-06-2018', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-07-2018', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-08-2018', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-09-2018', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-10-2018', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-11-2018', '%d-%m-%Y'));
insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-12-2018', '%d-%m-%Y'));



# select time_period_id,DATE_FORMAT(budget_month, "%Y, %M") from BudgetApp.Time_Period;


# var mysql = require("mysql");
# var con = mysql.createConnection({
#   "host":"localhost",
#   "user":"budget_app_user",
#   "password":"budgetappuser",
#   "database":"BudgetApp"
# });
#
# function insertIntoTimePeriod(mm){
#     var sql = "insert into BudgetApp.Time_Period (budget_month) values (STR_TO_DATE('01-"+mm+"-2018', '%d-%m-%Y'))";
#     con.query(sql, function (err,result) {
#         if(err) throw err;
#         console.log("INSERTED");
#          if(mm===12){
#             con.end()
#             }
#     });
# }
#
# var months = [01,02,03,04,05,06,07,08,09,10,11,12];
#
# var years = [2016,2017,2018];
# months.forEach(insertIntoTimePeriod);
#

