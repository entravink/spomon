# spomon
Monitoring SP2020 Online with Image Character Recognition of Bukti Pengisian SP2020 Online.pdf

## Requirements
You should have these libraries installed on your system
1. Imagick (https://imagemagick.org/script/download.php)
2. Ghostscript (https://www.ghostscript.com/)
3. Tesseract OCR (https://tesseract-ocr.github.io/tessdoc/Home.html)

## Installation
1. Configure path of your Yii Framework in index.php
2. Configure the database connection in protected/config/database.php
3. DB: Add Master Wilayah (m_wil), Master OPD/Instansi (m_opd), Pegawai (l_pegawai), User (m_user)

## Usage
- Upload bukti: access the homepage (http://localhost/appname/)
- Admin/Pimpinan/OPD dashboard and administrator function : access the dashboard (http://localhost/appname/index.php?r=lPegawai/dashboard)

## About
This app is built with Yii 1.1 framework
