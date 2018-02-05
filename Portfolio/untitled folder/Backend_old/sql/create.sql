-- drop DATABASE if EXISTS HarshitaPortfolio;

-- CREATE DATABASE HarshitaPortfolio;

drop table if exists HarshitaPortfolio.beauty_images;
drop table if exists HarshitaPortfolio.creative_images;
drop table if exists HarshitaPortfolio.specialfx_images;

-- beauty_images
create table HarshitaPortfolio.beauty_images
    (
        id    int not null AUTO_INCREMENT
        ,url varchar(255) not null
        ,thumbUrl varchar(255) not null
		,height varchar(255) not null
        ,width varchar(255) not null
        ,orderIndex int not null
        ,unique (url)
        ,unique (thumbUrl)
        ,unique (orderIndex)
		,PRIMARY KEY (id)
    );

-- creative_images
create table HarshitaPortfolio.creative_images
    (
        id    int not null AUTO_INCREMENT
        ,url varchar(255) not null
        ,thumbUrl varchar(255) not null
		,height varchar(255) not null
        ,width varchar(255) not null
        ,orderIndex int not null
        ,unique (url)
        ,unique (thumbUrl)
        ,unique (orderIndex)
		,PRIMARY KEY (id)
    );

-- specialfx_images
create table HarshitaPortfolio.specialfx_images
    (
        id    int not null AUTO_INCREMENT
        ,url varchar(255) not null
        ,thumbUrl varchar(255) not null
		,height varchar(255) not null
        ,width varchar(255) not null
        ,orderIndex int not null
        ,unique (url)
        ,unique (thumbUrl)
        ,unique (orderIndex)
		,PRIMARY KEY (id)
    );
