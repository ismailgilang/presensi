  @extends('layouts.user')
  @section('title', 'Presensi')
  @section('css')
  <script src="{{asset('https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js')}}"></script>
  <!-- Custom CSS -->
  <style>
    .row {
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card {
      background-color: #ffffff;
      /* White background */
      color: #000000;
      /* Blue border */
      height: max-content;
      margin-top: 20px;
    }

    .card-header {
      background-color: #007bff;
      /* Blue background */
      border-bottom: none;
      color: #ffffff;
      /* White text */
    }

    .form-check-label {
      color: #000000;
      /* Black text */
    }

    .btn-primary {
      background-color: #007bff !important;
      /* Blue background */
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3 !important;
      /* Darker blue on hover */
    }

    .take {
      margin-top: 20px;
      margin-bottom: 20px;
      color: white;
      background-color: #007bff;
      /* Blue background */
      border: transparent;
      width: 200px;
      height: 40px;
      border-radius: 20px;
    }

    .modal-content {
      background-color: #ffffff;
      /* White background */
      color: #000000;
      /* Black text */
    }

    .modal-header {
      background-color: #007bff;
      /* Blue background */
      color: #ffffff;
      /* White text */
    }

    .modal-footer {
      background-color: #007bff;
      /* Blue background */
      color: #ffffff;
      /* White text */
    }

    @media only screen and (max-width: 1190px) {
      video {
        height: 300px;
      }
    }

    @media only screen and (max-width: 600px) {
      video {
        height: 200px;
      }
    }

    @media only screen and (max-width: 300px) {
      video {
        height: 80px;
      }

      .navbar-brand {
        padding-left: 1px;
      }

      .take {
        width: 50px;
        height: 10px;
        font-size: 5px;
      }

      .image {
        height: 80px;
      }
    }
  </style>
  @endsection
  @section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h5>Absen</h5>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group" style="display: flex; flex-direction:column; justify-content:center; align-items:center">
            <video autoplay="true" id="video-webcam" style="display:flex;margin:auto ">
            </video>
            <button onclick="takeSnapshot()" class="take">Ambil Gambar</button>
          </div>
          <div id="imageContainer" class="image"></div>
          <form action="{{ url('/dashboardU/absen/upload') }}" method="POST" enctype="multipart/form-data id=" absenForm>
            @csrf
            <div class="form-group">
              <input type="hidden" class="form-control" id="imageInput" name="image">
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" name="name" value="{{$user->name}}" readonly>
            </div>
            <div class="form-group">
              <label for="locationInput">Lokasi:</label>
              <input type="text" class="form-control" id="locationInput" name="rlocation" readonly>
            </div>
            <div class="form-group">
              <label for="identity">NIK</label>
              <input type="text" class="form-control" id="identity" name="nik" value="{{$user->nik}}" readonly>
            </div>
            <div class="form-group">
              <label for="sesi">Keterangan</label>
              <input type="text" class="form-control" id="ket" name="ket" value="Masuk" readonly>
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkBox" name="checkBox">
                <label class="form-check-label" for="checkBox">
                  Check Terlambat
                </label>
              </div>
            </div>
            <div id="locationStatus"></div>
            <div id="buttonContainer">
              @php
              $waktuSekarang = date('H:i');
              @endphp
              @if ($absenHariIni->isNotEmpty())
              <p>Anda sudah absen</p>
              @else
              @if($waktuSekarang >= '07:00' && $waktuSekarang <= '08:30' ) <button id=" absenButton" type="submit" class="btn btn-primary mt-3" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" style="display:none;">Submit (Pagi)</button>
                @elseif($waktuSekarang >= '11:00' && $waktuSekarang <= '12:30' ) <button id="absenButton" type="submit" class="btn btn-primary mt-3" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" style="display:none;">Submit (Siang)</button>
                  @elseif($waktuSekarang >= '18:00' && $waktuSekarang <= '19:30' ) <button id=" absenButton" type="submit" class="btn btn-primary mt-3" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" style="display:none;">Submit (Malam)</button>
                    @endif
                    @endif
            </div>

          </form>
        </div>
      </div>
    </div>

    @endsection
    @section('js')
    <script>
      // Koordinat referensi
      const referenceLocation = {
        lat: -6.9463851,
        lng: 107.5937965
      };

      // Fungsi untuk menghitung jarak dalam kilometer
      function calculateDistance(lat1, lon1, lat2, lon2) {
        const toRadians = angle => angle * (Math.PI / 180);

        const R = 6371; // Radius bumi dalam km
        const dLat = toRadians(lat2 - lat1);
        const dLon = toRadians(lon2 - lon1);
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
          Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) *
          Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        const distance = R * c;

        return distance;
      }

      // Mendapatkan lokasi pengguna
      function checkLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            const userLocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            const distance = calculateDistance(
              userLocation.lat,
              userLocation.lng,
              referenceLocation.lat,
              referenceLocation.lng
            );

            const distanceThreshold = 1; // 1 km

            if (distance > distanceThreshold) {
              document.getElementById('locationStatus').innerHTML = 'Anda di luar jangkauan';
              document.getElementById('absenButton').style.display = 'none';
            } else {
              document.getElementById('locationStatus').innerHTML = 'Anda di dalam jangkauan';
              document.getElementById('absenButton').style.display = 'block';
            }
          }, function() {
            alert('Geolocation tidak tersedia.');
          });
        } else {
          alert('Geolocation tidak didukung oleh browser ini.');
        }
      }

      document.addEventListener('DOMContentLoaded', function() {
        checkLocation();
      });
    </script>

    <script>
      function handleSubmit() {
        // Disable the button after form submission
        document.getElementById('absenForm').onsubmit = function() {
          document.getElementById('absenButton').disabled = true;
        };
      }
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var checkBox = document.getElementById('checkBox');
        var buttonContainer = document.getElementById('buttonContainer');

        checkBox.addEventListener('change', function() {
          if (this.checked) {
            // Jika checkbox dicentang, tampilkan tombol
            buttonContainer.innerHTML = `
                      <button id="absenButtonCustom" type="submit" class="btn btn-primary mt-3" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();">Submit (Telat)</button>
                  `;
          } else {
            // Jika checkbox tidak dicentang, kosongkan container tombol
            buttonContainer.innerHTML = '';
          }
        });
      });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var telatCheckbox = document.getElementById('checkBox');
        var keteranganInput = document.getElementById('ket');

        telatCheckbox.addEventListener('change', function() {
          if (telatCheckbox.checked) {
            keteranganInput.value = 'Masuk Telat';
          } else {
            keteranganInput.value = 'Masuk';
          }
        });
      });
    </script>
    <script>
      function showFileName(event) {
        const input = event.target;
        const fileName = input.files[0].name;
        document.getElementById('fileNameDisplay').innerText = `Selected file: ${fileName}`;
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="{{asset('style/qrCodeScanner.js')}}"></script>
    <script src="{{asset('style/location.js')}}"></script>
    @endsection