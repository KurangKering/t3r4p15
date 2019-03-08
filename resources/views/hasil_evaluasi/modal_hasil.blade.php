 @section('css')
 @parent
 <style type="text/css">
 
 .table-keterangan tr th {
  font-weight: normal;
  text-align: left;
  width: 30%;
}

.table-keterangan tr td:nth-child(2) {
  width: 2%;
  text-align: left;
}
</style>
@endsection

<div id="modal-hasil-evaluasi" style="display: none">
  <div class="card-box">
    <table class="table table-keterangan table-striped">

      <tr>
        <th>Nama anak</th>
        <td>:</td>
        <td><span id="nama_anak"></span></td>
      </tr>
      <tr>
        <th>Nama orang tua</th>
        <td>:</td>
        <td><span id="nama_orang_tua"></span></td>
      </tr>
      <tr>
        <th>Jenis terapi</th>
        <td>:</td>
        <td><span id="jenis_terapi"></span></td>
      </tr>
      <tr>
        <th>Periode</th>
        <td>:</td>
        <td><span id="periode"></span></td>
      </tr>
      <tr>
        <th>Pertemuan</th>
        <td>:</td>
        <td><span id="pertemuan"></span></td>
      </tr>
    </table>
  </div>
  <div class="card-box">
    <div id="content_hasil"></div>
    
  </div>
</div>

@section('js')
@parent
<script>


  $("#modal-hasil-evaluasi").iziModal({
    title: 'Data Hasil Evaluasi',
    subtitle: '',
    headerColor: '#676a6c',
    //   background: null,
    //   theme: '',  
    //   icon: null,
    //   iconText: null,
    //   iconColor: '',
    //   rtl: false,
    width: 700,
    top: 30,
    //   bottom: null,
    //   borderBottom: true,
    padding: 10,
    //   radius: 3,
    zindex: 99999999,
    //   iframe: false,
    //   iframeHeight: 400,
    //   iframeURL: null,
    //   focusInput: true,
    //   group: '',
    //   loop: false,
    //   arrowKeys: true,
    //   navigateCaption: true,
    // navigateArrows: true, // Boolean, 'closeToModal', 'closeScreenEdge'
    // history: false,
    // restoreDefaultContent: false,
    // autoOpen: 0, // Boolean, Number
    bodyOverflow: false,
    // fullscreen: true,
       // openFullscreen: true,
    // closeOnEscape: true,
    // closeButton: true,
    // appendTo: 'body', // or false
    // appendToOverlay: 'body', // or false
    // overlay: true,
    // overlayClose: true,
    // overlayColor: 'rgba(0, 0, 0, 0.4)',
    // timeout: false,
    // timeoutProgressbar: false,
    // pauseOnHover: false,
    // timeoutProgressbarColor: 'rgba(255,255,255,0.5)',
    // transitionIn: 'comingIn',
    // transitionOut: 'comingOut',
    // transitionInOverlay: 'fadeIn',
    // transitionOutOverlay: 'fadeOut',
    // onFullscreen: function(){},
    // onResize: function(){},
    onOpening: function(modal){
      modal.startLoading();
    },
    onOpened: function(modal){
      modal.stopLoading();
    },
    // onClosing: function(){},
    // onClosed: function(){},
    // afterRender: function(){}
  });

  var show_modal = function(id)
  {
   axios.get('{{ url('hasil_evaluasi/') . '/' }}'+id, {
   })
   .then(res => {
    response = res.data;
    $('#modal-hasil-evaluasi').iziModal('open');
    set_modal_data(response);
    $("#modal-hasil-evaluasi .iziModal-wrap").scrollTop(0);            
    
  })
   .catch();

 }


 var set_modal_data = function(data)
 {
  $("#content_hasil").html(data.hasil);
  $("#nama_anak").text(data.terapi_anak.anak.nama);
  $("#nama_orang_tua").text(data.terapi_anak.anak.klien.nama_ayah);
  $("#jenis_terapi").text(data.terapi_anak.terapi.jenis);
  $("#periode").text(data.periode);
  $("#pertemuan").text(data.pertemuan);




}


</script>
@endsection
