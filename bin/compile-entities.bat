REM @echo off

webforge-doctrine-compiler orm:compile --extension=Serializer etc/doctrine/model.json src/php/ && %~dp0cli.bat doctrine:schema:update --force --dump-sql