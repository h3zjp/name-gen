# Japanese-like Name Generator
人名生成装置

日本人の名前っぽい文字列を生成します。  
It generates a name-ish string of Japanese.

## Installation
> Requirement: PHP, MySQL or MariaDB

1. First, `git clone` to the appropriate directory.
1. Then `cd name-gen`, then `cp config_sample.php config.php`.
1. Correct the contents of `config.php`.
1. Import files in the `sql` folder into the DB.  
   Import `create_db.sql`, then import `sei.sql`, `mei_man.sql`, `mei_woman.sql`.
1. Enjoy!

※: SQL data is stored in the `xlsx` folder.

## Lisence
MIT
