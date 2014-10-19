<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div data-role="collapsible-set">
            
    <div data-role="collapsible" data-theme="b" data-content-theme="c" data-collapsed="false">
        <h3 id="form_input">Input Transaksi</h3>
        <p>
        <?php
            $piutang = $this->trmodel->get_list_piutang2();
            echo form_open('mobile/save_transaksi','name="f_transaksi"');
            echo form_hidden('nomor');
        ?>
            <ul data-role="listview">
                
                <li data-role="fieldcontain">
                    <label for="transaksi">Transaksi:</label>
                    <?php echo $this->fungsi->build_select_common('transaksi',$transaksi,'id','nama','onchange="cek_piutang()" data-native-menu="true" id="transaksi"',1);?>
                </li>
                <li data-role="fieldcontain">
    
                    <fieldset data-role="controlgroup" data-type="horizontal">
                        <legend id='tanggaltransaksi'>Tanggal Transaksi:</legend>
                        <?php
                            echo '<label for="tanggal">Tanggal:</label>';
                            echo $this->fungsi->build_select_day('tanggal','data-native-menu="true" id="tanggal"',date('d'));
                            echo '<label for="bulan">Bulan:</label>';
                            echo $this->fungsi->build_select_month('bulan','data-native-menu="true" id="bulan"',date('m'),true);
                            echo '<label for="tahun">Tahun:</label>';
                            echo $this->fungsi->build_select_year('tahun','data-native-menu="true" id="tahun"',date('Y'));
                        ?>
                    </fieldset>
                    
                </li>
                <li data-role="fieldcontain">
                    <label for="keterangan">Keterangan:</label>
                    <textarea name="keterangan" id="keterangan" ></textarea>
                </li>
                <li data-role="fieldcontain">
                    <label for="nominal">Nominal:</label>
                    <input type="text" name="nominal" class="fnominal" id="nominal" value=""  />
                </li>
                <li data-role="fieldcontain" style='display:none' id="li_piutang">
                    <label for="id_piutang">Daftar Piutang</label>
                    <?php echo $this->fungsi->build_select_common('id_piutang',$piutang,'nomor','keterangan','data-native-menu="true" id="id_piutang"','','Daftar Piutang');?>
                </li>   
                
            </ul>
            <a class='mybutton' data-theme="b" href="javascript:void(0)" onclick="simpan_transaksi()" data-role="button" >Simpan</a> 
        </form>
        </p>

    </div>

    <div data-role="collapsible" data-theme="b" data-content-theme="d">
        <h3 id="accordion_data_transaksi">Data Transaksi</h3>
        <p id="data_transaksi"></p>
    </div>
    
    <div data-role="collapsible" data-theme="b" data-content-theme="d">
        <h3 id="accordion_bukubesar">Saldo Buku Besar</h3>
        <p id="bukubesar"></p>
    </div>
    
    <div data-role="collapsible" data-theme="b" data-content-theme="d">
        <h3 id="accordion_surdef">Surplus Defisit</h3>
        <p id="surplusdefisit"></p>
    </div>
    
</div>