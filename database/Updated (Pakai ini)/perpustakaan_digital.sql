-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jan 2024 pada 15.48
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_digital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` text NOT NULL,
  `cover_buku` text DEFAULT NULL,
  `kategori_buku` int(11) NOT NULL,
  `stok_buku` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `cover_buku`, `kategori_buku`, `stok_buku`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dilan 1990', 'cover_Dilan 1990_1706444053.jpg', 4, '11', '2024-01-28 18:30:40', '2024-01-28 19:14:46', NULL),
(2, 'Why? Sports Science', 'cover_1_1706449126.jpg', 9, '6', '2024-01-28 20:38:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_keluar`
--

CREATE TABLE `buku_keluar` (
  `id_buku_keluar` int(11) NOT NULL,
  `buku` int(11) NOT NULL,
  `stok_buku_keluar` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku_keluar`
--

INSERT INTO `buku_keluar` (`id_buku_keluar`, `buku`, `stok_buku_keluar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 1, '1', '2024-01-28 21:26:11', NULL, NULL);

--
-- Trigger `buku_keluar`
--
DELIMITER $$
CREATE TRIGGER `hapus` AFTER DELETE ON `buku_keluar` FOR EACH ROW BEGIN
UPDATE buku SET stok_buku = stok_buku+old.stok_buku_keluar WHERE id_buku=old.buku;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `keluar` AFTER INSERT ON `buku_keluar` FOR EACH ROW BEGIN
UPDATE buku SET stok_buku = stok_buku-new.stok_buku_keluar WHERE id_buku=new.buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_masuk`
--

CREATE TABLE `buku_masuk` (
  `id_buku_masuk` int(11) NOT NULL,
  `buku` int(11) NOT NULL,
  `stok_buku_masuk` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku_masuk`
--

INSERT INTO `buku_masuk` (`id_buku_masuk`, `buku`, `stok_buku_masuk`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 2, '5', '2024-01-28 20:19:46', NULL, NULL),
(14, 1, '9', '2024-01-28 21:25:42', NULL, NULL);

