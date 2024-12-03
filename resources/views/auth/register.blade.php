<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Kirana Coffee</title>

    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
      body {
        background-color: #f7f2e9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
      }
      .form-signin {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 100%;
        max-width: 350px;
      }
      .form-signin h1 {
        font-family: "Arial Black", sans-serif;
        color: #3b2f2f;
        margin-bottom: 1rem;
        font-size: 1.5rem;
      }
      .form-signin .form-floating {
        margin-bottom: 1rem;
      }
      .form-signin input, .form-signin select {
        background-color: #eaeaea;
        border: none;
        border-radius: 4px;
        height: 35px;
        font-size: 0.875rem; /* Mengurangi ukuran teks pada input */
      }
      .form-signin label {
        font-size: 0.875rem; /* Mengurangi ukuran teks label */
      }
      .checkbox {
        margin-bottom: 1.5rem;
        text-align: left;
        font-size: 0.875rem; /* Mengurangi ukuran teks checkbox */
      }
      .checkbox label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
      }
      .checkbox input[type="checkbox"] {
        margin: 0;
        transform: translateY(1px);
      }
      .form-signin button {
        background-color: #3b2f2f;
        border: none;
        border-radius: 4px;
        padding: 8px 18px;
        color: #fff;
        font-size: 0.875rem; /* Mengurangi ukuran teks tombol */
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }
      .form-signin button:hover {
        background-color: #5c4b4b;
      }
      .form-signin p {
        font-size: 0.8rem;
        color: #888;
        margin-top: 1.5rem;
      }
      .form-signin .link-to-login {
        margin-top: 1.5rem;
        display: block;
        font-size: 0.85rem;
        color: #a67c52;
        text-decoration: none;
      }
      .form-signin .link-to-login:hover {
        color: #5c4b4b;
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <main class="form-signin">
      <form action="{{ route('auth.store') }}" method="POST">
        @csrf
        <h1>KIRANA COFFEE</h1>
        <div class="form-floating">
          <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" value="{{ old('username') }}" id="username" name="username" placeholder="Username">
          <label for="username">Username</label>
          @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" placeholder="Your Name">
          <label for="name">Your Name</label>
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <!-- Password dan Confirm Password kembali dalam layout vertikal -->
        <div class="form-floating">
          <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
          <label for="password">Password</label>
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
          <label for="password_confirmation">Confirm Password</label>
          @error('password_confirmation')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <!-- Role dengan ukuran lebih kecil -->
        <div class="form-floating">
            <select name="role" id="role" class="form-select form-select-sm form-control-sm" required>
              <option value="user" @if(old('role') == 'user') selected @endif>User</option>
              <option value="admin" @if(old('role') == 'admin') selected @endif>Admin</option>
            </select>
            <label for="role">Role</label>
            @error('role')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button type="submit" class="w-100">Sign Up</button>
        <a href="{{ route('auth.login') }}" class="link-to-login">Sudah punya akun? Login sekarang</a>
        <p class="mt-5 mb-3 text-muted">&copy; 2024 Kirana Coffee</p>
      </form>
    </main>
  </body>
</html>
