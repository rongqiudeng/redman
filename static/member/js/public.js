/**
 * Created by Administrator on 2017/11/8 0008.
 */
//菜单显示和隐藏
$(".navbar-btn").click(function(){


    $('.left-side').toggleClass('left-sides');
    $('.right-side').toggleClass('right-sides');
    $('.user-content').toggleClass('user-contents');
    $('.nav-first').toggleClass('nav-firsts');
    $('.nav-last').toggleClass('nav-lasts');


});

//菜单选中颜色
$('.left-nav ul li a').each(function () {

    $(this).click(function () {

        $(this).css('background-color','#1e2324');

        $(this).find('label').css('display','block');

        $(this).parents('li').siblings().children('a').css('background-color','#272f2f');
        $(this).parents('li').siblings().children('a').find('label').css('display','none');

    })


})
//高度设置
if( $('.left-side').height()<$('.right-side').height()){
    $('.left-side').height($('.right-side').height()+20);
}else {

    $('.left-side').height('100%');
}

//语言切换
// function setLang(lang) {
//     var data = {'lang':lang};
//     $.get("/admin/base/lang",data,function(){
//         location.reload();
//     })
// }
//语言切换
function changeLang(lang){

    console.log(lang.value);

    var data = {'lang':lang.value};
    $.get("/admin/base/lang",data,function(){
        location.reload();
    })

}



//头部全选
$("#quanxuan").click(function(){//给全选按钮加上点击事件
    var xz = $(this).prop("checked");//判断全选按钮的选中状态
    var ck = $(".qx").prop("checked",xz);  //让class名为qx的选项的选中状态和全选按钮的选中状态一致。
});
//发送
$("#send").click(function(){
    var aa=new Array();
    $("input[name='checkbox']:checkbox:checked").each(function(){
        aa=$(this).val();
        console.log(aa);
        $.post('/admin/card/sendCard',{id:aa},function(){
            location.reload()});
    });
    if(aa==''){
        alert("请选择发送项");
    }
});
