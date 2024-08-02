@echo off
python -m PyInstaller -F --noconsole --distpath=./ --workpath=/app_data --icon=app_data/rfid.png --name=RFID-Reader app_data/main.py

cscript app_data/msgbx.vbs