<!-- aside -->
<div id="aside" class="app-aside modal fade sm nav-dropdown">
    <div class="left navside grey dk" layout="column">
      <div class="navbar no-radius">
        <!-- brand -->
        <a class="navbar-brand clear">
            <img src="{{ asset('') }}img/user-side.png" alt=".">
            @php
                $name = auth()->user()->name;
                $name = explode(" ", $name);
                $name = $name[0];
            @endphp
            <span>{{ $name }}</span>
        </a>
        <!-- / brand -->
      </div>
      <div flex class="hide-scroll">
        <nav class="scroll nav-border b-primary">

            <ul class="nav" ui-nav>
              <li class="nav-header hidden-folded">
                <small class="text-muted">Main</small>
              </li>

              <li>
                <a href="{{ url('') }}" >
                  <span class="nav-icon">
                    <i class="fa fa-dashboard"></i>
                  </span>
                  <span class="nav-text">Dashboard</span>
                </a>
              </li>

              @if (auth()->user()->id < 2)
              <li>
                <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                  <span class="nav-icon">
                    <i class="material-icons">&#xe5c3;</i>
                  </span>
                  <span class="nav-text">Master Data</span>
                </a>
                <ul class="nav-sub">
                    <li>
                        <a href="{{ url('') }}/jurusan" >
                        <span class="nav-text">Jurusan</span>
                        </a>
                    </li>
                  <li>
                    <a href="{{ url('') }}/siswa" >
                      <span class="nav-text">Siswa</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                  <span class="nav-icon">
                    <i class="material-icons">&#xe5c3;</i>
                  </span>
                  <span class="nav-text">Transaksi</span>
                </a>
                <ul class="nav-sub">
                    <li>
                        <a href="{{ url('') }}/transaksi" >
                            <span class="nav-text">Pembayaran SPP</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a>
                    <span class="nav-caret">
                        <i class="fa fa-caret-down"></i>
                    </span>
                    <span class="nav-icon">
                        <i class="fa fa-cog"></i>
                    </span>
                  <span class="nav-text">Configurasi</span>
                </a>
                <ul class="nav-sub">
                <li>
                    <a href="{{ url('') }}/transaksi/set-harga-spp" >
                        <span class="nav-text">Set harga SPP</span>
                    </a>
                </li>
                  <li>
                    <a href="headers.html" >
                      <span class="nav-text">Hak akses</span>
                    </a>
                  </li>
                </ul>
              </li>
              @endif

              @if (auth()->user()->id > 1)
              <li>
                <a href="{{ url('') }}/transaksi/tagihan/{{ auth()->user()->id }}">
                    <span class="nav-icon">
                        <i class="fa fa-money"></i>
                    </span>
                  <span class="nav-text">Lihat Tagihan</span>
                </a>
              </li>
              @endif

            </ul>
        </nav>
      </div>
    </div>
  </div>
  <!-- / aside -->
