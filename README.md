<div align="center">

<h1 style="border-bottom: none;">
  <picture>
    <source media="(prefers-color-scheme: dark)" srcset="https://capsule-render.vercel.app/render?type=Waving&color=0054A6&height=220&section=header&text=%5B%20RESTRICTED%20ACCESS%20%5D&fontSize=36&animation=fadeIn&fontColor=FFFFFF&desc=INTERNAL%20PELINDO%20REGIONAL%202%20TELUK%20BAYUR&descSize=20&descAlignVertical=55">
    <img alt="MERCU Pelindo Header" src="https://capsule-render.vercel.app/render?type=Waving&color=0054A6&height=220&section=header&text=%5B%20RESTRICTED%20ACCESS%20%5D&fontSize=36&animation=fadeIn&fontColor=FFFFFF&desc=INTERNAL%20PELINDO%20REGIONAL%202%20TELUK%20BAYUR&descSize=20&descAlignVertical=55">
  </picture>
</h1>

<div style="animation: fadeIn 2s; padding-bottom: 20px;">
  <p style="font-size: 2em; font-weight: bold; margin: 0;">Manajemen E-Reporting & Care Unit (MERCU)</p>
  <p style="font-size: 1.2em; font-style: italic; color: #555; margin: 5px 0 20px 0;">Sistem Informasi Pelaporan dan Pemeliharaan Fasilitas Operasional</p>
</div>

<hr style="border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0)); margin: 20px 0;">

<div class="badges-technical" style="margin-bottom: 15px;">
  <img src="https://img.shields.io/badge/SECURITY%20LEVEL-CONFIDENTIAL-red?style=for-the-badge&logo=opsgenie" alt="Security Level: Confidential">
  <img src="https://img.shields.io/badge/Status-Private_Repository-black?style=for-the-badge&logo=github" alt="Private Repository">
  <img src="https://img.shields.io/badge/ORGANIZATION-PELINDO%20REGIONAL%202-0054A6?style=for-the-badge&logo=enterprise" alt="Organization: Pelindo">
</div>

<div class="badges-stack" style="margin-bottom: 20px;">
  <img src="https://img.shields.io/badge/Framework-Laravel_11-FF2D20?style=for-the-badge&logo=laravel" alt="Framework: Laravel 11">
  <img src="https://img.shields.io/badge/Build_Tool-Vite-646CFF?style=for-the-badge&logo=vite" alt="Build Tool: Vite">
  <img src="https://img.shields.io/badge/Environment-Parrot%20OS-51B63E?style=for-the-badge&logo=parrotos" alt="Environment: Parrot OS">
</div>

<div class="badges-dynamic" style="margin-bottom: 25px;">
  <img src="https://komarev.com/ghpvc/?username=Muhammad-Zacky&label=RECOGNIZED%20ACCESS%20TOTAL&color=0e75b6&style=for-the-badge" alt="Views Counter">
  <img src="https://img.shields.io/github/commit-activity/m/Muhammad-Zacky/MERCU?style=for-the-badge&color=brightgreen" alt="GitHub Commit Activity">
  <img src="https://img.shields.io/github/last-commit/Muhammad-Zacky/MERCU?style=for-the-badge&color=darkblue" alt="GitHub Last Commit">
</div>

</div>

<style>
@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 1; }
}
</style>

---

### PERINGATAN KEAMANAN DATA (CONFIDENTIALITY NOTICE)

Dokumentasi, kode sumber, dan seluruh aset digital dalam repositori ini bersifat **Sangat Rahasia (Highly Confidential)**. Akses dan penggunaan hanya diperuntukkan bagi personel PT Pelabuhan Indonesia (Persero) Regional 2 Teluk Bayur yang memiliki otorisasi formal.

**⚠️ DILARANG KERAS:** Menggandakan, menyebarluaskan, menyalin, atau mentransfer sebagian atau seluruh isi repositori ini ke pihak luar atau media publik tanpa izin tertulis dari Kepala Divisi Teknologi Informasi atau otoritas yang berwenang.

---

### RINGKASAN EKSEKUTIF (EXECUTIVE SUMMARY)

**MERCU (Manajemen E-Reporting & Care Unit)** dirancang sebagai platform web sentralistik untuk modernisasi dan optimalisasi alur pemeliharaan fasilitas operasional di lingkungan kantor Pelindo Regional 2 Teluk Bayur. Sistem ini mengintegrasikan fungsi pelaporan kendala aset oleh karyawan dengan sistem manajemen tugas tim teknisi secara *real-time*, guna memastikan kontinuitas dan performa maksimal aset perusahaan.

---

### PROTOKOL AKSES REPOSITORI

Akses ke repositori ini dibatasi ketat melalui mekanisme autentikasi dan otorisasi berlapis.

#### 1. Prosedur Permintaan Akses (Authorization Procedure)
Personel yang membutuhkan akses wajib menempuh prosedur berikut:
1.  Melakukan pengajuan otorisasi melalui *Pull Request* resmi atau menghubungi **Lead Developer (Zacky)**.
2.  Melampirkan justifikasi kebutuhan akses yang jelas untuk verifikasi peran (role-based access).

#### 2. Konfigurasi Autentikasi (SSH Authentication)
Seluruh aktivitas Git wajib menggunakan protokol SSH terenkripsi.
* **Wajib:** Daftarkan SSH Public Key mesin lokal Anda (terutama jika menggunakan *environment* berbasis Parrot OS, Kali Linux, atau distribusi Linux korporat lainnya) pada profil GitHub yang telah diotorisasi.

#### 3. Prosedur Inisialisasi Lokal (Local Deployment)
Setelah mendapatkan akses otorisasi, lakukan langkah-langkah berikut untuk *deployment* environment pengembangan lokal:

```bash
# Clone repositori melalui protokol SSH (Pastikan SSH Key aktif)
git clone git@github.com:Muhammad-Zacky/MERCU.git

# Masuk ke direktori proyek
cd MERCU/mercu-app

# Instalasi dependensi backend tanpa paket development (untuk mode korporat)
composer install --no-dev

# Instalasi dependensi frontend dan build asset
npm install && npm run build
