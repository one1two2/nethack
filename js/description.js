    $( document ).ready(function() {
        var count = 0;
            $('body').on("click",'a.moredescription',function(){
                $(this).hide();
                count++;
                $('#eventdescription'+count).show();
                return false;
            });
        });


