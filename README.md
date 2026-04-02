<div align="center">

<img src="https://capsule-render.vercel.app/render?type=Venom&color=0054A6&height=250&section=header&text=M%20E%20R%20C%20U&fontSize=80&animation=fadeIn&fontColor=FFFFFF&desc=MANAGEMENT%20E-REPORTING%20%26%20CARE%20UNIT&descSize=20&descAlignVertical=60" width="100%"/>

<br>

<div class="identity-header">
  <img src="https://img.shields.io/badge/OFFICIAL_INTERNAL_SYSTEM-PT_PELABUHAN_INDONESIA_(PERSERO)-0054A6?style=for-the-badge" alt="Pelindo Official">
</div>

<br>

### INFRASTRUCTURE MONITORING & FACILITY MAINTENANCE
**Internal Operational Command Center | Regional 2 Teluk Bayur**

---

<div class="analytics-board">
  <img src="https://img.shields.io/badge/SECURITY_CLASSIFICATION-TOP_SECRET-black?style=flat-square&logo=gitbook&logoColor=red" alt="Security Classification">
  <img src="https://img.shields.io/badge/NETWORK_STATUS-RESTRICTED-orange?style=flat-square&logo=locked&logoColor=white" alt="Network Status">
  <img src="https://img.shields.io/badge/SERVER_LOCATION-INTERNAL_DATACENTER-0054A6?style=flat-square&logo=server&logoColor=white" alt="Server Location">
</div>

<div class="tech-stack-board" style="margin-top: 5px;">
  <img src="https://img.shields.io/badge/ARCHITECTURE-LARAVEL_11-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Architecture">
  <img src="https://img.shields.io/badge/ASSET_ENGINE-VITE_V5-646CFF?style=flat-square&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/ENVIRONMENT-PARROT_OS-51B63E?style=flat-square&logo=parrotos&logoColor=white" alt="ParrotOS">
</div>

<br>

<div class="metrics-container">
  <img src="https://komarev.com/ghpvc/?username=Muhammad-Zacky-MERCU&label=SYSTEM_ACCESS_COUNT&color=0054A6&style=for-the-badge" alt="System Access Count">
  <img src="https://img.shields.io/github/last-commit/Muhammad-Zacky/MERCU?style=for-the-badge&label=LAST_SYSTEM_STAGING&color=28a745" alt="Last System Staging">
</div>

</div>

---

### PROSEDUR KERAHASIAAN INFORMASI (DATA CONFIDENTIALITY PROTOCOL)

Dokumen ini dan seluruh aset perangkat lunak di dalamnya merupakan aset strategis **PT Pelabuhan Indonesia (Persero) Regional 2 Teluk Bayur**. 

Pemanfaatan data tunduk pada pakta integritas teknologi informasi perusahaan. Akses tidak sah, percobaan penetrasi, atau pendistribusian kode sumber secara eksternal akan diidentifikasi melalui audit log sistem dan ditindaklanjuti secara hukum sesuai dengan kebijakan **Cyber Security Pelindo**.

---

### ANALISIS STRATEGIS (EXECUTIVE STRATEGY)

MERCU diimplementasikan untuk menjamin ketersediaan fasilitas pelabuhan melalui metodologi *Preventive & Corrective Maintenance*. Fokus utama sistem meliputi:

1.  **Centralized Asset Reporting:** Standarisasi alur pelaporan insiden fasilitas operasional.
2.  **Agile Technical Response:** Percepatan distribusi instruksi kerja kepada teknisi lapangan.
3.  **Data-Driven Maintenance:** Penyediaan analitik untuk pengambilan keputusan pemeliharaan aset jangka panjang.

---

### PROTOKOL OTORISASI TEKNIS (TECHNICAL AUTHORIZATION PROTOCOLS)

Integrasi ke dalam core sistem ini memerlukan kredensial tingkat tinggi yang dikelola oleh administrator sistem.

#### 1. Keamanan Jalur Transmisi (Git Security)
Pengembang wajib mengonfigurasi **SSH Key Authentication** pada mesin kerja (Parrot OS/Linux Environment) sebelum melakukan interaksi dengan repositori. Penggunaan protokol HTTP/HTTPS sangat tidak disarankan untuk alasan keamanan.

#### 2. Prosedur Inisialisasi Sistem (System Initialization)
Ikuti instruksi standardisasi berikut untuk sinkronisasi environment lokal:

```bash
# Sinkronisasi Repositori via Secure Shell
git clone git@github.com:Muhammad-Zacky/MERCU.git

# Konfigurasi Dependensi Core & Frontend
cd MERCU/mercu-app
composer install --no-dev --optimize-autoloader
npm install

# Kompilasi Produksi (Vite Bundling)
npm run build
