function searchTable() {
    var tabledata;
    var fdate=$("#date_from").val();
    var tdate=$("#date_to").val();
    $.ajax({
        type: "POST",
        data: {iamM: "Readings", iamO: "SelectAll",fdate:fdate, tdate:tdate},
        url: 'pe/submit',
        success: function (data) {
            data = JSON.parse(data);
            var JSONobject=data["data"];
            data["data"].forEach(function (JSONObject) {

                tabledata += "<tr id=" + JSONObject["Id"] + ">";
                tabledata += "<td>" + JSONObject["Device_Id"] + "</td>";
                tabledata += "<td>" + JSONObject["read_DateTime"] + "</td>";
                tabledata += "<td>" + JSONObject["Temperature"] + "</td>";
                tabledata += "<td>" + JSONObject["Humidity"] + "</td>";
                tabledata += "</tr>";
            });
            $("#tableData").html(tabledata);
        },
        cache: false
    });

}
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
    searchTable : function(){
        searchTable();

    },
    loadDevice:function(){
        loadDevices();
    }
};
pager.extendWithPage(viewModel);
ko.applyBindings(viewModel, document.getElementById("pager"));
pager.start();
window.onload = loadDevices();