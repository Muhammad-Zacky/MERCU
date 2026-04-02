<div align="center">

<img src="https://capsule-render.vercel.app/render?type=Waving&color=0054A6&height=250&section=header&text=M%20E%20R%20C%20U&fontSize=70&animation=fadeIn&fontColor=FFFFFF&desc=%5B%20RESTRICTED%20ACCESS%20//%20INTERNAL%20PELINDO%20REGIONAL%202%20%5D&descSize=20&descAlignVertical=55" width="100%"/>

<img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExM3ZqZnd4YW5reGZ4bmhxZnd4YW5reGZ4bmhxZnd4YW5reGZ4bmhxJmVwPXYxX2ludGVybmFsX2dpZl9ieV9pZCZjdD1z/Lp8YV8Wv1YvV4Wv1Yv/giphy.gif" width="120px">

## MANAJEMEN E-REPORTING & CARE UNIT
**Sistem Informasi Pelaporan dan Pemeliharaan Fasilitas Operasional**

---

<div class="technical-badges">
  <img src="https://img.shields.io/badge/SECURITY_LEVEL-CONFIDENTIAL-red?style=for-the-badge" alt="Confidential">
  <img src="https://img.shields.io/badge/ORGANIZATION-PELINDO_REGIONAL_2-0054A6?style=for-the-badge" alt="Pelindo">
  <img src="https://img.shields.io/badge/REPOSITORY-PRIVATE_ACCESS-black?style=for-the-badge" alt="Private">
</div>

<div class="stack-badges" style="margin-top: 10px;">
  <img src="https://img.shields.io/badge/FRAMEWORK-LARAVEL_11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/BUILD-VITE-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/OS-PARROT_OS-51B63E?style=for-the-badge&logo=parrotos&logoColor=white" alt="ParrotOS">
</div>

<br>

<div class="views-badges">
  <img src="https://komarev.com/ghpvc/?username=Muhammad-Zacky-Pelindo&label=RECOGNIZED_ACCESS_TOTAL&color=0e75b6&style=for-the-badge" alt="Views">
  <img src="https://img.shields.io/github/last-commit/Muhammad-Zacky/MERCU?style=for-the-badge&label=LAST_SYSTEM_UPDATE&color=28a745" alt="Last Commit">
</div>

</div>

---

### NOTIFIKASI RESTRIKSI INFORMASI (INFORMATION RESTRICTION NOTICE)

Repositori ini berada di bawah yurisdiksi **PT Pelabuhan Indonesia (Persero) Regional 2 Teluk Bayur**. Segala bentuk informasi, arsitektur database, dan logika program di dalamnya bersifat rahasia. Pelanggaran terhadap kerahasiaan data ini akan diproses sesuai dengan peraturan perusahaan dan perundang-undangan yang berlaku mengenai ITE dan Perlindungan Data Perusahaan.

---

### RINGKASAN EKSEKUTIF (EXECUTIVE SUMMARY)

**MERCU** dirancang untuk mentransformasi manajemen aset operasional menjadi ekosistem digital yang terintegrasi. Fokus utama sistem mencakup:
* **Reporting Centralization:** Konsolidasi laporan kerusakan fasilitas dari seluruh unit kerja.
* **Technical Taskforce Monitoring:** Pemantauan respons dan progres perbaikan oleh teknisi secara transparan.
* **Operational Reliability:** Memastikan infrastruktur pelabuhan tetap dalam kondisi prima guna mendukung kelancaran logistik nasional.

---

### PROTOKOL KONTROL AKSES (ACCESS CONTROL PROTOCOLS)

Otorisasi akses hanya diberikan kepada administrator dan pengembang sistem yang telah melalui proses verifikasi internal.

#### 1. Mekanisme Autentikasi Git
Pengembang wajib menggunakan jalur koneksi **Secure Shell (SSH)** dengan kunci RSA/ED25519 yang telah didaftarkan pada sistem kontrol versi internal Pelindo.

#### 2. Inisialisasi Lingkungan Pengembangan (Development Environment)
Setelah hak akses diberikan, prosedur standar inisialisasi adalah sebagai berikut:

```bash
# Prosedur Kloning via SSH
git clone git@github.com:Muhammad-Zacky/MERCU.git

# Sinkronisasi Dependensi Arsitektur
cd MERCU/mercu-app
composer install --no-dev
npm install

# Kompilasi Aset Produksi
npm run build
