// DELETE CONFIRM BOX
var alertfunction = document.getElementsByClassName('btn-outline-danger');
for(var i=0; i<alertfunction.length ; i++){
   alertfunction[i].addEventListener("click", function(e){
        verify = confirm("برای حذف این آیتم مطمئنید؟ در صورت تایید این آیتم به طور کامل از دیتابیس حذف می شود!؟");
        if(!verify){
            e.stopImmediatePropagation();
            e.preventDefault();
        }
    });
}