@extends('layouts.user')
@section('title', 'Dashboard')
@section('css')
<style>
  thead>tr>th {
    color: white;
  }

  .row {
    margin-top: 40px;
    width: 100%;
    height: max-content;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 1px;
  }

  .card {
    background-color: #ffffff;
    color: #000;
    border: 1px solid #007bff;
  }

  .card-header {
    background-color: #007bff;
    border-bottom: none;
    color: white;
  }

  .form-check-label {
    color: #000;
  }

  .btn-primary {
    background-color: #007bff !important;
    border: none;
  }

  .btn-primary:hover {
    background-color: #0056b3 !important;
  }

  .imglong {
    max-width: 100px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .profile-card {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 50px;
    background: #e0e0e0;
    box-shadow: 20px 20px 60px #bebebe,
      -20px -20px 60px #ffffff;
  }

  .profile-picture {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin-bottom: 20px;
  }

  .typewriter {
    font-size: 1.5em;
    font-family: monospace;
    white-space: nowrap;
    overflow: hidden;
    border-right: 0.15em solid black;
    /* Blink effect */
    animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
  }

  @keyframes typing {
    from {
      width: 0;
    }

    to {
      width: 100%;
    }
  }

  @keyframes blink-caret {

    from,
    to {
      border-color: transparent;
    }

    50% {
      border-color: black;
    }
  }
</style>
@endsection
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="profile-card text-center">
      @if($user->profile)
      <img src="{{ asset('storage/'.$user->profile) }}" alt="Profile Picture" class="profile-picture">
      @else
      <div class="profile-picture-default">
        <i class="fas fa-user-circle fa-5x"></i>
      </div>
      @endif
      <div id="animated-text" class="typewriter mt-4"></div>

      <ul class="list-unstyled mt-5">
        <li><strong style="text-transform: uppercase;">{{$user->level}}</strong></li>
        <li><strong style="text-transform: uppercase;">Email : </strong> {{$user->email}}</li>
        <li style="text-transform: uppercase;"><strong>Tanggal Bergabung :</strong> {{$user->created_at}}</li>
        <li><a href="{{route('cetakslip.anggota', $user->id)}}" class="btn btn-primary mt-3">Cetak Slip</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    const animatedText = document.getElementById('animated-text');
    const messages = [
      `Selamat datang, {{ $user->name }}!`,
    ];
    let messageIndex = 0;

    function typeMessage() {
      // Dapatkan pesan saat ini
      const currentMessage = messages[messageIndex];
      // Bersihkan teks lama
      animatedText.innerHTML = '';
      // Animasi pengetikan
      let charIndex = 0;

      function typeCharacter() {
        if (charIndex < currentMessage.length) {
          animatedText.textContent += currentMessage.charAt(charIndex);
          charIndex++;
          setTimeout(typeCharacter, 100); // Sesuaikan kecepatan pengetikan
        } else {
          setTimeout(nextMessage, 2000); // Durasi sebelum menampilkan pesan berikutnya
        }
      }
      typeCharacter();
    }

    function nextMessage() {
      messageIndex = (messageIndex + 1) % messages.length;
      typeMessage();
    }

    // Mulai animasi
    typeMessage();
  });
</script>
@endsection