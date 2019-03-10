var show_1 = [[1,2,3,4,5,6,7,8,9,0], [1,2,3,4,5,6,0,0,0,0], [0,2,3,4,5,6,7,0,0,0]];
var show_2 = [[1,2,3,4,5,6,7,0,0,0], [0,2,3,4,5,6,0,0,0,0], [1,2,3,4,5,6,7,0,0,0]];
var show_3 = [[1,2,3,4,5,0,0,0,0,0], [1,2,3,4,5,6,7,8,0,0], [1,2,3,4,5,6,7,8,9,0]];
var total=0;
var tax=0
var final_amount=0;
function LoadAuditoriumLayout(show_number){
    $("#auditorium_layout").empty();
    var html = "";
    var arr = [];
    var show_name = "";
    if(show_number == "show_1"){ arr = show_1; show_name="Audi 1"; }
    if(show_number == "show_2"){ arr = show_2; show_name="Audi 2"; }
    if(show_number == "show_3"){ arr = show_3; show_name="Audi 3"; }
    $(".show_name").text(show_name);
    for (let index = 0; index < arr.length; index++) {
        const element = arr[index];
        var row_name = "X";
        if(index==0){
            row_name="A";
            html += "<tr><td colspan='10'>Platinum Seatings : 320 INR</td></tr>";
        }
        if(index==1){
            row_name="B";
            html += "<tr><td colspan='10'>Gold Seatings : 280 INR</td></tr>";
        }
        if(index==2){
            row_name="C";
            html += "<tr><td colspan='10'>Silver Seatings : 240 INR</td></tr>";
        }
        html += "<tr>";
        for (let index0 = 0; index0 < element.length; index0++) {
            var status = "green";
            if(element[index0] == 0) { status="red"; }
            if(status == "red"){
                html += "<td style='background-color:"+status+"'>"+row_name+"-"+(index0+1)+"</td>";
            }else{
                html += "<td style='background-color:"+status+"' onclick=FreezeSeat('"+show_number+"','"+row_name+"',"+(index0+1)+")>"+row_name+"-"+(index0+1)+"</td>";
            }
        }
        html += "</tr>";
    }
    html += "<tr><td colspan ='10'>Screen This Side</td></tr>";
    $("#auditorium_layout").append(html);
}
function FreezeSeat(show_number,row_name,seat_number){
    if(show_number == "show_1"){ 
        if(row_name=="A"){
            total = total + 320;
            seat_number--;
            show_1[0][seat_number]=0;
        }
        if(row_name=="B"){
            total = total + 280;
            seat_number--;
            show_1[1][seat_number]=0;   
        }
        if(row_name=="C"){
            total = total + 240;
            seat_number--;
            show_1[2][seat_number]=0;
        }   
    }
    if(show_number == "show_2"){ 
        if(row_name=="A"){
            total = total + 320;
            seat_number--;
            show_2[0][seat_number]=0;
        }
        if(row_name=="B"){
            total = total + 280;
            seat_number--;
            show_2[1][seat_number]=0;   
        }
        if(row_name=="C"){
            total = total + 240;
            seat_number--;
            show_2[2][seat_number]=0;
        }   
     }
    if(show_number == "show_3"){ 
        if(row_name=="A"){
            total = total + 320;
            seat_number--;
            show_3[0][seat_number]=0;
        }
        if(row_name=="B"){
            total = total + 280;
            seat_number--;
            show_3[1][seat_number]=0;   
        }
        if(row_name=="C"){
            total = total + 240;
            seat_number--;
            show_3[2][seat_number]=0;
        }   
     }
    var html = '';
    html += row_name+"-"+(seat_number+1)+" , ";
    $(".selected_seats").append(html);
    LoadAuditoriumLayout(show_number);
}
$(document).ready(function(){
    $(".cancel").click(function(){
        location.reload();
    });
    $("#book-now").click(function(){
        $(".screen1").hide();
        $(".screen2").show();   
        $(".choice-form").trigger("reset");
    });
    $("#step1_form").submit(function( event ) {
        event.preventDefault();
        var show_no = $("#show-choice").val();
        var available_tickets = 0;
        var arr = [];
        if(show_no == "show_1"){ arr = show_1; }
        if(show_no == "show_2"){ arr = show_2; }
        if(show_no == "show_3"){ arr = show_3; }
        var A_row_available = $.grep(arr[0], function (elem) {
            return elem != 0;
        }).length;
        var B_row_available = $.grep(arr[1], function (elem) {
            return elem != 0;
        }).length;
        var C_row_available = $.grep(arr[2], function (elem) {
            return elem != 0;
        }).length;
        available_tickets = A_row_available + B_row_available + C_row_available;
        if(available_tickets <= 0){
            alert("Error : Show is housefull !");
            return false;
        }
        LoadAuditoriumLayout(show_no);
        $(".step-1-fill").hide();
        $(".step-1-blank").show();   
        $(".step-2-fill").show();
        $(".step-2-blank").hide();   
        $(".choice-form").trigger("reset");
    });
    $("#step2").click(function(){
        tax = ( 30 / 100 ) * total;
        final_amount = total + tax;
        $(".total").text(total);
        $(".tax").text(tax);
        $(".final_amount").text(final_amount);
        if($(".selected_seats").text() == ""){
            alert("Error : You need to book atleast one ticket !");
            return false;
        }
        $(".step-2-fill").hide();
        $(".step-2-blank").show();   
        $(".step-3-fill").show();
        $(".step-3-blank").hide(); 
    });
    $("#step3").click(function(){
        if (confirm('Are you sure you want to checkout?')) {
            total=0;
            tax=0
            final_amount=0;        
            $(".total").empty();
            $(".selected_seats").empty();
            $(".show_name").empty();
            $(".step-3-fill").hide();
            $(".step-3-blank").show();   
            $(".step-1-fill").show();
            $(".step-1-blank").hide();
            $(".screen2").hide();
            $(".screen1").show();   
        }
        else {
            return false;
        }
    });
});