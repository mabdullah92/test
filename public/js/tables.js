/**
 * Created by user on 3/18/2015.
 */
$("#btn_excel").click(function(){
    var $table = $('#table2excel');
    $table.removeData(); //data is removed, previous when data existed was preventing initialization of table2excel
    $table.table2excel({
        exclude: ".noExl",
        name: "Excel Document Name"
    });
});
function searchTable() {
    var tabledata;
    var fdate=$("#date_from").val();
    var tdate=$("#date_to").val();
    var device=$("#select_device").val();
    $.ajax({
        type: "POST",
        data: {iamM: "Readings", iamO: "SelectAll",fdate:fdate, tdate:tdate,device:device},
        url: 'pe/submit',
        success: function (data) {
            data = JSON.parse(data);
            var JSONobject=data["data"];
            if(data["data"]===301){
                $("#tableData").html('');
                $("#norecord").html("No Record Found.");
            }
            else{
                data["data"].forEach(function (JSONObject) {

                    tabledata += "<tr id=" + JSONObject["Id"] + ">";
                    tabledata += "<td>" + JSONObject["Device_Id"] + "</td>";
                    tabledata += "<td>" + JSONObject["read_DateTime"] + "</td>";
                    tabledata += "<td>" + JSONObject["Temperature"] + "</td>";
                    tabledata += "<td>" + JSONObject["Humidity"] + "</td>";
                    tabledata += "</tr>";
                });
                $("#tableData").html(tabledata);
                $("#norecord").html("");
            }
        },
        cache: false
    });

}

function plot(){
    var fdate=$("#date_from").val();
    var tdate=$("#date_to").val();
    var device=$("#select_device").val();
    $.ajax({
        type: "POST",
        url: 'pe/submit',
        data: {iamM: "Readings", iamO: "Charts",fdate:fdate, tdate:tdate, device:device},
        success:function(data){
            data = JSON.parse(data);
            console.log(data);
        }
    });
}