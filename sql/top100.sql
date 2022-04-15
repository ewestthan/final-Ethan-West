CREATE TABLE `EWEST3_labs`.`top100` 
    ( `pmkClimbId` INT PRIMARY KEY NOT NULL,
    `fnkListId` INT NOT NULL, 
    `fldRank` INT UNIQUE KEY NOT NULL , 
    `fldGrade` INT NOT NULL , 
    `fldName` VARCHAR(25) NOT NULL , 
    `fldLocation` VARCHAR(15) NOT NULL , 
    `fldUncontrived` TINYINT(1) NOT NULL , 
    `fldObviousStart` TINYINT(1) NOT NULL , 
    `fldGoodRock` TINYINT(1) NOT NULL , 
    `fldFlatLanding` TINYINT(1) NOT NULL , 
    `fldTall` TINYINT(1) NOT NULL , 
    `fldGoodSetting` TINYINT(1) NOT NULL , 
    `fldImage` VARCHAR(30) NOT NULL , 
    `fldDescription` TEXT NOT NULL , 
    `fldFinalRating` FLOAT NOT NULL ) 
    ENGINE = InnoDB;