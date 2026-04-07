<div align="center">

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
  <img src="https://img.shields.io/github/repo-size/Muhammad-Zacky/MERCU?style=for-the-badge&label=REPOSITORY_SIZE&color=blue" alt="Repo Size">
</div>

</div>

---

### 🛡️ PROSEDUR KERAHASIAAN INFORMASI (DATA CONFIDENTIALITY PROTOCOL)

Dokumen ini dan seluruh aset perangkat lunak di dalamnya merupakan aset strategis **PT Pelabuhan Indonesia (Persero) Regional 2 Teluk Bayur**. 

Pemanfaatan data tunduk pada pakta integritas teknologi informasi perusahaan. Akses tidak sah, percobaan penetrasi, atau pendistribusian kode sumber secara eksternal akan diidentifikasi melalui audit log sistem dan ditindaklanjuti secara hukum sesuai dengan kebijakan **Cyber Security Pelindo**.

---

### 📊 ANALISIS STRATEGIS (EXECUTIVE STRATEGY)

Sistem **MERCU** diimplementasikan untuk menjamin ketersediaan fasilitas pelabuhan melalui metodologi *Preventive & Corrective Maintenance*. Fokus utama sistem meliputi:

1. **Centralized Asset Reporting:** Standarisasi alur pelaporan insiden fasilitas operasional.
2. **Agile Technical Response:** Percepatan distribusi instruksi kerja kepada teknisi lapangan.
3. **Data-Driven Maintenance:** Penyediaan analitik untuk pengambilan keputusan pemeliharaan aset jangka panjang.

---

### 🖥️ ANTARMUKA SISTEM (SYSTEM INTERFACE DASHBOARD)

Berikut adalah rekam jejak visual dari arsitektur antarmuka pengguna yang telah diimplementasikan:

#### 1. Modul Akses & Identitas (Access & Identity Module)
Fase inisialisasi pengguna dan validasi keamanan sebelum memasuki *command center*.

| Splash Screen (Initialization) | Login Gateway (Authentication) | General Report (Input Form) |
| :---: | :---: | :---: |
| <img src="MERCU/Mercu.png" alt="Splash Screen" width="250"> | <img src="MERCU/login.png" alt="Login Page" width="250"> | <img src="MERCU/report.png" alt="Report Page" width="250"> |

<br>

#### 2. Modul Administrator (Command Center Module)
Akses *high-level* untuk memantau trafik, statistik, manajemen staf, dan tiket pelaporan.

| Overview / Tinjauan Sistem | Statistik Laporan Interaktif |
| :---: | :---: |
| <img src="MERCU/adminTinjauan.png" alt="Admin Tinjauan" width="400"> | <img src="MERCU/adminStatistik.png" alt="Admin Statistik" width="400"> |

| Manajemen Tiket Laporan | Manajemen Staf & Teknisi | Konfigurasi Profil Admin |
| :---: | :---: | :---: |
| <img src="MERCU/adminTicket.png" alt="Admin Ticket" width="250"> | <img src="MERCU/adminStaf.png" alt="Admin Staf" width="250"> | <img src="MERCU/adminProfile.png" alt="Admin Profile" width="250"> |

<br>

#### 3. Modul Operasional Teknisi (Technical Field Operations)
Antarmuka khusus bagi *engineer/technician* untuk mengambil tiket, memproses perbaikan, dan pelaporan histori kerja.

| Laporan Masuk (Incoming) | Detail Instruksi Kerja | Status Pekerjaan (On Progress) |
| :---: | :---: | :---: |
| <img src="MERCU/tekLaporan.png" alt="Teknisi Laporan Masuk" width="250"> | <img src="MERCU/tekDetail.png" alt="Teknisi Detail Laporan" width="250"> | <img src="MERCU/tekOn.png" alt="Teknisi On Progress" width="250"> |

| Riwayat Pekerjaan (History) | Manajemen Profil & Foto Teknisi |
| :---: | :---: |
| <img src="MERCU/tekHistory.png" alt="Teknisi History" width="400"> | <img src="MERCU/tekProfile.png" alt="Teknisi Profile" width="400"> |

---

### 🔑 PROTOKOL OTORISASI TEKNIS (TECHNICAL AUTHORIZATION PROTOCOLS)

Integrasi ke dalam core sistem ini memerlukan kredensial tingkat tinggi yang dikelola oleh administrator sistem.

#### 1. Keamanan Jalur Transmisi (Git Security)
Pengembang wajib mengonfigurasi **SSH Key Authentication** pada mesin kerja (Parrot OS/Linux Environment) sebelum melakukan interaksi dengan repositori. Penggunaan protokol HTTP/HTTPS sangat tidak disarankan untuk alasan keamanan operasional.

#### 2. Prosedur Inisialisasi Sistem (System Initialization)
Ikuti instruksi standardisasi berikut untuk sinkronisasi environment lokal:

```bash
# 1. Sinkronisasi Repositori via Secure Shell
git clone git@github.com:Muhammad-Zacky/MERCU.git

# 2. Akses Direktori Proyek
cd MERCU

# 3. Inisialisasi Environment Variables
cp .env.example .env

# 4. Konfigurasi Dependensi Core (Backend)
composer install --no-dev --optimize-autoloader

# 5. Konfigurasi Dependensi Frontend
npm install

# 6. Generate Application Key
php artisan key:generate

# 7. Migrasi & Seeding Database Terpusat
php artisan migrate --seed

# 8. Kompilasi Produksi (Vite Bundling)
npm run build

# 9. Eksekusi Instance Lokal
php artisan serve
