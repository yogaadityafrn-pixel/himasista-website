# 🌐 Website Resmi HIMASISTA UNTAG Surabaya

Selamat datang di repositori resmi situs web **Himpunan Mahasiswa Sistem dan Teknologi Informasi (HIMASISTA)** Universitas 17 Agustus 1945 Surabaya 🎓  

Proyek ini bukan sekadar halaman profil organisasi — tetapi **platform manajemen internal** yang dirancang untuk menyelesaikan masalah klasik:  
> “Hilangnya arsip dan data penting setiap kali berganti periode kepengurusan.”

---

## 🏛️ Tech Stack

Sistem ini dibangun dengan tumpukan teknologi modern yang memisahkan antara tampilan publik (*frontend*) dan panel admin (*backend*).

| Bagian | Teknologi |
|--------|------------|
| **Backend** | PHP 8.2+, Laravel 12 |
| **Admin Panel** | Filament 3 (sebagai *core CMS*) |
| **Database** | MySQL |
| **Frontend** | Tailwind CSS 3 – gaya *Airy Minimalist* |
| **Interaktivitas** | Alpine.js 3 (transisi halus & lightbox) |
| **Sistem Login & Roles** | Laravel Breeze + Spatie |

---

## ✨ Fitur Utama

### 🖥️ 1. Tampilan Publik (Frontend)
- **Desain Airy Minimalist:** Fokus pada *white space*, tipografi bersih, dan animasi lembut (`x-intersect`).
- **One-Page Layout:** Semua informasi ditampilkan dalam satu halaman panjang dengan *smooth scrolling*.
- **Hero Section Dinamis:** Menampilkan logo & teks utama dengan animasi *reveal*.
- **Konten Dinamis:** Grid untuk *Berita*, *Acara*, dan *Galeri* dengan animasi *staggered* + *lightbox interaktif*.
- **Visi & Misi Dinamis:** Bisa diubah langsung oleh admin dari panel backend.
- **Struktur Organisasi:** Menampilkan pengurus per-divisi dalam format kartu portrait.
- **Form Kontak Aman:** Tervalidasi & langsung tersimpan ke database.
- **Responsif:** Tampilan adaptif dengan menu hamburger untuk mobile.

---

### ⚙️ 2. Panel Admin (Backend)
- **Dashboard Canggih:** Dibangun dengan Filament 3.
- **Manajemen Konten (CMS):** CRUD untuk *Berita*, *Acara*, dan *Galeri* lengkap dengan panduan dimensi gambar.
- **Arsip Digital:** Kelola & unduh dokumen penting (LPJ, Proposal, AD/ART).
- **Manajemen Periode & Divisi:** Dropdown dinamis — otomatis menyesuaikan periode aktif.
- **Manajemen Pengguna:** Role-based access (Super Admin, Admin, Contributor).
- **Kotak Masuk (Contacts):** Halaman baca pesan publik + fitur “Tandai Sudah Dibaca”.
- **Pengaturan Website:** Edit visi & misi langsung dari panel admin.

#### 🔐 Sistem Peran (Roles)
| Role | Hak Akses |
|------|------------|
| **Super Admin** | Akses penuh (termasuk manajemen user & settings) |
| **Admin** | Kelola semua konten, tanpa akses ke manajemen user |
| **Contributor** | Hanya dapat membuat & melihat berita/acara |

---

## 🚀 Instalasi Lokal

Jalankan proyek di lokal Anda dengan langkah berikut:

```bash
# Clone Repository
git clone https://github.com/FadliBil/himasista-untagsby.git
cd himasista-untagsby

# Instal Dependensi
composer install
npm install

# Setup Environment
cp .env.example .env
php artisan key:generate
```

Edit file `.env` sesuai konfigurasi database kamu (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

```bash
# Migrasi & Seeding Data
php artisan migrate --seed

# Buat Symlink Storage
php artisan storage:link

# Jalankan Server
npm run dev     # Terminal 1
php artisan serve  # Terminal 2
```

Akses situs di:  
👉 **http://127.0.0.1:8000**

---

## 🔑 Akun Default

Setelah migrasi & seeding, tersedia akun login awal:

| Role | Email | Password |
|------|--------|-----------|
| **Super Admin** | superadmin@himasista.com | password123 |
| **Admin** | admin@himasista.com | password123 |
| **Contributor** | contributor@himasista.com | password123 |

🧠 **Catatan:** Segera ubah password setelah login pertama.  
Admin Panel: [http://127.0.0.1:8000/admin](http://127.0.0.1:8000/admin)

---

## 🤝 Kontribusi

Proyek ini terbuka untuk semua anggota HIMASISTA yang ingin belajar dan berkontribusi dalam pengembangan sistem digital organisasi 💪  

### Cara Berkontribusi:
1. Fork repositori ini  
2. Buat branch baru  
   ```bash
   git checkout -b fitur/nama-fitur
   ```
3. Commit perubahanmu  
4. Buat Pull Request ke branch `main`  
5. Jelaskan perubahanmu di deskripsi PR

---

## 🗺️ Peta Jalan & Ide Pengembangan

- [ ] **Fitur Pendaftaran Acara:** Tambahkan field *Link Google Form* + tombol “Daftar Sekarang”.  
- [ ] **Pusat Unduhan Publik:** Section baru di frontend untuk dokumen publik/template.  
- [ ] **SEO Halaman Detail:** Meta tag dinamis untuk halaman detail berita & acara.  
- [ ] **Login Sebagai User:** Fitur *impersonate* di panel admin.  
- [ ] **Tombol Backup Database:** Download otomatis file `.sql` dari admin panel.  
- [ ] **Halaman “Lihat Semua”:** Buat halaman /berita dan /acara dengan paginasi.  

---

## 📜 Lisensi

Proyek ini dilisensikan di bawah **MIT License**.  
Silakan gunakan, modifikasi, dan kembangkan dengan tetap mencantumkan kredit.

---

## 📧 Kontak

📩 **Email:** himasista.untag@example.com  
💬 **Instagram:** [@himasista.untagsby](https://instagram.com/himasista.untagsby)

---

> “Dibangun oleh mahasiswa, untuk mahasiswa — demi sistem organisasi yang lebih terarsip, efisien, dan berkelanjutan.” 🚀
