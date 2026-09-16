<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>README - Ardheva Food & Snack</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Google Fonts: Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        brand: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar for webkit */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.6);
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-200 font-sans antialiased selection:bg-brand-500 selection:text-white min-h-screen flex flex-col">

    <!-- Top Navigation Header -->
    <header class="sticky top-0 z-50 bg-slate-900/80 backdrop-blur-md border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Repo Branding -->
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-tr from-brand-600 to-amber-500 p-2 rounded-xl text-white shadow-lg shadow-brand-500/20">
                        <i data-lucide="utensils" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <a href="https://github.com/ABGEsess" target="_blank" class="text-xs text-slate-400 hover:text-brand-500 transition-colors">ABGEsess</a>
                            <span class="text-slate-600">/</span>
                            <span class="text-sm font-semibold text-slate-100">Ardheva</span>
                            <span class="px-2 py-0.5 text-[10px] font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-full">Public</span>
                        </div>
                        <p class="text-xs text-slate-400 hidden sm:block">Web Ordering System UMKM Catering</p>
                    </div>
                </div>

                <!-- GitHub Stats Badges Mockup -->
                <div class="flex items-center space-x-3">
                    <a href="https://github.com/ABGEsess/Ardheva" target="_blank" class="flex items-center space-x-1.5 bg-slate-800 hover:bg-slate-700 text-slate-300 px-3 py-1.5 rounded-lg text-xs font-medium border border-slate-700 transition-all">
                        <i data-lucide="github" class="w-4 h-4"></i>
                        <span>Repository</span>
                    </a>
                    <div class="hidden md:flex items-center space-x-1 bg-slate-800/60 border border-slate-700/60 rounded-lg px-2.5 py-1 text-xs text-slate-300">
                        <i data-lucide="star" class="w-3.5 h-3.5 text-amber-400 fill-amber-400"></i>
                        <span>0</span>
                        <span class="mx-1 text-slate-600">|</span>
                        <i data-lucide="git-fork" class="w-3.5 h-3.5 text-slate-400"></i>
                        <span>0</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area with Sidebar -->
    <div class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Sticky Table of Contents (Sidebar) -->
            <aside class="hidden lg:block lg:col-span-1">
                <div class="sticky top-24 space-y-4 bg-slate-900/40 p-4 rounded-2xl border border-slate-800/80">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 px-2 flex items-center space-x-2">
                        <i data-lucide="list-tree" class="w-4 h-4 text-brand-500"></i>
                        <span>Daftar Isi</span>
                    </h3>
                    <nav class="space-y-1 text-sm">
                        <a href="#overview" class="flex items-center space-x-2 text-slate-300 hover:text-brand-500 hover:bg-slate-800/50 px-3 py-2 rounded-lg transition-all font-medium">
                            <i data-lucide="info" class="w-4 h-4 text-slate-400"></i>
                            <span>Ringkasan Proyek</span>
                        </a>
                        <a href="#fitur" class="flex items-center space-x-2 text-slate-300 hover:text-brand-500 hover:bg-slate-800/50 px-3 py-2 rounded-lg transition-all font-medium">
                            <i data-lucide="sparkles" class="w-4 h-4 text-slate-400"></i>
                            <span>Fitur Utama</span>
                        </a>
                        <a href="#tech-stack" class="flex items-center space-x-2 text-slate-300 hover:text-brand-500 hover:bg-slate-800/50 px-3 py-2 rounded-lg transition-all font-medium">
                            <i data-lucide="layers" class="w-4 h-4 text-slate-400"></i>
                            <span>Teknologi</span>
                        </a>
                        <a href="#struktur-folder" class="flex items-center space-x-2 text-slate-300 hover:text-brand-500 hover:bg-slate-800/50 px-3 py-2 rounded-lg transition-all font-medium">
                            <i data-lucide="folder-tree" class="w-4 h-4 text-slate-400"></i>
                            <span>Struktur Folder</span>
                        </a>
                        <a href="#cara-install" class="flex items-center space-x-2 text-slate-300 hover:text-brand-500 hover:bg-slate-800/50 px-3 py-2 rounded-lg transition-all font-medium">
                            <i data-lucide="terminal" class="w-4 h-4 text-slate-400"></i>
                            <span>Panduan Lokal</span>
                        </a>
                        <a href="#tim" class="flex items-center space-x-2 text-slate-300 hover:text-brand-500 hover:bg-slate-800/50 px-3 py-2 rounded-lg transition-all font-medium">
                            <i data-lucide="users" class="w-4 h-4 text-slate-400"></i>
                            <span>Tim Pengembang</span>
                        </a>
                    </nav>

                    <div class="pt-4 border-t border-slate-800">
                        <div class="bg-brand-500/10 border border-brand-500/20 p-3 rounded-xl">
                            <p class="text-xs text-brand-400 font-medium flex items-center gap-1.5 mb-1">
                                <i data-lucide="graduation-cap" class="w-4 h-4"></i> Project Mahasiswa
                            </p>
                            <p class="text-[11px] text-slate-400 leading-relaxed">
                                Dikelola bersama tim semester 1 melalui <b>GitHub Organization</b>.
                            </p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main README Documentation Container -->
            <main class="lg:col-span-3 space-y-10">

                <!-- Hero Section / Title -->
                <section id="overview" class="bg-gradient-to-b from-slate-900 to-slate-900/60 border border-slate-800 rounded-2xl p-6 sm:p-8 relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-48 h-48 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
                    
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span class="px-2.5 py-1 text-xs font-semibold bg-brand-500/10 text-brand-400 border border-brand-500/20 rounded-md">
                            UMKM Catering Website
                        </span>
                        <span class="px-2.5 py-1 text-xs font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-md">
                            Semester 1 Project
                        </span>
                        <span class="px-2.5 py-1 text-xs font-semibold bg-purple-500/10 text-purple-400 border border-purple-500/20 rounded-md">
                            GitHub Org
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">
                        🍱 Ardheva Food & Snack
                    </h1>
                    <p class="text-slate-400 text-base leading-relaxed mb-6">
                        Sistem Informasi Pemesanan Online berbasis Web untuk UMKM Catering & Kuliner. Dirancang untuk memberikan kemudahan bagi pembeli dalam memesan aneka kue, paket nasi, hingga snackbox, sekaligus mempermudah pengelolaan pesanan oleh pemilik usaha.
                    </p>

                    <!-- Tech Badge Pills -->
                    <div class="flex flex-wrap gap-2 pt-2 border-t border-slate-800/80">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-slate-800 text-amber-400 border border-slate-700">
                            <i data-lucide="code" class="w-3.5 h-3.5"></i> HTML5 & CSS3
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-slate-800 text-yellow-400 border border-slate-700">
                            <i data-lucide="file-code" class="w-3.5 h-3.5"></i> JavaScript
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-slate-800 text-indigo-400 border border-slate-700">
                            <i data-lucide="server" class="w-3.5 h-3.5"></i> PHP Native
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-slate-800 text-sky-400 border border-slate-700">
                            <i data-lucide="database" class="w-3.5 h-3.5"></i> MySQL Database
                        </span>
                    </div>
                </section>

                <!-- Features Section -->
                <section id="fitur" class="space-y-6">
                    <div class="flex items-center space-x-2 border-b border-slate-800 pb-3">
                        <i data-lucide="sparkles" class="w-5 h-5 text-brand-500"></i>
                        <h2 class="text-xl font-bold text-white">Fitur Utama Sistem</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Client Interface Card -->
                        <div class="bg-slate-900/70 border border-slate-800 hover:border-slate-700 rounded-xl p-5 transition-all space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <div class="p-2 bg-blue-500/10 text-blue-400 rounded-lg">
                                        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                                    </div>
                                    <h3 class="font-semibold text-white text-base">Client Interface (Pembeli)</h3>
                                </div>
                                <span class="text-xs font-medium text-blue-400 bg-blue-500/10 px-2 py-0.5 rounded">User Front-End</span>
                            </div>

                            <ul class="space-y-2.5 text-sm text-slate-300">
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                    <span><b>Katalog Menu Lengkap:</b> Pilihan Jajanan Kue Basah, Snackbox, Nasibox, dan Nasi Tumpeng.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                    <span><b>Opsi Pembayaran Fleksibel:</b> Dukungan pembayaran Lunas atau Uang Muka (DP).</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                    <span><b>Metode Bayar:</b> Pembayaran secara Cash saat Diambil/Diantar atau Transfer Online.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                    <span><b>Akun Pelanggan:</b> Sistem Registrasi & Login untuk menyimpan riwayat pesanan.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Admin Interface Card -->
                        <div class="bg-slate-900/70 border border-slate-800 hover:border-slate-700 rounded-xl p-5 transition-all space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2.5">
                                    <div class="p-2 bg-brand-500/10 text-brand-400 rounded-lg">
                                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                                    </div>
                                    <h3 class="font-semibold text-white text-base">Admin Interface (Pengelola)</h3>
                                </div>
                                <span class="text-xs font-medium text-brand-400 bg-brand-500/10 px-2 py-0.5 rounded">Back-End Panel</span>
                            </div>

                            <ul class="space-y-2.5 text-sm text-slate-300">
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                    <span><b>Dashboard Pesanan:</b> Pantau pesanan masuk secara real-time beserta total pendapatan.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                    <span><b>Kelola Produk (CRUD):</b> Tambah, sunting, dan hapus menu makanan beserta harga.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                    <span><b>Verifikasi Pembayaran:</b> Cek pelunasan DP / Cash serta pembaruan status pesanan.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                    <span><b>Keamanan Admin:</b> Login khusus otentikasi pemilik katering.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Tech Stack Section -->
                <section id="tech-stack" class="space-y-6">
                    <div class="flex items-center space-x-2 border-b border-slate-800 pb-3">
                        <i data-lucide="layers" class="w-5 h-5 text-brand-500"></i>
                        <h2 class="text-xl font-bold text-white">Teknologi yang Digunakan</h2>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="bg-slate-900/40 border border-slate-800 p-4 rounded-xl text-center space-y-2 hover:border-slate-700 transition-colors">
                            <i data-lucide="code-2" class="w-8 h-8 text-orange-500 mx-auto"></i>
                            <h4 class="font-medium text-sm text-slate-200">HTML5 / CSS3</h4>
                            <p class="text-xs text-slate-400">Struktur & Tampilan Web Responsive</p>
                        </div>
                        <div class="bg-slate-900/40 border border-slate-800 p-4 rounded-xl text-center space-y-2 hover:border-slate-700 transition-colors">
                            <i data-lucide="terminal" class="w-8 h-8 text-yellow-400 mx-auto"></i>
                            <h4 class="font-medium text-sm text-slate-200">JavaScript</h4>
                            <p class="text-xs text-slate-400">Interaktivitas & Validasi Form</p>
                        </div>
                        <div class="bg-slate-900/40 border border-slate-800 p-4 rounded-xl text-center space-y-2 hover:border-slate-700 transition-colors">
                            <i data-lucide="server" class="w-8 h-8 text-indigo-400 mx-auto"></i>
                            <h4 class="font-medium text-sm text-slate-200">PHP Native</h4>
                            <p class="text-xs text-slate-400">Logika Server & Autentikasi</p>
                        </div>
                        <div class="bg-slate-900/40 border border-slate-800 p-4 rounded-xl text-center space-y-2 hover:border-slate-700 transition-colors">
                            <i data-lucide="database" class="w-8 h-8 text-sky-400 mx-auto"></i>
                            <h4 class="font-medium text-sm text-slate-200">MySQL</h4>
                            <p class="text-xs text-slate-400">Penyimpanan Data Pesanan & Menu</p>
                        </div>
                    </div>
                </section>

                <!-- Folder Structure Section -->
                <section id="struktur-folder" class="space-y-4">
                    <div class="flex items-center space-x-2 border-b border-slate-800 pb-3">
                        <i data-lucide="folder-tree" class="w-5 h-5 text-brand-500"></i>
                        <h2 class="text-xl font-bold text-white">Struktur Direktori Proyek</h2>
                    </div>

                    <div class="bg-slate-900/90 border border-slate-800 rounded-xl overflow-hidden">
                        <div class="bg-slate-800/60 px-4 py-2.5 border-b border-slate-800 flex items-center justify-between text-xs text-slate-400 font-mono">
                            <span class="flex items-center gap-2">
                                <i data-lucide="folder" class="w-4 h-4 text-amber-400"></i>
                                C:/zwebgithub/UMKMCatring/
                            </span>
                            <span>Tree View</span>
                        </div>
                        <pre class="p-4 text-xs sm:text-sm font-mono text-slate-300 leading-relaxed overflow-x-auto">
