CREATE TABLE `EWEST3_labs`.`top100` 
    ( `fld` INT NOT NULL , 
    `fldGrade` INT NOT NULL , 
    `fldName` VARCHAR(25) NOT NULL , 
    `fldState` VARCHAR(15) NOT NULL , 
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