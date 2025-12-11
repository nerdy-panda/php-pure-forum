const baseUrl = 'http://domain.com/php-forum/Public/';
const ajaxUrl = baseUrl+"ajax.php";
const ajaxQmUrl = ajaxUrl + "?action=qm" ;
const ajaxAmUrl = ajaxUrl + "?action=am" ;

$(document).ready(function () {

// Ajax Request !!! (for security reseons : put it in separate file !!!)
    $(".qManage .qm").click(function (e) {
        var thisElement = $(this);
        thisElement.parent().find('.result').fadeIn(10);
        thisElement.parent().find('.result').html('...');
        $.ajax({
            type: 'POST',
            url: ajaxQmUrl ,
            data: {qmStr: thisElement.attr('id')},
            success: function (response) {
                thisElement.parent().find('.result').html("");
                const jsonResponse = JSON.parse(response);
                const message = jsonResponse.message ;
                swalSuccessProcess();

                // thisElement.parent().find('.result').html(response);
                // thisElement.parent().find('.result').fadeIn(500);
                // refresh page after 1 second
                setTimeout("location.href='" + window.location.href + "'", 1000);
            },
            error: function (xhr, status, error) {
                thisElement.parent().find('.result').html("");
                swalFailProcess();
            }
        });
    });

    $(".qManage .qmr").click(function (e) {
        $(this).parent().parent().find('.r').fadeToggle(500);
    });
    $(".delete-answer-controller").click(deleteAnswerClickListener);
});
function deleteAnswerClickListener(event){
    event.stopPropagation();
    const _this = $(this);
    const issue = _this.attr("data-issue");
    const answer = _this.attr("data-answer");
    const amStr = `amd-${issue}-${answer}`;
    $.ajax({
        type : "POST" , 
        url : ajaxAmUrl ,
        data : { amStr } ,
        success : function(){
            swalSuccessProcess();
            setTimeout("location.href='" + window.location.href + "'", 1000);
        },
        error: function (){
            swalFailProcess();
        }
    });
}
function swalFailProcess(){
    Swal.fire({
        title: "عملیات ناموفق بود لطفا مجددا تلاش کنید !!!",
        icon: "error"
    });
}
function swalSuccessProcess(){
    Swal.fire({
        title: "عملیات موفقیت آمیز بود",
        icon: "success"
    });
}
