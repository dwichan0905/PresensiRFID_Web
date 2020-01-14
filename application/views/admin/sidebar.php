            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li <?= ($page == 'dash' ? "class=\"active\"" : "");?>>
                        <a href="<?= base_url(''); ?>"><i class="fa fa-fw fa-dashboard"></i> Beranda</a>
                    </li>
                    <li <?= ($page == 'dosen' ? "class=\"active\"" : "");?>>
                        <a href="<?= base_url(''); ?>dosen.me"><i class="fa fa-fw fa-user"></i> Dosen</a>
                    </li>
                    <li <?= ($page == 'mhs' ? "class=\"active\"" : "");?>>
                        <a href="<?= base_url(''); ?>mahasiswa.me"><i class="fa fa-fw fa-users"></i> Mahasiswa</a>
                    </li>
                    <li <?= (($page == 'today') || ($page == 'all') ? "class=\"active\"" : "");?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#act"><i class="fa fa-fw fa-file"></i> Aktivitas Presensi <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="act" class="collapse">
                            <li>
                                <a href="<?= base_url(''); ?>activity/today.me"><i class="fa fa-fw fa-calendar"></i> Hari Ini</a>
                            </li>
                            <li>
                                <a href="<?= base_url(''); ?>activity/all.me"><i class="fa fa-fw fa-clock-o"></i> Semua</a>
                            </li>
                        </ul>
                    </li>
                    <li <?= ($page == 'dev' ? "class=\"active\"" : "");?>>
                        <a href="<?= base_url(''); ?>devices.me"><i class="fa fa-fw fa-hdd-o"></i> Perangkat</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->