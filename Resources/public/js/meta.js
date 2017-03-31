$(document).ready(function() {
    $("#meta-quick-form span.open_meta_form").click(function(){
        if($("#meta-quick-form span.open_meta_form").hasClass("open")) {
            $("#meta-quick-form span.open_meta_form").removeClass("open");
            $("#meta-quick-form").animate({
                "left": "-300px"
            });
        }
        else {
            $("#meta-quick-form span.open_meta_form").addClass("open");
            $("#meta-quick-form").animate({
                "left": "0px"
            });
        }
    });
});