--
-- Trigger `buku_masuk`
--
DELIMITER $$
CREATE TRIGGER `masuk` AFTER INSERT ON `buku_masuk` FOR EACH ROW BEGIN
UPDATE buku SET stok_buku = stok_buku+new.stok_buku_masuk WHERE id_buku=new.buku;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah` AFTER DELETE ON `buku_masuk` FOR EACH ROW BEGIN
UPDATE buku SET stok_buku = stok_buku-old.stok_buku_masuk WHERE id_buku=old.buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi_kategori` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Action', NULL, '2024-01-28 15:46:44', '2024-01-28 16:23:17', '2024-01-28 16:23:17'),
(2, 'Fantasy', NULL, '2024-01-28 15:47:33', '2024-01-28 16:23:19', '2024-01-28 16:23:19'),
(3, 'Roman', NULL, '2024-01-28 15:50:26', '2024-01-28 16:23:21', '2024-01-28 16:23:21'),
(4, 'Novel', NULL, '2024-01-28 16:23:34', NULL, NULL),
(5, 'Majalah', NULL, '2024-01-28 16:23:46', NULL, NULL),
(6, 'Kamus', NULL, '2024-01-28 16:23:56', NULL, NULL),
(7, 'Ensiklopedia', NULL, '2024-01-28 16:24:03', NULL, NULL),
(8, 'Manga', NULL, '2024-01-28 16:24:33', NULL, NULL),
(9, 'Buku Ilmiah', NULL, '2024-01-28 16:25:00', NULL, NULL),
(10, 'Buku Digital', NULL, '2024-01-28 16:25:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `koleksi_buku`
--

CREATE TABLE `koleksi_buku` (
  `id_koleksi` int(11) NOT NULL,
  `buku` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `koleksi_buku`
--

INSERT INTO `koleksi_buku` (`id_koleksi`, `buku`, `user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 1, 3, '2024-01-29 20:55:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', '2024-01-22 22:25:19', NULL, NULL),
(2, 'Petugas', '2024-01-27 13:43:11', NULL, NULL),
(3, 'Peminjam', '2024-01-27 13:43:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `buku` int(11) NOT NULL,
  `stok_buku` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `tgl_peminjaman` date NOT NULL DEFAULT current_timestamp(),
  `tgl_pengembalian` date DEFAULT NULL,
  `status_peminjaman` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `buku`, `stok_buku`, `user`, `tgl_peminjaman`, `tgl_pengembalian`, `status_peminjaman`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 1, 1, 1, '2024-01-28', '2024-01-29', 1, '2024-01-28 23:54:25', NULL, NULL);

--
-- Trigger `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `update_book_stock` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
    DECLARE stock_difference INT;

    IF NEW.status_peminjaman = 1 THEN
        -- Kurangi stok_buku di tabel buku
        SET stock_difference = -NEW.stok_buku;
    ELSEIF NEW.status_peminjaman = 2 THEN
        -- Tambahkan kembali stok_buku di tabel buku
        SET stock_difference = NEW.stok_buku;
    END IF;

    UPDATE buku SET stok_buku = stok_buku + stock_difference WHERE id_buku = NEW.buku;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_book_stock2` AFTER UPDATE ON `peminjaman` FOR EACH ROW BEGIN
    DECLARE stock_difference INT;

    IF NEW.status_peminjaman = 1 THEN
        -- Kurangi stok_buku di tabel buku
        SET stock_difference = -NEW.stok_buku;
    ELSEIF NEW.status_peminjaman = 2 THEN
        -- Tambahkan kembali stok_buku di tabel buku
        SET stock_difference = NEW.stok_buku;
    END IF;

    UPDATE buku SET stok_buku = stok_buku + stock_difference WHERE id_buku = NEW.buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan_buku`
--

CREATE TABLE `ulasan_buku` (
  `id_ulasan` int(11) NOT NULL,
  `buku` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `ulasan` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ulasan_buku`
--

INSERT INTO `ulasan_buku` (`id_ulasan`, `buku`, `user`, `ulasan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 'Bagus banget bukunya wajib dibaca nih!', '2024-01-29 21:20:07', NULL, NULL),
(3, 1, 2, 'Kurang puas, butuh kelanjutan!', '2024-01-29 21:20:07', NULL, NULL),
(4, 1, 1, 'Bintang 5 pokoknya!', '2024-01-29 21:20:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `foto` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, 'default.png', '2024-01-22 22:26:01', NULL, NULL),
(2, 'Petugas', 'c4ca4238a0b923820dcc509a6f75849b', 2, 'default.png', '2024-01-22 22:26:01', NULL, NULL),
(3, 'Peminjam', 'c4ca4238a0b923820dcc509a6f75849b', 3, 'default.png', '2024-01-22 22:26:01', NULL, NULL),
(5, 'Tes', 'c4ca4238a0b923820dcc509a6f75849b', 3, 'default.png', '2024-01-29 13:12:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `website`
--

CREATE TABLE `website` (
  `id_website` int(11) NOT NULL,
  `nama_website` varchar(255) NOT NULL,
  `logo_website` text DEFAULT NULL,
  `logo_pdf` text DEFAULT NULL,
  `favicon_website` text DEFAULT NULL,
  `komplek` text DEFAULT NULL,
  `jalan` text DEFAULT NULL,
  `kelurahan` text DEFAULT NULL,
  `kecamatan` text DEFAULT NULL,
  `kota` text DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `website`
--

INSERT INTO `website` (`id_website`, `nama_website`, `logo_website`, `logo_pdf`, `favicon_website`, `komplek`, `jalan`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Perpustakaan Digital', 'logo_contoh.svg', 'logo_pdf_contoh.svg', 'favicon_contoh.svg', 'Komp. Pahlawan Mas', 'Jl. Raya Pahlawan No. 123', 'Kel. Sukajadi', 'Kec. Sukasari', 'Kota Batam', '29424', '2023-05-01 16:33:53', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `buku_keluar`
--
ALTER TABLE `buku_keluar`
  ADD PRIMARY KEY (`id_buku_keluar`);

--
-- Indeks untuk tabel `buku_masuk`
--
ALTER TABLE `buku_masuk`
  ADD PRIMARY KEY (`id_buku_masuk`);

--
-- Indeks untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `koleksi_buku`
--
ALTER TABLE `koleksi_buku`
  ADD PRIMARY KEY (`id_koleksi`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id_website`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `buku_keluar`
--
ALTER TABLE `buku_keluar`
  MODIFY `id_buku_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `buku_masuk`
--
ALTER TABLE `buku_masuk`
  MODIFY `id_buku_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `koleksi_buku`
--
ALTER TABLE `koleksi_buku`
  MODIFY `id_koleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `ulasan_buku`
--
ALTER TABLE `ulasan_buku`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `website`
--
ALTER TABLE `website`
  MODIFY `id_website` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
