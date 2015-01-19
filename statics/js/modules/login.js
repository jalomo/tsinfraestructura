/**
 * FILE THAT CONTAINS ALL THE ACTIONS OR EVENTS
 * NEED TO EXECUTE IN THE PART OF THE LOGIN TO
 * THE PLATFORM FOR THIS SYSTEM
 *
 * @createdAt May 23, 2013
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/

/**
 * Function will execute every the user press the
 * button and submit the values for try to access
 * to the account and can manipulate the data of the
 * platform
 *
 * @return bool flag
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function login()
{
    var band = 0;

    if($("#userUsername").val() == '')
    {
        $("#userUsername").css("border", "1px solid #FF0000");
        band++;
    }
    else{
        $("#userUsername").css("border", "1px solid #ADA9A5");
    }

    if($("#userPassword").val() == ''){
        $("#userPassword").css("border", "1px solid #FF0000");
        band++;
    }
    else{
        $("#userPassword").css("border", "1px solid #ADA9A5");
    }

    if($("#userUsername").val() != '' && $("#userPassword").val() != ''){
        values = $.ajax({
                            url : $("#checkValues").attr("href"),
                            type : "POST",
                            data : {username:$("#userUsername").val(), password:$("#userPassword").val()},
                            async : false
                        }).responseText;

        if(values == 0 || values == '0'){
            $("#errorLoginData").text("Por favor, verifique el usuario/password.").show();
            $("#loginApplebees").css("border", "1px solid #FF0000");
            $("#passApplebees").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#errorLoginData").hide();
            $("#loginApplebees").css("border", "1px solid #ADA9A5");
            $("#passApplebees").css("border", "1px solid #ADA9A5");
        }
    }
    
    if(band != 0)
    {
        $("#errorMessageLogin").text("Por favor, verifica los campos marcador.").show();
        return false;
    }
    else{
        $("#errorMessageLogin").hide();
        return true;
    }
}
