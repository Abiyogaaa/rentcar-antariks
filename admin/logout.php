<?php
// Mulai session
session_start();

// Hapus semua session
session_unset();

// Hancurkan session
session_destroy();

// Kirim response JSON untuk sukses
echo json_encode(['success' => true]);
exit();
