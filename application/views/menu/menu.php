


<?php
if (session("role") == "anggaran") {
    ?>
    <li> 
        <a href="<?= site_url("home") ?>" class="waves-effect <?= isset($position) && $position == "home" ? "active" : "" ?>">
            <i class="linea-icon linea-basic fa-fw" data-icon="x"></i> <span class="hide-menu"> Home 
        </a>
        <a href="<?= site_url("prepayment") ?>" class="waves-effect <?= isset($position) && $position == "prepayment" ? "active" : "" ?>">
            <i class="linea-icon linea-basic fa-fw" data-icon="x"></i> <span class="hide-menu"> Prepayment 
        </a>

    </li>

    <?php
} else

if (session("role") == "keuangan") {
    ?>
    <li> 
        <a href="<?= site_url("home") ?>" class="waves-effect <?= isset($position) && $position == "home" ? "active" : "" ?>">
            <i class="linea-icon linea-basic fa-fw" data-icon="x"></i> <span class="hide-menu"> Home 
        </a>


    </li>
    <li> 
        <a href="<?= site_url("report") ?>" class="waves-effect <?= isset($position) && $position == "report" ? "active" : "" ?>">
            <i class="llinea-icon linea-basic fa-fw" data-icon=""></i> <span class="hide-menu"> Report <span class="fa arrow"></span> 
        </a>


        <ul class="nav nav-second-level collapse"  >
            <li>
                <a href="<?= site_url("laporan_cashcard") ?>" class=" <?= isset($position2) && $position2 == "laporan_cashcard" ? "active" : "" ?>">
                    Laporan Cashcard 
                </a>
            </li>
            <li>
                <a href="<?= site_url("rekapitulasi_cashcard") ?>" class=" <?= isset($position2) && $position2 == "rekapitulasi_cashcard" ? "active" : "" ?>">
                    Rekapitulasi Cashcard
                </a>
            </li>
            <li>
                <a href="<?= site_url("fluktuasi_cashcard") ?>" class="<?= isset($position2) && $position2 == "fluktuasi_cashcard" ? "active" : "" ?>">
                    Fluktuasi Cashcard
                </a>
            </li>
        </ul>



    </li>


    <li> 
        <a href="<?= site_url("administrasi_data") ?>" class="waves-effect <?= isset($position) && $position == "administrasi_data" ? "active" : "" ?>">
            <i class="linea-icon linea-basic fa-fw" data-icon="P"></i> <span class="hide-menu"> Administrasi Data <span class="fa arrow"></span> 
        </a>
        <ul class="nav nav-second-level collapse" >
            <li>
                <a href="<?= site_url("kalibrasi_saldo") ?>" class="waves-effect <?= isset($position2) && $position2 == "kalibrasi_saldo" ? "active" : "" ?>">
                    Kalibrasi Saldo
                </a>
            </li>

            <li>
                <a href="<?= site_url("key_member") ?>" class="waves-effect <?= isset($position2) && $position2 == "key_member" ? "active" : "" ?>">
                    Key Member
                </a>
            </li>
            <li>
                <a href="<?= site_url("penentuan_limit") ?>" class="waves-effect <?= isset($position2) && $position2 == "penentuan_limit" ? "active" : "" ?>">
                    Penentuan Limit
                </a>
            </li>
            <li>
                <a href="<?= site_url("penarikan_danacashcard") ?>" class="waves-effect <?= isset($position2) && $position2 == "penarikan_danacashcard" ? "active" : "" ?>">
                    Penarikan Dana Cashcard
                </a>
            </li>
            <li>
                <a href="<?= site_url("prepayment") ?>" class="waves-effect <?= isset($position2) && $position2 == "prepayment" ? "active" : "" ?>">
                    Prepayment
                </a>
        </ul>

    </li>




    <?php
} else {
    ?>
    <li> 
        <a href="<?= site_url("home") ?>" class="waves-effect <?= isset($position) && $position == "home" ? "active" : "" ?>">
            <i class="linea-icon linea-basic fa-fw" data-icon="x"></i> <span class="hide-menu"> Home 
        </a>


    </li>
    <li> 
        <a href="<?= site_url("prepayment") ?>" class="waves-effect <?= isset($position) && $position == "prepayment" ? "active" : "" ?>">
            <i class="linea-icon linea-ecommerce fa-fw" data-icon="l"></i> <span class="hide-menu"> Prepayment 
        </a>

    </li>


    <?php
}
?>


