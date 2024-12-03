<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Kirana Coffee</title>

    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
      body {
        background-color: #f7f2e9; /* Warna latar belakang krem */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
      }
      .form-signin {
        background-color: #fff;
        padding: 1.5rem; /* Menyesuaikan padding */
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 100%;
        max-width: 350px;
      }
      .form-signin h1 {
        font-family: "Arial Black", sans-serif;
        color: #3b2f2f; /* Warna teks coklat tua */
        margin-bottom: 1rem;
        font-size: 1.5rem; /* Menyesuaikan ukuran font */
      }
      .form-signin .form-floating {
        margin-bottom: 1rem;
      }
      .form-signin input, .form-signin select {
        background-color: #eaeaea; /* Warna latar belakang input */
        border: none;
        border-radius: 4px;
        height: 35px; /* Menyesuaikan tinggi input */
        font-size: 0.875rem; /* Mengurangi ukuran teks pada input */
      }
      .form-signin label {
        font-size: 0.875rem; /* Mengurangi ukuran teks label */
      }
      .form-signin .checkbox {
        margin-bottom: 1.5rem;
        text-align: left;
        font-size: 0.875rem; /* Mengurangi ukuran teks checkbox */
      }
      .checkbox label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem; /* Ukuran teks lebih kecil */
      }
      .checkbox input[type="checkbox"] {
        margin: 0;
        transform: translateY(1px); /* Sedikit penyesuaian posisi vertikal */
      }
      .form-signin button {
        background-color: #3b2f2f; /* Warna tombol coklat tua */
        border: none;
        border-radius: 4px;
        padding: 8px 18px; /* Menyesuaikan padding tombol */
        color: #fff;
        font-size: 0.875rem; /* Menyesuaikan ukuran font tombol */
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }
      .form-signin button:hover {
        background-color: #5c4b4b; /* Warna tombol saat hover */
      }
      .form-signin p {
        font-size: 0.8rem;
        color: #888;
        margin-top: 1.5rem;
      }
      .form-signin .register-link {
        margin-top: 1.5rem;
        display: block;
        font-size: 0.85rem;
        color: #a67c52; /* Warna cokelat muda */
        text-decoration: none;
      }
      .form-signin .register-link:hover {
        color: #5c4b4b; /* Warna cokelat tua saat hover */
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <main class="form-signin">
      <form action="{{ route('auth.authenticate') }}" method="POST">
        @csrf
        <h1>KIRANA COFFEE</h1>
        <div class="form-floating">
           <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" value="" id="username" name="username" placeholder="Username">
           <label for="username">Username</label>
          @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating">
            <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="w-100">Login</button>
        <a href="{{ route('auth.register') }}" class="register-link">Belum punya akun? Daftar sekarang</a>
        <p class="mt-5 mb-3 text-muted">&copy; 2024 Kirana Coffee</p>
      </form>
    </main>
  </body>
</html>
