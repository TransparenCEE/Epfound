$("document").ready(function(){

    $("#data-file").change(function() {
        $('.filetext').val($(this).val());
    });


	$(".editShowData").click(function(){
		$(".showData .view").hide();
		$(".showData .edit").show();
	});

    $(".cancelShowData").click(function(){
        $(".showData .view").show();
        $(".showData .edit").hide();
    });

    $(".saveShowData").click(function(){
        $( ".showData" ).submit();
    });


});
