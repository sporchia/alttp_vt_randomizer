# Multiworld Data File Format

The intent of this file is to describe the binary multiworld data file format.

## Header (X bytes)

|Offset|Length|Info|
|-|-|-|
|0|9|Should be 'ALTTPR-MW'|
|9|2|Version of file (current version is 1)|
|11|36|Signature of creator|

## Record Data

All record data will start with a Record Id, which should then indicate the length of the record as follows:

### Item location
|Length|Name|Info|
|-|-|-|
|1|Record Type|This should be '0x01'|
|1|World Id|Which world this record belongs to|
|1|Macro Location|indoors & 0xF0 \| LW & 0x0F|
|2|Room Id|SNES byte order|
|1|Chest Index|Index of chest in room|
|1|Item|Byte for item|
|1|Item World|Id of World the item belongs to|

### Text Table
|Length|Name|Info|
|-|-|-|
|1|Record Type|This should be '0x02'|
|1|World Id|Which world this record belongs to|
|29525|Text Data|Full dump of text table|

### Entrance
|Length|Name|Info|
|-|-|-|
|1|Record Type|This should be '0x03'|
|1|World Id|Which world this record belongs to|
|1|Door Id|Door Id|
|2|Room Id|SNES byte order|

### Exit
|Length|Name|Info|
|-|-|-|
|1|Record Type|This should be '0x04'|
|1|World Id|Which world this record belongs to|
|2|Room Id|SNES byte order|
|1|Door Id|Door Id|
