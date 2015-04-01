/**
 * Created by user on 3/18/2015.
 */
$(document).ready(function() {

} );
$("#btn_excel").click(function(){
    var $table = $('#table2excel');
    $table.removeData(); //data is removed, previous when data existed was preventing initialization of table2excel
    $table.table2excel({
        exclude: ".noExl",
        name: "Excel Document Name"
    });
});
var offset=0;
var limit=1000;
//var newtable=  $('#table2excel').DataTable({
//    "scrollY":        600,
//    "scrollCollapse": true,
//    "ordering": true,
//    "info":     true,
//    "responsive":true,
//    "iDisplayLength": 100
//
//});
function searchTable() {
   // $("#tableData").html('');
    var tabledata;
    var fdate=$("#date_from").val();
    var tdate=$("#date_to").val();
    var device=$("#select_device").val();
    $.ajax({
        type: "POST",
        data: {iamM: "Readings", iamO: "SelectAll",fdate:fdate, tdate:tdate,device:device,offset:offset,limit:limit},
        url: 'pe/submit',
        success: function (data) {
            if($("#tableData").length ===0){
                return false;
            }
            else{
            data = JSON.parse(data);
            var JSONobject=data["data"];
            if(data["data"]===301){
                if( $('#table2excel tbody').children().length===0){
                    $("#norecord").html("No Record Found.");
                }
                return false;
            }
            else{
                data["data"].forEach(function (JSONObject) {
                    //newtable.row.add([
                    //    JSONObject["Device_Id"],JSONObject["read_DateTime"],JSONObject["Temperature"],JSONObject["Humidity"]
                    //]).draw();
                    tabledata += "<tr id=" + JSONObject["Id"] + ">";
                    tabledata += "<td>" + JSONObject["Device_Id"] + "</td>";
                    tabledata += "<td>" + JSONObject["read_DateTime"] + "</td>";
                    tabledata += "<td>" + JSONObject["Temperature"] + "</td>";
                    tabledata += "<td>" + JSONObject["Humidity"] + "</td>";
                    tabledata += "</tr>";
                });
                $("#table2excel").append(tabledata);
                $("#norecord").html("");
                offset = offset+1000;
                searchTable();
            }}
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
