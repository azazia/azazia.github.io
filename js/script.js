$(document).ready(function(){

	// hilangkan tombol cari
	$('#tombol').hide();


	//event ketika keyword ditulis
	$('#keyword').on('keyup', function(){
		// memunculkan ikon load
		$('.load').show();

		//ada yang lebih fleksibel dari yg dibawah, tonton lagi vidio  z
		$('#container').load('ajax/film.php?keyword=' + $('#keyword').val());
	});

	$('.load').hide();
});