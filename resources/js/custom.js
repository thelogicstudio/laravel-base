
$('.toggle-sidebar').on('click',function(){
    if( $('.sidebar').css('display') == 'none' ) {
        $('.sidebar').css("display", "inline");
        $(this).html('<i class="status_toggle middle" data-feather="x" id="sidebar-toggle">    </i>');
        feather.replace()
    }else{
        $('.sidebar').css("display", "none");
        $(this).html('<i class="status_toggle middle" data-feather="menu" id="sidebar-toggle">    </i>');
        feather.replace()
    }
});

$('.first-menu li').on('click', function (){
    console.log('test')
    var submenu = $(this).children('ul');
    if (submenu.hasClass('d-none')) {
        submenu.removeClass('d-none'); //then show the current submenu
        $(this).attr("aria-expanded","true");
    } else {
        submenu.addClass('d-none'); //then show the current submenu
        $(this).attr("aria-expanded","false");
    }
});

$(".section").resizable();

var div = document.querySelector("div.page-wrapper")
if(div.classList.contains('compact-sidebar')){
    div.classList.remove("compact-sidebar");
}
if(div.classList.contains('modern-sidebar')){
    div.classList.remove("modern-sidebar");
}

//Model cancel action
$(document).on("click", ".cancel-edit", function () {
    var item_id = $(this).data('id');
    var item_url = $(this).data('link');
    console.log(item_url)
    $("#cancelModal #cancelItem").data('id',item_id).data('link',item_url);
});
$('#cancelItem').on('click', function (event) {
    window.location.href = $(this).data("link");
    event.preventDefault();
});

//Model delete action
$(document).on("click", ".item-delete", function () {
    var item_id = $(this).data('id');
    var item_url = $(this).data('link');
    console.log(item_url)
    $("#deleteModal #deleteItem").data('id',item_id).data('link',item_url);
});
$('#deleteItem').on('click', function (event) {
    window.location.href = $(this).data("link");
    event.preventDefault();
});

$('.alert').delay(500).fadeIn(500, function() {
    $('.alert').delay(3000).fadeOut(500);
});
