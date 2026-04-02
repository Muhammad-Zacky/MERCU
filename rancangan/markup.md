##  Struktur Hak Akses dan Fungsionalitas Sistem (Role & Features)

Sistem MERCU mengimplementasikan arsitektur akses hibrida (*Hybrid Access Architecture*) guna mengoptimalkan efisiensi operasional. Pendekatan ini memastikan kecepatan proses pelaporan bagi karyawan tanpa mengorbankan keamanan data manajerial, yang tetap dilindungi melalui sistem otentikasi.

Berikut adalah rincian pembagian hak akses beserta fungsionalitas pada masing-masing tingkatan:

### 1. Karyawan / Entitas Pelapor (Akses Publik - Tanpa Otentikasi)
Akses tingkat ini difokuskan pada efisiensi dan kemudahan pelaporan insiden tanpa adanya hambatan administratif (*login*).

* **Formulir Pelaporan Efisien (*Quick Report Form*):** Antarmuka ringkas bagi pelapor untuk menginput data kerusakan. Hanya mewajibkan pengisian identitas dasar (Nama/NIPP), penentuan lokasi/divisi, deskripsi anomali, serta pengunggahan bukti visual.
* **Penerbitan Tiket Otomatis (*Automated Ticketing*):** Sistem secara otomatis menggenerasi kode identifikasi unik (misal: `T-AC-001`) pasca-pengiriman laporan sebagai referensi pelacakan.
* **Portal Pemantauan Publik (*Public Tracking Board*):** Fasilitas bagi pelapor untuk menelusuri status perbaikan secara *real-time* (*Menunggu*, *Dalam Proses*, *Menunggu Suku Cadang*, *Selesai*) hanya dengan memasukkan nomor tiket.

---

### 2. Teknisi / Tim Pemeliharaan (Akses Terotentikasi)
Ruang kerja digital yang diwajibkan melalui proses masuk (*login*) khusus untuk staf operasional lapangan. Berfungsi untuk mengelola antrean pekerjaan dan mendokumentasikan riwayat perbaikan.

* **Dasbor Antrean Pekerjaan (*Task Queue Dashboard*):** Panel kontrol komprehensif yang menampilkan daftar tiket laporan aktif, diurutkan berdasarkan skala prioritas dan kronologi pelaporan.
* **Pengendali Status Laporan (*Status Controller*):** Modul pembaruan status pengerjaan secara langsung guna memastikan transparansi informasi kepada pihak pelapor.
* **Validasi Resolusi Tiket (*Proof of Resolution*):** Prosedur wajib bagi teknisi untuk mengunggah bukti visual "Pasca-Perbaikan" dan melampirkan log teknis sebelum suatu tiket dapat ditutup atau dinyatakan selesai.
* **Eskalasi Penanganan (*Ticket Escalation*):** Fungsi penangguhan status pengerjaan tiket apabila penyelesaian membutuhkan intervensi dari vendor pihak ketiga atau menunggu pengadaan suku cadang.

---

### 3. Administrator / Pimpinan Divisi (Akses Terotentikasi)
Pusat komando tingkat manajerial dengan hak akses tertinggi (*Super User*). Berfungsi untuk melakukan pengawasan menyeluruh, evaluasi kinerja operasional, dan pengelolaan basis data sistem.

* **Dasbor Analitik Eksekutif (*Executive Dashboard*):** Visualisasi data statistik yang mencakup tren pelaporan, frekuensi kerusakan fasilitas terbanyak, serta pengukuran rata-rata waktu respons penyelesaian tiket (*response time*).
* **Manajemen Data Induk (*Master Data Management*):** Modul administratif berkelanjutan (CRUD) untuk pemeliharaan referensi data utama, meliputi inventaris ruangan, kategori aset operasional, dan manajemen hak akses pengguna.
* **Delegasi Tugas Manual (*Manual Task Assignment*):** Kewenangan khusus untuk mendistribusikan tiket pelaporan secara spesifik kepada teknisi tertentu, dikhususkan untuk penanganan insiden yang bersifat krusial atau *urgent*.
* **Ekspor Data dan Pelaporan (*Export & Reporting*):** Fitur strategis untuk menghasilkan rekapitulasi data periodik ke dalam format dokumen standar (PDF/Excel), guna menunjang rapat evaluasi anggaran, audit fasilitas, dan penilaian Indikator Kinerja Utama (KPI) staf teknisi.
