CREATE DATABASE IF NOT EXISTS PetHero;
USE PetHero;

CREATE TABLE IF NOT EXISTS owners(
	ownerId INT NOT NULL auto_increment,
    email VARCHAR(35) NOT NULL unique,
    pass VARCHAR(35) NOT NULL,
    firstName VARCHAR(35) NOT NULL,
    lastName VARCHAR(35) NOT NULL,
    phone VARCHAR(35) NOT NULL,
    adress VARCHAR(35) NOT NULL,
    isAdmin bool,
    
    constraint `ownerId` primary key(ownerId)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS keepers(
	keeperId INT NOT NULL auto_increment,
    email VARCHAR(35) NOT NULL unique,
    pass VARCHAR(35) NOT NULL,
    firstName VARCHAR(35) NOT NULL,
    lastName VARCHAR(35) NOT NULL,
    phone VARCHAR(35) NOT NULL,
    adress VARCHAR(35) NOT NULL,
    availabilityFrom date,
    availabilityTo date,
    petTypeId INT,
    price float,
    
    constraint `keeperId` primary key(keeperId),
    constraint petTypeId foreign key (petTypeId) references petTypes(petTypeId),
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS days(
	dayId INT NOT NULL auto_increment,
    keeperId INT NOT NULL,
    isAvailable bool,
    
    constraint `dayId` primary key(dayId),
    constraint keeperId foreign key (keeperId) references keeper(keeperId)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS petTypes(
	petTypeId INT NOT NULL auto_increment,
    size VARCHAR(35) NOT NULL,
    
    constraint `petTypeId` primary key(petTypeId)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS pets(
	petId INT NOT NULL auto_increment,
    petName VARCHAR(35) NOT NULL unique,
    petTypeId INT NOT NULL,
    urlPhoto VARCHAR(200),
    urlVideo VARCHAR(200),
    urlVaccination VARCHAR(200),
    details VARCHAR(200),
    breed VARCHAR(35),
    ownerId INT NOT NULL,
    
    constraint `petId` primary key(petId),
    constraint petTypeId foreign key (petTypeId) references petTypes(petTypeId),
    constraint ownerId foreign key (ownerId) references owners(ownerId)
)ENGINE=INNODB;
