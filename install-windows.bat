@echo off
setlocal

REM Caminho do arquivo de configuração do Apache no XAMPP
set APACHE_CONF=C:\xampp\apache\conf\httpd.conf

REM Verifica se o arquivo existe
if not exist "%APACHE_CONF%" (
    echo ERRO: Arquivo %APACHE_CONF% não encontrado.
    pause
    exit /b
)

REM Cria backup
set BACKUP=C:\xampp\apache\conf\httpd.conf.backup_%date:~-4%%date:~3,2%%date:~0,2%_%time:~0,2%%time:~3,2%%time:~6,2%
set BACKUP=%BACKUP: =0%

echo Criando backup em: %BACKUP%
copy "%APACHE_CONF%" "%BACKUP%" >nul

echo Aplicando alteracoes...

REM Substitui AllowOverride None -> AllowOverride All
powershell -Command "(Get-Content '%APACHE_CONF%') -replace 'AllowOverride\s+None','AllowOverride All' | Set-Content '%APACHE_CONF%'"

REM Substitui Require all denied -> Require all granted
powershell -Command "(Get-Content '%APACHE_CONF%') -replace 'Require all denied','Require all granted' | Set-Content '%APACHE_CONF%'"

echo Reiniciando Apache do XAMPP...

net stop Apache2.4 >nul 2>&1
net start Apache2.4 >nul 2>&1

echo Processo concluido com sucesso!
pause
