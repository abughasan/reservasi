<script>

	function gridReload(){
	<?php 
		foreach ($kolom as $kol){
			?>var <?=$kol;?> = $('#gs_<?=$kol;?>').val(); <?php
		}
	?>
		
		jQuery("#list").jqGrid('setGridParam',
		{url:"<?php echo base_url(); ?>index.php/<?=$this->uri->segment(1); ?>/<?=$table; ?>/load/?<?php foreach($kolom as $kol){ 
		?>&<?=$kol;?>="+<?=$kol;?>+"<?php } ?>",page:1}).trigger("reloadGrid");
		
	}

</script>
<script type="text/javascript">
var filter;
var filter2;
<?php if(isset($menugrid)): ?>
$(document).ready(function(){

	$("select#selectkantor").change(function(){
		var tglabsen=$("#tgl_absen").val();
		var idkantor=$("#selectkantor option:selected").val();
		var insertabsen = tglabsen+'_'+idkantor;
		var filter = '?filter=tgl_absen&tgl_absen_f='+tglabsen;
		var filter2 = '&filter2=id_kantor&id_kantor_f='+idkantor;
		$.ajax({
				url: "<?=base_url()?>index.php/trans/insertabsen/"+insertabsen,
				cache: false,
				success: function(msg){
					$("#msgabsen").html(msg);
				}
			});
		$('#list').jqGrid('GridUnload');

<?php endif; ?>
//-----------------------------------------------------JQGRID AWAL
$(function () {
   $("#list").jqGrid({
        url: "<?php echo base_url(); ?>index.php/<?=$this->uri->segment(1); ?>/<?=$table; ?>/load/"+filter+filter2,
        datatype: "xml",
        mtype: "GET",

		<?php 
		((isset($jqgrid_at_name)) ? print colname($table,$jqgrid_at_name) : '');
			// $jqgrid_at adalah variabel dari Controller
		((isset($jqgrid_at)) ? print colmodel($table,$jqgrid_at) : '');
		?>
        pager: "#pager",
        rowNum: 10,
		height:'300',
		editurl: "<?php echo base_url(); ?>index.php/<?=$this->uri->segment(1); ?>/<?=$table; ?>/update/",
		toppager:true,
		cellEdit:true,
		cellsubmit : 'remote',
		cellurl: "<?php echo base_url(); ?>index.php/<?=$this->uri->segment(1); ?>/<?=$table; ?>/update/",
		// pgbuttons:false,
		// pgtext:null,
        // rowList: [10, 20, 30],
		// multikey: "ctrlKey",
		// multiselect: true,
		// multiboxonly: true,
		// toolbar: [true,"top"],
        // caption: "Table ASET BAKU"
		
    });
	
	jQuery("#list").navGrid("#list_toppager",{edit:false,add:false,del:false,search:false,refresh:false})
	<?php if (ISSET($button_nav['add']) && $button_nav['add']==TRUE): ?>
	.navButtonAdd('#list_toppager',{
	   caption:"<span class='bplus'>Data</span>", 
	   buttonicon:"ui-icon-plus bplus", 
	   onClickButton: function(){ 
			parameters =
			{
				rowID : "new_row",
				initdata : {<?php ((isset($initdata)) ? print $initdata : '') ?>},
				position :"last",
				useDefValues : false,
				useFormatter : false,
				addRowParams : 
				{
					"keys": true, "aftersavefunc": function() { var grid = $("#list"); grid.trigger("reloadGrid"); }
				},
			}
			jQuery("#list").jqGrid('addRow',parameters);
			$(".bcancel").show('slow');
			$(".bplus").hide('fadeIn');
	   }, 
	   position:"last"
	})
	.navButtonAdd('#list_toppager',{
	   caption:"<span class='bcancel'>Cancel</span>", 
	   buttonicon:"ui-icon-cancel bcancel", 
	   onClickButton: function(){ 
			jQuery("#list").jqGrid('restoreRow',"new_row");
			$(".bcancel").hide('fadeout');
			$(".bplus").show('slow');
	   }
	})
	<?php endif; ?>
	<?php if (ISSET($button_nav['reload']) && $button_nav['reload']==TRUE): ?>
	.navButtonAdd('#list_toppager',{
		caption:"<span class='brefresh'>Reload</span>",
		buttonicon:"ui-icon-refresh",
		onClickButton: function(){
			var grid = $("#list"); grid.trigger("reloadGrid");
		}
	})
	<?php endif; ?>
	<?php if (ISSET($button_nav['cari']) && $button_nav['cari']==TRUE): ?>
	.navButtonAdd('#list_toppager',{
		caption:"<span class='bcari'>Cari</span>",
		buttonicon:"ui-icon-search",
		onClickButton: function(){
			$("#list")[0].toggleToolbar();
		}
	})
	<?php endif; ?>
	<?php if (ISSET($button_nav['delete']) && $button_nav['delete']==TRUE): ?>
	.navButtonAdd('#list_toppager',{
		caption:"<span class='btrash'>Delete</span>",
		buttonicon:"ui-icon-trash",
		onClickButton: function(){
			var rowid = $('#list').jqGrid("getGridParam", "selrow");
			if (rowid === null) {
				$.jgrid.viewModal("#" + 'alertmod_' + this.p.id,
					{gbox: "#gbox_" + $.jgrid.jqID(this.p.id), jqm: true});
				$("#jqg_alrt").focus();
			}else{
				$('#list').jqGrid('delGridRow',rowid);
			}
		}
	});
	<?php endif; ?>
	
	jQuery("#list").jqGrid('filterToolbar'); // must disable jQuery event first, cz all we need is just its interface
	
	$("#list_toppager_center").remove();
	$("#list_toppager_right").remove();
	$(".bcancel").hide();
	$("#list")[0].toggleToolbar();
	
	<?php 
		foreach ($kolom as $kol){
			?>$("#gs_<?=$kol;?>").keyup(function(){gridReload();}); <?php
		}
	?>
	
	/** FUNGSI MULTI DELETE STILL NOT YET WORK
	$("#t_list").append("<input type='button' value='Click Me' id='deleteButton' style='height:20px;font-size:-3'/>");
	$("input","#t_list").click(function(){
		var s;
		s = jQuery("#list").jqGrid('getGridParam','selarrrow');
		alert(s);
		for(var i=0;i<s.length;i++){
			// alert(s.length);
			myrow = jQuery('#list').jqGrid('getCell',s[i],'nama_aset');
			alert(myrow);
		$("#list").delRowData(s[i]);
		}
		
		});
	**/
	
}); 
//--------------------------------------JQGRID AKHIR
<?php if(isset($menugrid)): ?>
	});
});
<?php endif; ?>
</script>