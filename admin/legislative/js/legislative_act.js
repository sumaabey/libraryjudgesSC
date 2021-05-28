

$(document).ready(function() {
        $('#butsave').on('click', function(e) {
         e.preventDefault();
         var errval=0;
         var act_name     = $('#act_name').val();    
         var act_number   = $('#act_number').val();
         var act_year   = $('#act_year').val();
         var created_by   = $('#created_by').val();
         var view_type   = $("input[name='view_type']:checked").val();
         var gazette_citation   = $('#gazette_citation').val();
         var date_of_president_asset   = $('#date_of_president_asset').val();
         var date_of_enforcment   = $('#date_of_enforcment').val();

         var file_act = $("#file_principal_act").val();
         var ext_act = file_act.split('.').pop();
         if(file_act!="" && ext_act !="pdf")
         {
               $('#errorMsg').text("Please upload PDF for Principal Act !");
               $('.error').show();
               $('#file_principal_act').focus(); 
               setTimeout(
               function() 
               {
               $('.error').hide();                            
               }, 3000);  
               errval=1;
               return false;
         }
         var filepresidentasset = $("#file_president_asset").val();
         var ext_file_president_asset = filepresidentasset.split('.').pop();
         if(filepresidentasset!="" && ext_file_president_asset !="pdf")
         {
               $('#errorMsg').text("Please upload PDF for President Asset !");
               $('.error').show();
               $('#file_president_asset').focus(); 
               setTimeout(
               function() 
               {
               $('.error').hide();                            
               }, 3000);                      
               errval=1;
               return false;
         }
         var file_enforcment = $("#file_enforcment").val();
         var ext_file_enforcment = file_enforcment.split('.').pop();
        if(file_enforcment!="" && ext_file_enforcment !="pdf")
        {
               $('#errorMsg').text("Please upload PDF for Enforcement !");
               $('.error').show();
               $('#file_enforcment').focus(); 
               setTimeout(
               function() 
               {
               $('.error').hide();                            
               }, 3000);     
              errval=1;
              return false;
        }
        if(act_name==''){
               $('#errorMsg').text("Please Enter Act Name");
               $('.error').show();
               $('#act_name').focus(); 
               setTimeout(
               function() 
               {
               $('.error').hide();                            
               }, 3000);              
               errval=1;
              return false;

        }
       if(act_year ==''){
            $('#errorMsg').text("Please Select Act Year");
            $('.error').show();
            $('#act_year').focus(); 
            setTimeout(
            function() 
            {
            $('.error').hide();                            
            }, 3000);  
             errval=1;return false;

        } 
       if(act_number ==''){
            $('#errorMsg').text("Please Enter Act Number");
            $('.error').show();
            $('#act_number').focus(); 
            setTimeout(
            function() 
            {
            $('.error').hide();                            
            }, 3000);  
             errval=1;return false;

        } 
        if(errval==0)
        {  
                
//          document.getElementById("frmlrca").submit(); 
             console.log("****Principal Act*********");
              $("#erroutput").hide();
              var fd = new FormData();

              
              fd.append('principal_act',act_name);
              fd.append('principal_act_no',act_number);
              fd.append('act_year',act_year);
              fd.append('created_by',created_by);
              fd.append('gazette_citation',gazette_citation);
              fd.append('date_of_president_asset',date_of_president_asset);
              fd.append('date_of_enforcment',date_of_enforcment);
              fd.append('view_type',view_type);

              var files_act = $('#file_principal_act')[0].files;
              fd.append('file_principal_act',files_act[0]);
              var filepresidentasset = $('#file_president_asset')[0].files;
              fd.append('file_president_asset',filepresidentasset[0]);
              var file_enforcment = $('#file_enforcment')[0].files;
              fd.append('file_enforcment',file_enforcment[0]);

              $.ajax({
                type: 'POST',
                url: 'legislative/legislative_act_save',                  
                data: fd,                                               
                async:false,
                contentType: false,
                processData: false,
                error: function() { console.log("error"); },
                success: function(response) { 
                   if(response.status == 'Success'){                       //                       
                       $('#successMsg').text(response.msg);
                       $('.success').show();                                               
                        setTimeout(
                        function() 
                        {
                        $('.success').hide();       
                        window.location.href="manage-legislative";   //do something special
                        }, 4000);
                        
                   }else{                        
                         $('#errorMsg').text(response.msg);
                         $('.error').show();
                         setTimeout(
                         function() 
                         {
                         $('.error').hide();                            
                         }, 3000);
                   }
                
                 },
         });
              
        }
    


  });
});













 

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