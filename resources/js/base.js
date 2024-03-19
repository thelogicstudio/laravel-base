
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

toggleEditMode();

window.addEventListener('storage', function (event) {
    if (event.key == 'editmode') {
        $('#edit-mode-input').prop('checked', event.newValue === 'true');
        toggleEditMode();
    }
});

/* Toggle View/Edit mode */
$('#edit-mode-input').on('change', function () {
    let edit_mode = 0;
    if ($(this).is(":checked")) {
        edit_mode = 1;
    }

    localStorage.editmode = !!edit_mode;

    setCookie('editmode', !!edit_mode, 365);

    toggleEditMode();
});

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

function toggleEditMode() {
    let editModeCookie = getCookie('editmode');
    if(editModeCookie && editModeCookie.length) {
        $('#edit-mode-input').prop('checked', true);
    } else {
        $('#edit-mode-input').prop('checked', false);
    }
}