📁 UMKMCatring/
├── 📁 admin/                 <span class="text-slate-400"># Halaman & logika khusus admin catering</span>
│   ├── dashboard.php
│   ├── menu_crud.php
│   └── orders.php
├── 📁 assets/                <span class="text-slate-400"># File statis (Styling, Gambar, Script Client)</span>
│   ├── 📁 css/
│   │   └── style.css
│   ├── 📁 js/
│   │   └── main.js
│   └── 📁 img/               <span class="text-slate-400"># Foto kue basah, snackbox, tumpeng</span>
├── 📁 config/                 <span class="text-slate-400"># File konfigurasi koneksi database</span>
│   └── database.php
├── 📁 includes/               <span class="text-slate-400"># Komponen reusable (Navbar, Footer, Modal)</span>
│   ├── header.php
│   └── footer.php
├── index.php                 <span class="text-slate-400"># Halaman utama katalog & pemesanan</span>
├── login.php                 <span class="text-slate-400"># Halaman masuk pelanggan / admin</span>
├── register.php              <span class="text-slate-400"># Halaman pendaftaran akun baru</span>
└── README.md                 <span class="text-slate-400"># Dokumentasi utama proyek</span>
</pre>
                    </div>
                </section>

                <!-- Installation Guide Section -->
                <section id="cara-install" class="space-y-6">
                    <div class="flex items-center space-x-2 border-b border-slate-800 pb-3">
                        <i data-lucide="terminal" class="w-5 h-5 text-brand-500"></i>
                        <h2 class="text-xl font-bold text-white">Panduan Menjalankan Secara Lokal</h2>
                    </div>

                    <div class="space-y-4">
                        <!-- Step 1 -->
                        <div class="bg-slate-900/50 border border-slate-800 rounded-xl p-4 space-y-3">
                            <div class="flex items-center space-x-3">
                                <span class="w-6 h-6 rounded-full bg-brand-500/20 text-brand-400 border border-brand-500/30 flex items-center justify-center text-xs font-bold">1</span>
                                <h3 class="font-semibold text-slate-200 text-sm">Clone Repository dari GitHub</h3>
                            </div>
                            <p class="text-xs text-slate-400 ml-9">Buka Git Bash di folder tempat kamu bekerja (misalnya di folder XAMPP `htdocs`), lalu jalankan perintah berikut:</p>
                            
                            <div class="ml-9 bg-slate-950 border border-slate-800 rounded-lg p-3 relative group font-mono text-xs text-emerald-400">
                                <code>git clone https://github.com/ABGEsess/Ardheva.git UMKMCatring</code>
                                <button onclick="copyCode('git clone https://github.com/ABGEsess/Ardheva.git UMKMCatring', this)" class="absolute right-2 top-2 px-2 py-1 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded text-[10px] flex items-center gap-1 transition-all">
                                    <i data-lucide="copy" class="w-3 h-3"></i> Copy
                                </button>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="bg-slate-900/50 border border-slate-800 rounded-xl p-4 space-y-3">
                            <div class="flex items-center space-x-3">
                                <span class="w-6 h-6 rounded-full bg-brand-500/20 text-brand-400 border border-brand-500/30 flex items-center justify-center text-xs font-bold">2</span>
                                <h3 class="font-semibold text-slate-200 text-sm">Persiapan Server Lokal (XAMPP)</h3>
                            </div>
                            <ul class="text-xs text-slate-400 ml-9 space-y-1.5 list-disc list-inside">
                                <li>Pastikan aplikasi **XAMPP Control Panel** sudah terpasang di komputer Anda.</li>
                                <li>Aktifkan modul <b>Apache</b> dan <b>MySQL</b>.</li>
                                <li>Pindahkan folder proyek ke dalam direktori <code class="text-amber-300 bg-slate-800 px-1 py-0.5 rounded">C:/xampp/htdocs/UMKMCatring</code>.</li>
                            </ul>
                        </div>

                        <!-- Step 3 -->
                        <div class="bg-slate-900/50 border border-slate-800 rounded-xl p-4 space-y-3">
                            <div class="flex items-center space-x-3">
                                <span class="w-6 h-6 rounded-full bg-brand-500/20 text-brand-400 border border-brand-500/30 flex items-center justify-center text-xs font-bold">3</span>
                                <h3 class="font-semibold text-slate-200 text-sm">Konfigurasi Database MySQL</h3>
                            </div>
                            <ul class="text-xs text-slate-400 ml-9 space-y-1.5 list-disc list-inside">
                                <li>Buka browser dan akses <code class="text-sky-300">http://localhost/phpmyadmin</code>.</li>
                                <li>Buat database baru bernama <code class="text-emerald-300">db_ardheva</code>.</li>
                                <li>Import file skema SQL (tersedia di folder <code class="text-slate-300">config/db_ardheva.sql</code> jika ada).</li>
                            </ul>
                        </div>

                        <!-- Step 4 -->
                        <div class="bg-slate-900/50 border border-slate-800 rounded-xl p-4 space-y-3">
                            <div class="flex items-center space-x-3">
                                <span class="w-6 h-6 rounded-full bg-brand-500/20 text-brand-400 border border-brand-500/30 flex items-center justify-center text-xs font-bold">4</span>
                                <h3 class="font-semibold text-slate-200 text-sm">Akses Web Aplikasi</h3>
                            </div>
                            <p class="text-xs text-slate-400 ml-9">Buka peramban (browser) lalu akses alamat URL berikut:</p>
                            <div class="ml-9 bg-slate-950 border border-slate-800 rounded-lg p-3 font-mono text-xs text-amber-400">
                                http://localhost/UMKMCatring
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Team Section -->
                <section id="tim" class="space-y-6">
                    <div class="flex items-center space-x-2 border-b border-slate-800 pb-3">
                        <i data-lucide="users" class="w-5 h-5 text-brand-500"></i>
                        <h2 class="text-xl font-bold text-white">Tim Pengembang</h2>
                    </div>

                    <p class="text-xs text-slate-400">
                        Proyek ini dikembangkan oleh Mahasiswa Semester 1 dalam rangka mengasah keterampilan kolaborasi pengembangan perangkat lunak berbasis tim menggunakan GitHub Organization.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Leader/Main Contributor -->
                        <div class="bg-slate-900/70 border border-slate-800 rounded-xl p-4 flex items-center space-x-3 hover:border-slate-700 transition-colors">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-brand-500 to-amber-500 flex items-center justify-center font-bold text-white text-sm shadow-md">
                                EA
                            </div>
                            <div>
                                <h4 class="font-semibold text-white text-sm">Erzha Noverico Ardheva</h4>
                                <p class="text-xs text-brand-400">Project Lead & Lead Developer</p>
                                <a href="https://github.com/ABGEsess" target="_blank" class="text-[11px] text-slate-500 hover:text-slate-300 flex items-center gap-1 mt-0.5">
                                    <i data-lucide="github" class="w-3 h-3"></i> @ABGEsess
                                </a>
                            </div>
                        </div>

                        <!-- Team Member Placeholder -->
                        <div class="bg-slate-900/40 border border-slate-800 border-dashed rounded-xl p-4 flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 text-sm">
                                <i data-lucide="user-plus" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-300 text-sm">Rekan Tim Kuliah</h4>
                                <p class="text-xs text-slate-500">Contributor / Sub-Developer</p>
                                <span class="text-[11px] text-slate-600">Anggota GitHub Org</span>
                            </div>
                        </div>
                    </div>
                </section>

            </main>
        </div>
    </div>

    <!-- Document Footer -->
    <footer class="mt-auto border-t border-slate-800 bg-slate-900/50 py-6 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p>© 2026 Ardheva Food & Snack. Dibuat untuk Proyek Kuliah Semester 1.</p>
            <div class="flex items-center space-x-4 text-slate-400">
                <span class="flex items-center gap-1"><i data-lucide="code-2" class="w-3.5 h-3.5"></i> Open Source</span>
                <span>•</span>
                <span class="flex items-center gap-1"><i data-lucide="git-branch" class="w-3.5 h-3.5"></i> Main Branch</span>
            </div>
        </div>
    </footer>

    <!-- Lucide Icon Initialization & Copy Script -->
    <script>
        // Initialize Icons
        lucide.createIcons();

        // Copy Code Functionality
        function copyCode(text, buttonEl) {
            // Using standard execCommand for iframe compatibility
            const el = document.createElement('textarea');
            el.value = text;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);

            // Visual feedback
            const originalHTML = buttonEl.innerHTML;
            buttonEl.innerHTML = `<i data-lucide="check" class="w-3 h-3 text-emerald-400"></i> Copied!`;
            buttonEl.classList.add('bg-emerald-950', 'text-emerald-300');
            lucide.createIcons();

            setTimeout(() => {
                buttonEl.innerHTML = originalHTML;
                buttonEl.classList.remove('bg-emerald-950', 'text-emerald-300');
                lucide.createIcons();
            }, 2000);
        }
    </script>
</body>
</html>
