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

jQuery(document).ready(function () {
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
});
var viewModel = {
    searchTable : function(){
        searchTable();
    }
};
pager.extendWithPage(viewModel);
ko.applyBindings(viewModel, document.getElementById("pager"));
pager.start();