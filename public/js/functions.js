function loadDevices(){
    var sd;
    $.ajax({
        type: "POST",
        url: 'pe/submit',
        data: {iamM: "Devices", iamO: "FindDevice"},
        success:function(data){
            data = JSON.parse(data);
            var JSONobject=data;
            data["devices"].forEach(function (JSONObject) {
                sd += "<option value=" + JSONObject["Device_Id"] + ">";
                sd += JSONObject["Device_Loc"] ;
                sd += "</option>";
            });
            $( "select" ).each(function() {
                $( "select" ).html(sd);
            });
        }
    });
}
jQuery(document).ready(function () {
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
});
var viewModel = {
    searchTable : function (){
        setTimeout(function(){
            searchTable();

        },1000)
    },
    loadDevice:function(){
        loadDevices();
    }
};
pager.extendWithPage(viewModel);
ko.applyBindings(viewModel, document.getElementById("pager"));
pager.start();
window.onload = loadDevices();