 

function getActList(act_year)
{


       
       let tag ="actList"; 
       let select_menu=$('#act_year')[0]; // this expression is same as document.getElementById('dynamic_menu')
       $.ajax({
            url:"../legislative_ajax.php",
            dataType:"json",
            method:"post",
            data:{tag:tag},
            success:function(response){
                //alert(response.length);
                console.log($.isArray(response)); // if response is an array, this function will return true
 
                response.forEach((item,index)=>{
                    console.log(index,item);
                    var option = document.createElement("option");
                    option.value = item['id'];
                    option.text = item['company_name'];
                    select_menu.appendChild(option);
                })
            }
        })




}







 function  showdebates(id)
    {
        var id;
        

        if(id==1)
        {
             var loksabha_debate=$("#loksabha").val();
             if(loksabha_debate==1) 
                {
                    $("#upload_ls").show();
                }else{
                     $("#upload_ls").hide();
                } 
        }
        if(id==2)
        {
              var rajsabha_debate=$("#rajsabha").val();

             if(rajsabha_debate==1) 
                {
                    $("#upload_rs").show();
                }else{
                     $("#upload_rs").hide();
                }
        }

         if(id==3)
        {
             

              var both_debate=$("#both_sabha").val();

             if(both_debate==1) 
                {
                    $("#upload_both").show();
                }else{
                     $("#upload_both").hide();
                } 
        }
    }//end of show debates